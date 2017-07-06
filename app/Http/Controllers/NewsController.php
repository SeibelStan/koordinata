<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use PhpParser\Node\Expr\Cast\Object_;
use Input;
use Redirect;
use DB;
use Auth;
use Mail;
use Image;

function ru2lat($str) {
	$translit = array(
		' ' => '-', ',' => '', '.' => '',
		'/' => '-', '\\' => '-', '"' => '',
		'\'' => '', '@' => '', '#' => '',
		'%' => '',

		'а' => 'a', 'б' => 'b', 'в' => 'v',
		'г' => 'g', 'д' => 'd', 'е' => 'e',
		'ё' => 'yo', 'ж' => 'zh', 'з' => 'z',
		'и' => 'i', 'й' => 'j', 'к' => 'k',
		'л' => 'l', 'м' => 'm', 'н' => 'n',
		'о' => 'o', 'п' => 'p', 'р' => 'r',
		'с' => 's', 'т' => 't', 'у' => 'u',
		'ф' => 'f', 'х' => 'x', 'ц' => 'c',
		'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
		'ь' => '', 'ы' => 'y', 'ъ' => '',
		'э' => 'e', 'ю' => 'yu', 'я' => 'ya',

		'А' => 'A', 'Б' => 'B', 'В' => 'V',
		'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
		'Ё' => 'YO', 'Ж' => 'Zh', 'З' => 'Z',
		'И' => 'I', 'Й' => 'J', 'К' => 'K',
		'Л' => 'L', 'М' => 'M', 'Н' => 'N',
		'О' => 'O', 'П' => 'P', 'Р' => 'R',
		'С' => 'S', 'Т' => 'T', 'У' => 'U',
		'Ф' => 'F', 'Х' => 'X', 'Ц' => 'C',
		'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SCH',
		'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
		'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA',
	);

	mb_internal_encoding("UTF-8");
	$tstr = strtr($str, $translit);
	return $tstr;
}

function getBeacon($uid) {
	$uid = (isset($uid)) ? $uid : '';
	return $uid . md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
}

class NewsController extends Controller {

	public function __construct() {
		$this->middleware('guest');
	}

	public function index() {
		$units = DB::select("select * from news order by date desc");

		foreach($units as $unit) {
			$fimg = 'public/data/news-img/' . $unit->id;
			if(file_exists($fimg)) {
				$unit->img = $fimg;
			}
			else {
				if(preg_match('/\<img/', $unit->content)) {
					preg_match('/src="(.+?)"/', $unit->content, $imgs);
					$unit->img = $imgs[1];
				}
				else {
					$unit->img = '';
				}
			}
		}

		return view(
			'news/index',
			[
				'units' => $units
			]
		);
	}

	public function single($name) {
		if(!$units = DB::select("select * from news where name = '$name' limit 1")) {
			return view('errors/404');
		}

		$unit = $units[0];

		function getImage($unit) {
			if(file_exists('public/data/user-img/' . $unit->user_id)) {
				return 'public/data/user-img/' . $unit->user_id;
			}
			else {
				return 'public/img/noimage.jpg';
			}
		}

		//comments
		$comments_count = DB::select("select count(*) as count from comments where post_type = 'adds' and post_id = $unit->id")[0]->count;
		$comments = DB::select("select * from comments where post_type = 'news' and post_id = $unit->id and reply_id = 0 order by id desc");
		foreach($comments as $comment) {
			$comment->replies = DB::select("select * from comments where reply_id = $comment->id order by id desc");
			$comment->image = getImage($comment);
			foreach($comment->replies as $reply) {
				$reply->image = getImage($reply);
			}
		}
		//

		return view(
			'news/single',
			[
				'type' => 'news',
				'unit' => $unit,
				'comments' => $comments,
				'comments_count' => $comments_count
			]
		);
	}

	public function add() {
		if(!(uth::check() && Auth::user()->admin)) {
			App::abort(401);
		}

		return view('news/add');
	}

	public function post() {
		if(!(uth::check() && Auth::user()->admin)) {
			App::abort(401);
		}

		$title = Input::get('title');
		$content = Input::get('content');
		$update = Input::get('update');

		if($update) {
			$lastid = Input::get('id');
			DB::table('news')->where('id', $lastid)->update([
				'title' => $title,
				'name' => ru2lat($title),
				'content' => $content
			]);
		}
		else {
			$lastid = DB::table('news')->insertGetId([
				'title' => $title,
				'name' => ru2lat($title),
				'content' => $content
			]);
		}

		if($lastid) {
			if(Input::hasFile('image')) {
				Input::file('image')->move('public/data/news-img', $lastid);
				Image::make('public/data/news-img/' . $lastid)->resize(1000, null, function ($constraint) {
					$constraint->aspectRatio();
				})->save();
			}
		}

		return Redirect::to('redirect?path=news/edit-' . $lastid);
	}

	public function remove($id) {
		if(!(uth::check() && Auth::user()->admin)) {
			App::abort(401);
		}

		DB::delete("delete from news where id = $id");
		return Redirect::to('admin');
	}

	public function edit($id) {
		$unit = DB::select("select * from news where id = $id limit 1")[0];

		if(!(uth::check() && Auth::user()->admin)) {
			App::abort(401);
		}

		return view(
			'news/add',
			[
				'unit' => $unit
			]
		);
	}

}