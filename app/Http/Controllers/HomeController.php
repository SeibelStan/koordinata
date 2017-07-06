<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Cast\Object_;
use Input;
use Redirect;
use DB;
use File;
use Auth;
use Image;

function getBeacon($uid) {
	$uid = (isset($uid)) ? $uid : '';
	return $uid . md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
}

class HomeController extends Controller {

	public function __construct() {
		$this->middleware('guest');
	}

	public function index() {
		$keywords = DB::select("select * from staff where name = 'kw-main'")[0]->content;
		$description = DB::select("select * from staff where name = 'description'")[0]->content;

		if(Auth::check()) {
			if(file_exists('public/data/user-img/' . Auth::user()->id)) {
				$user_image =  'public/data/user-img/' . Auth::user()->id;
			}
			else {
				$user_image = 'public/img/noimage.jpg';
			}
		}
		else {
			$user_image = 0;
		}

		if(1 !== 1) {
			Session::forget('selects');
			Session::forget('filters');
		}

		$selects = Session::get('selects');
		$filters = Session::get('filters');

		$locations = DB::select("select * from locations order by title");
		array_unshift($locations, (object)[
			'id' => -1,
			'title' =>  'Все города'
		]);

		$cats = json_decode(DB::select("select * from staff where name = 'addscat'")[0]->content);
		usort($cats, function ($a, $b) {
			return strcmp($a->title, $b->title);
		});
		array_unshift($cats, (object)[
			'id' => -1,
			'title' =>  'Все категории'
		]);

		return view(
			'home',
			[
				'user_image' => $user_image,
				'cats' => $cats,
				'selects' => $selects,
				'locations' => $locations,
				'filters' => $filters,
				'keywords' => $keywords,
				'description' => $description
			]
		);
	}

	public function getCalendar() {
		$date = Input::get('date') ? Input::get('date') : date('Y-m-d');
		$date_now = Input::get('date') ? Input::get('date') : date('Y-m-d H:i');
		$calendar = [];

		$i = 0;
		while($i < 30) {
			$this_date = strtotime($date .  '+' . $i . ' days');
			$adds_count = count(DB::select("select * from adds where date_start like '" . date('Y-m-d', $this_date) . "%' and date_start > '$date_now'"));
			array_push($calendar, [
				'date' => date('Y-m-d', $this_date),
				'date_dig' => date('j', $this_date),
				'next_month' => date('m', $this_date) > date('m'),
				'date_text' => date('j M', $this_date),
				'adds' => $adds_count
			]);
			$i++;
		}

		echo json_encode($calendar);
	}

	public function imageUpload() {
		$callback = Input::get('CKEditorFuncNum');
		$upload_path = 'public/data/upload-img';
		$file_name = uniqid();
		$error = '';

		if(Input::hasFile('upload')) {
			Input::file('upload')->move($upload_path, $file_name);
			Image::make($upload_path . '/' . $file_name)->resize(1000, null, function ($constraint) {
				$constraint->aspectRatio();
			})->save();
		}

		return "<script>window.parent.CKEDITOR.tools.callFunction(" . $callback . ",  \"" . url($upload_path . "/" . $file_name) . "\", \"" . $error . "\" );</script>";
	}

	public function redirect() {
		return Redirect::to(Input::get('path'));
	}

}
