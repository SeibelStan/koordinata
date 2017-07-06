<?php namespace App\Http\Controllers;

use App;
use DB;
use Auth;
use Eloquent;
use Input;
use Redirect;
use Image;

class User extends Eloquent {
}

class UserController extends Controller {

	public function __construct() {
		//$this->middleware('auth');
	}

	public function index() {
		if(!Auth::check()) {
			App::abort(401);
		}

		if(file_exists('public/data/user-img/' . Auth::user()->id)) {
			$user_image =  'public/data/user-img/' . Auth::user()->id;
		}
		else {
			$user_image = 'public/img/noimage.jpg';
		}

		$locations = DB::select("select * from locations order by title");

		$id = Auth::user()->id;
		$date_now = date('Y-m-d h:i');
		$adds = DB::select("select * from adds where user_id = $id and date_start > '$date_now' and active order by date_start asc");
		$adds_old = DB::select("select * from adds where user_id = $id and date_start < '$date_now' and active order by date_start asc");

		return view(
			'user/index',
			[
				'adds' => $adds,
				'adds_old' => $adds_old,
				'user_image' => $user_image,
				'locations' => $locations
			]
		);
	}

	public function inspect($id) {
		if(!Auth::check()) {
			App::abort(401);
		}

		$date_now = date('Y-m-d h:i');
		$user = DB::select("select * from users where id = $id")[0];

        $user->age = floor((time() - strtotime($user->bdate)) / 31557600);

		$location = $user->location;
		$city = DB::select("select * from locations where id = $location")[0];
		$adds = DB::select("select * from adds where user_id = $id and date_start > '$date_now' and active order by date_start asc");
		$adds_old = DB::select("select * from adds where user_id = $id and date_start < '$date_now' and active order by date_start asc");

		$user->contacts = htmlentities($user->contacts) . ' ';
		$user->contacts = preg_replace("/(https*:\/\/)(.+?)[\s]/m", '<a href="$1$2" target="_blank">$2</a>', $user->contacts);
		$user->contacts = preg_replace("/\s*\n\s*/", '<br>', $user->contacts);

		if(file_exists('public/data/user-img/' . $id)) {
			$user->image =  'public/data/user-img/' . $id;
		}
		else {
			$user->image = 'public/img/noimage.jpg';
		}

		return view(
			'user/profile',
			[
				'adds' => $adds,
				'adds_old' => $adds_old,
				'user' => $user,
				'city' => $city
			]
		);
	}

	public function cabinet() {
		if(!Auth::check()) {
			App::abort(401);
		}

		$id = Auth::user()->id;
		$date_now = date('Y-m-d h:i');
		$meets = DB::select("
			select * from subscribes
			join adds on adds.id = subscribes.add_id
			where subscribes.user_id = $id and subscribes.type = 'meet' and adds.date_start > '$date_now'
			order by adds.date_start asc
		");
		$meets_old = DB::select("
			select * from subscribes
			join adds on adds.id = subscribes.add_id
			where subscribes.user_id = $id and subscribes.type = 'meet' and adds.date_start < '$date_now'
			order by adds.date_start asc
		");
		$subscribes = DB::select("
			select * from subscribes
			join adds on adds.id = subscribes.add_id
			where subscribes.user_id = $id and subscribes.type = 'subscribe' and adds.date_start > '$date_now'
			order by adds.date_start asc
		");
		$subscribes_old = DB::select("
			select * from subscribes
			join adds on adds.id = subscribes.add_id
			where subscribes.user_id = $id and subscribes.type = 'subscribe' and adds.date_start < '$date_now'
			order by adds.date_start asc
		");

		function getImage($unit) {
			if(file_exists('public/data/adds-img/' . $unit->id)) {
				return 'public/data/adds-img/' . $unit->id;
			}
			else {
				return 'public/img/noimage.jpg';
			}
		}

		foreach($meets as $unit) {
			$unit->image = getImage($unit);
		}
		foreach($meets_old as $unit) {
			$unit->image = getImage($unit);
		}
		foreach($subscribes as $unit) {
			$unit->image = getImage($unit);
		}
		foreach($subscribes_old as $unit) {
			$unit->image = getImage($unit);
		}

		return view(
			'user/cabinet',
			[
				'meets' => $meets,
				'meets_old' => $meets_old,
				'subscribes' => $subscribes,
				'subscribes_old' => $subscribes_old,
			]
		);
	}

	public function save() {
		if(!Auth::check()) {
			App::abort(401);
		}

		DB::table('users')->where(['id' => Auth::user()->id])->update([
			'name' => Input::get('name'),
            'gender' => Input::get('gender'),
            'bdate' => Input::get('bdate'),
			'tel' => Input::get('tel'),
			'contacts' => Input::get('contacts'),
			'location' => Input::get('location')
		]);

		DB::table('adds')->where(['user_id' => Auth::user()->id])->update([
			'user_name' => Input::get('name')
		]);

		if(Input::hasFile('image')) {
			Input::file('image')->move('public/data/user-img/', Auth::user()->id);
			Image::make('public/data/user-img/' . Auth::user()->id)->resize(500, null, function ($constraint) {
				$constraint->aspectRatio();
			})->save();
		}

		if(Input::get('pass1') && (Input::get('pass1') == Input::get('pass2'))) {
			DB::table('users')->where(['id' => Auth::user()->id])->update([
				'password' => bcrypt(Input::get('pass1'))
			]);
		}

		return Redirect::to('user');
	}

	public function userLogin() {
		if(!(Auth::check() && Auth::user()->admin)) {
			App::abort(401);
		}

		Auth::loginUsingId(Input::get('uid'));
		return Redirect::to('user');
	}

	public function activate($hash) {
		if($user = DB::select("select * from users where hash = '$hash'")) {
			$id = $user[0]->id;

			DB::table('users')->where(['id' => $id])->update([
				'active' => 1,
				'hash' => 'used!'
			]);

			Auth::loginUsingId($id, true);
		}

		return Redirect::to('/');
	}

	public function checkUsed() {
		$email = Input::get('email');
		if(DB::select("select * from users where email = '$email'")) {
			return 'Емаил занят';
		}
		else {
			return '';
		}
	}

}
