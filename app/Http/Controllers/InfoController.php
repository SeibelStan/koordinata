<?php namespace App\Http\Controllers;

use App;
use Illuminate\Support\Facades\Request;
use PhpParser\Node\Expr\Cast\Object_;
use Input;
use Redirect;
use DB;
use Auth;

class InfoController extends Controller {

	public function __construct() {
		$this->middleware('guest');
	}

	public function index($name) {
		if(!$units = DB::select("select * from info where name = '$name'")) {
			App::abort(404);
		}

		$unit = $units[0];
		return view(
			'info/single',
			[
				'unit' => $unit
			]
		);
	}

	public function edit($name) {
		if(!(Auth::check() && Auth::user()->admin)) {
			App::abort(401);
		}

		$unit = DB::select("select * from info where name = '$name'")[0];
		return view(
			'info/edit',
			[
				'unit' => $unit
			]
		);
	}

	public function save($name) {
		if(!(Auth::check() && Auth::user()->admin)) {
			App::abort(401);
		}

		$content = Input::get('content');
		DB::update("update info set content = '$content' where name = '$name'");
		return Redirect::to('info/edit-' . $name);
	}

}