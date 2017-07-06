<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use PhpParser\Node\Expr\Cast\Object_;
use Input;
use Redirect;
use DB;
use Auth;

class StaffController extends Controller {

	public function __construct() {
		$this->middleware('guest');
	}

	public function edit($name) {
		if(!(uth::check() && Auth::user()->admin)) {
			App::abort(401);
		}

		$staff = DB::select("select * from staff where name = '$name'")[0];
		return view(
			'staff/edit',
			[
				'staff' => $staff
			]
		);
	}

	public function save($name) {
		if(!(uth::check() && Auth::user()->admin)) {
			App::abort(401);
		}

		if(Input::get('type') == 'json') {
			$content = json_encode(json_decode(Input::get('content')), 386);
		}
		else {
			$content = Input::get('content');
		}

		DB::table('staff')
			->where('name', $name)
			->update([
				'content' => $content
			]);
		return Redirect::to('staff/edit-' . $name);
	}

}