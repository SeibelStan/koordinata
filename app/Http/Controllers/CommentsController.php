<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use PhpParser\Node\Expr\Cast\Object_;
use Input;
use Redirect;
use DB;
use Auth;

class CommentsController extends Controller {

	public function __construct() {
		$this->middleware('guest');
	}

	public function post($type) {
		if(Auth::check()) {
			$post_id = Input::get('post_id');
			$content = Input::get('content');
			$reply_id = Input::get('reply_id');

			$lastid = DB::table('comments')->insertGetId([
				'user_id' => Auth::user()->id,
				'user_name' => Auth::user()->name,
				'post_id' => $post_id,
				'post_type' => $type,
				'content' => $content,
				'reply_id' => $reply_id
			]);
			if($type == 'news') {
				$post_name = DB::select("select * from news where id = $post_id")[0]->name;
				return Redirect::to($type . '/single/' . $post_name . '#comment-' . $lastid);
			}
			else {
				return Redirect::to($type . '/single/' . $post_id . '#comment-' . $lastid);
			}
		}
		else {
			App::abort(401);
		}
	}

	public function remove() {
		if(Auth::check()) {
			$id = Input::get('id');

			DB::delete("delete from comments where id = $id");
			DB::delete("delete from comments where reply_id = $id");
			return 'Удалено';
		}
		else {
			return 'Войдите или зарегистрируйтесь';
		}
	}

}