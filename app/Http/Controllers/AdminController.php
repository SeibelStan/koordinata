<?php namespace App\Http\Controllers;

use App;
use Illuminate\Support\Facades\Request;
use PhpParser\Node\Expr\Cast\Object_;
use Input;
use Redirect;
use DB;
use File;
use Auth;
use Image;
use Mail;

function getBeacon($uid) {
	$uid = (isset($uid)) ? $uid : '';
	return $uid . md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
}

class AdminController extends Controller {

	public function __construct() {
		$this->middleware('guest');
	}

	public function index() {
		if(!(Auth::check() && Auth::user()->admin)) {
			App::abort(401);
		}

		$staff = DB::select("select * from staff order by title");
		$info = DB::select("select * from info order by title");
		$news = DB::select("select * from news order by date desc");

		return view(
			'admin/index',
			[
				'staff' => $staff,
				'info' => $info,
				'news' => $news
			]
		);
	}

	public function users() {
		if(!(Auth::check() && Auth::user()->admin)) {
			App::abort(401);
		}

		$users = DB::select("select * from users where active order by created_at desc");
		return view(
			'admin/users',
			[
				'users' => $users,
			]
		);
	}

	public function tasks() {
		if(!(Auth::check() && Auth::user()->admin)) {
			App::abort(401);
		}

		$adds = DB::select("select * from adds where not active order by date_start asc");
		return view(
			'admin/tasks',
			[
				'adds' => $adds,
			]
		);
	}

	public function tasksApply() {
		if(!(Auth::check() && Auth::user()->admin)) {
			App::abort(401);
		}

		$id = Input::get('id');
		$uid = DB::select("select * from adds where id = $id")[0]->user_id;
		$user = DB::select("select * from users where id = $uid")[0];

		$data = [
			'reason' => Input::get('reason'),
			'email' => $user->email
		];
		Mail::send('emails/adds-moderation', $data, function ($message) use ($data) {
			$message->from('admin@koordinata.kz', 'Координата.kz');
			$message->subject('Ваше мероприятие размещено');
			$message->to($data['email']);
		});

		DB::update("update adds set active = 1 where id = $id");
		return Redirect::back();
	}

	public function tasksReject() {
		if(!(Auth::check() && Auth::user()->admin)) {
			App::abort(401);
		}

		$id = Input::get('id');
		$uid = DB::select("select * from adds where id = $id")[0]->user_id;
		$user = DB::select("select * from users where id = $uid")[0];

		$data = [
			'reason' => Input::get('reason'),
			'email' => $user->email
		];
		Mail::send('emails/adds-moderation', $data, function ($message) use ($data) {
			$message->from('admin@koordinata.kz', 'Координата.kz');
			$message->subject('Ваше мероприятие отклонено');
			$message->to($data['email']);
		});

		DB::update("delete from adds where id = $id");
		return Redirect::back();
	}

	public function email() {
		if(!(Auth::check() && Auth::user()->admin)) {
			App::abort(401);
		}

		$semails = Input::get('emails');
		$title = Input::get('title');
		$content = Input::get('content');

		if($semails) {
			$emails = explode(' ', $semails);
		}
		else {
			$users = DB::select("select * from users where active");
			$emails = [];
			foreach($users as $user) {
				array_push($emails, $user->email);
			}
		}

		foreach($emails as $email) {
			$data = [
				'content' => $content,
				'title' => $title,
				'email' => $email
			];
			Mail::send('emails/custom', $data, function ($message) use ($data) {
				$message->from('admin@koordinata.kz', 'Координата.kz');
				$message->subject($data['title']);
				$message->to($data['email']);
			});
		}

		return Redirect::to('redirect?path=admin/users');
	}


	public function remove() {
		if(!(Auth::check() && Auth::user()->admin)) {
			App::abort(401);
		}

		$uid = Input::get('uid');
		DB::delete("delete from users where id = $uid");
		return Redirect::to('redirect?path=admin/users');
	}

	public function purge() {
		if(!(Auth::check() && Auth::user()->admin)) {
			App::abort(401);
		}

		$uid = Input::get('uid');
		DB::delete("delete from users where id = $uid");
		DB::delete("delete from adds where user_id = $uid");
		DB::delete("delete from comments where user_id = $uid");
		return Redirect::to('redirect?path=admin/users');
	}

	public function imagesList() {
		if(!(Auth::check() && Auth::user()->admin)) {
			App::abort(401);
		}

		$cat = Input::get('cat');
		$files = scandir('public/' . $cat);
		return view(
			'images-list',
			[
				'cat' => $cat,
				'files' => $files
			]
		);
	}

	public function imageRemove() {
		if(!(Auth::check() && Auth::user()->admin)) {
			App::abort(401);
		}

		$cat = Input::get('cat');
		$file = Input::get('file');
		$staff = Input::get('staff');
		if($staff) {
			$rcontent = DB::select("select * from staff where name = '$staff'")[0];
			$jcontent = json_decode($rcontent->content);

			$newcontent = [];
			foreach($jcontent as $unit) {
				if($unit->img != $file) {
					array_push($newcontent, $unit);
				}
			}

			$content = json_encode($newcontent, 386);
			DB::table('staff')
				->where('name', $staff)
				->update([
					'content' => $content
				]);
		}

		$path = public_path() . '/' . $cat . '/';
		File::delete($path . $file);
		return Redirect::back();
	}

}
