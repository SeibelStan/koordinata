<?php namespace App\Http\Controllers;

use App;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Cast\Object_;
use Input;
use Redirect;
use DB;
use Auth;
use Mail;
use Image;

class AddsController extends Controller {

	public function __construct() {

		$this->middleware('guest');
	}

	public function get() {
		$limit = 'limit ' . 15;
		$page = Input::get('page') ? Input::get('page') : 1;
		$offset = 'offset ' . ($page - 1) * $limit;

		$selects = Input::get('selects');
		$filters = Input::get('filters');
		Session::put('selects', $selects);
		Session::put('filters', $filters);

		$search = Input::get('search');
		$dates = Input::get('dates') ? explode(' ', Input::get('dates')) : false;

		$where = "where ";

		if($selects['category'] != -1) {
			$where .= "category = " . $selects['category'] . ' and ';
		}

		if($selects['location'] != -1) {
			$where .= "location = " . $selects['location'] . ' and ';
		}
		else {
			if(Auth::check()) {
				switch($filters['location']) {
					case '1': {
						$where .= "location = " . Auth::user()->location . ' and ';
						break;
					}
					case '2': {
						$where .= "anglomeration = " . Auth::user()->anglomeration . " and ";
						break;
					}
				}
			}
		}

		switch($filters['payment']) {
			case '1': {
				$where .= "price = 0 and ";
				break;
			}
			case '2': {
				$where .= "price > 0 and ";
				break;
			}
		}
        $filters['age'] = (int)$filters['age'] ? $filters['age'] : 0;
		$where .= "age >= " . $filters['age'];

		if($filters['gender'] >= 0) {
			$where .= "and gender = " . $filters['gender'];
		}

		if($filters['ability'] >= 0) {
			$where .= " and ability = " . $filters['ability'];
		}

		if($search) {
			$where .= " and match(title,content,location_name,user_name) against('$search')";
		}

		if($dates) {
			$where .= " and (";
			foreach($dates as $date) {
				$where .= "date_start like '$date%' or ";
			}
			$where = preg_replace('/ or $/', '', $where);
			$where .= ")";
		}

		$where .= " and active";
		$where .= " and date_start > '" . date('Y-m-d H:i') . "'";

		$order = "order by price asc, age asc, title";

		$sql = "select * from adds $where $order $limit $offset";

		if(1 == 1) {
			$units = DB::select($sql);
			foreach($units as $unit) {
				if(file_exists('public/data/adds-img/' . $unit->id)) {
					$unit->image = 'public/data/adds-img/' . $unit->id;
				}
				else {
					$unit->image = 'public/img/noimage.jpg';
				}
				$unit->date_start_canonic = date('Y m d h i', strtotime($unit->date_start));
				$unit->date_start = date('j M h:i', strtotime($unit->date_start));
 			}
			return json_encode($units);
		}
		else {
			return $sql;
		}
	}

	public function single($id) {
		if(!$units = DB::select("select * from adds where id = $id limit 1")) {
			App::abort(404);
		}

		$unit = $units[0];

		if(file_exists('public/data/adds-img/' . $unit->id)) {
			$unit->image = 'public/data/adds-img/' . $unit->id;
		}
		else {
			$unit->image = 'public/img/noimage.jpg';
		}
		$unit->date_start_canonic = date('Y m d h i', strtotime($unit->date_start));
		$unit->date_start = date('j M h:i', strtotime($unit->date_start));

		function getImage($unit) {
			if(file_exists('public/data/user-img/' . $unit->user_id)) {
				return 'public/data/user-img/' . $unit->user_id;
			}
			else {
				return 'public/img/noimage.jpg';
			}
		}

        $subscribes = DB::select("select count(*) as count from subscribes where type = 'subscribe' and add_id = $unit->id")[0]->count;
        $meets = DB::select("select count(*) as count from subscribes where type = 'meet' and add_id = $unit->id")[0]->count; 

		//comments
		$comments_count = DB::select("select count(*) as count from comments where post_type = 'adds' and post_id = $unit->id")[0]->count;
		$comments = DB::select("select * from comments where post_type = 'adds' and post_id = $unit->id and reply_id = 0 order by id desc");
		foreach($comments as $comment) {
			$comment->replies = DB::select("select * from comments where reply_id = $comment->id order by id desc");
			$comment->image = getImage($comment);
			foreach($comment->replies as $reply) {
				$reply->image = getImage($reply);
			}
		}
		//

		return view(
			'adds/single',
			[
				'type' => 'adds',
				'unit' => $unit,
                'subscribes' => $subscribes,
                'meets' => $meets,
				'comments' => $comments,
				'comments_count' => $comments_count
			]
		);
	}

	public function subscribe() {
		if(!Auth::check()) {
			App::abort(401);
		}

		$user_id = Auth::user()->id;
		$add_id = Input::get('id');
		$type = Input::get('type');
		if(!DB::select("select * from subscribes where user_id = $user_id and add_id = $add_id and type = '$type'")) {
			DB::table('subscribes')->insert([
				'user_id' => $user_id,
				'add_id' => $add_id,
				'type' => $type
			]);
		}
		return 'ok';
	}

	public function unsubscribe() {
		if(!Auth::check()) {
			App::abort(401);
		}

		$user_id = Auth::user()->id;
		$add_id = Input::get('id');
		$type = Input::get('type');
		DB::delete("delete from subscribes where user_id = $user_id and add_id = $add_id and type = '$type'");
		return 'ok';
	}

	public function checkSubscribe() {
		if(!Auth::check()) {
			App::abort(401);
		}

		$user_id = Auth::user()->id;
		$add_id = Input::get('id');
		$type = Input::get('type');
		if(DB::select("select * from subscribes where user_id = $user_id and add_id = $add_id and type = '$type'")) {
			return 1;
		}
		else {
			return 0;
		}
	}

	function getSubscribers() {
		if(!Auth::check()) {
			App::abort(401);
		}

		$add_id = Input::get('id');
		$type = Input::get('type');
		$users = DB::select("
			select * from users
			join subscribes on subscribes.user_id = users.id
			where subscribes.add_id = $add_id and subscribes.type = '$type'
		");
		return json_encode($users);
	}

	function removeSubscriber() {
		if(!Auth::check()) {
			App::abort(401);
		}

		$id = Input::get('id');
		$uid = Auth::user()->id;
		$subscribe = DB::select("select * from subscribes where id = $id")[0];
		if(DB::select("select * from adds where id = $subscribe->add_id and user_id = $uid")) {
			DB::delete("delete from subscribes where id = $id");
		}
		return 'ok';
	}

	public function add() {
		if(!Auth::check()) {
			App::abort(401);
		}

		$locations = DB::select("select * from locations order by title");
		$cats = json_decode(DB::select("select * from staff where name = 'addscat'")[0]->content);
		usort($cats, function ($a, $b) {
			return strcmp($a->title, $b->title);
		});

		return view(
			'adds/add',
			[
				'cats' => $cats,
				'locations' => $locations
			]
		);
	}

	public function edit($id) {
		$unit = DB::select("select * from adds where id = $id limit 1")[0];

		if(!(Auth::user()->admin || Auth::user()->id == $unit->user_id)) {
			App::abort(401);
		}

		$locations = DB::select("select * from locations order by title");
		$cats = json_decode(DB::select("select * from staff where name = 'addscat'")[0]->content);
		usort($cats, function ($a, $b) {
			return strcmp($a->title, $b->title);
		});
		return view(
			'adds/add',
			[
				'unit' => $unit,
				'cats' => $cats,
				'locations' => $locations,
			]
		);
	}

	public function post() {
		if(!Auth::check()) {
			App::abort(401);
		}

		$update = Input::get('update');
		$location = DB::select("select * from locations where id = " . Input::get('location'))[0];

		if($update) {
			$lastid = Input::get('id');
			$user_id = Auth::user()->id;
			if(!DB::select("select * from adds where id = $lastid and user_id = $user_id")) {
				if(!Auth::user()->admin) {
					return App::abort(401);
				}
			}
			DB::table('adds')->where('id', $lastid)->update([
				'category' => Input::get('category'),
				'location' => $location->id,
				'location_name' => $location->title,
				'anglomeration' => $location->anglomeration,
				'title' => Input::get('title'),
				'price' => Input::get('price'),
				'age' => (int)Input::get('age') ? Input::get('age') : 0,
				'gender' => Input::get('gender'),
				'ability' => Input::get('ability'),
				'places' => Input::get('places'),
				'date_start' => Input::get('date_start'),
				'address' => Input::get('address'),
				'contacts' => Input::get('contacts'),
				'short' => Input::get('short'),
				'content' => Input::get('content'),
			]);
		}
		else {
			$lastid = DB::table('adds')->insertGetId([
				'category' => Input::get('category'),
				'location' => $location->id,
				'location_name' => $location->title,
				'anglomeration' => $location->anglomeration,
				'title' => Input::get('title'),
				'price' => Input::get('price'),
				'age' => (int)Input::get('age') ? Input::get('age') : 0,
				'gender' => Input::get('gender'),
				'ability' => Input::get('ability'),
				'places' => Input::get('places'),
				'date_start' => Input::get('date_start'),
				'address' => Input::get('address'),
				'contacts' => Input::get('contacts'),
				'short' => Input::get('short'),
				'content' => Input::get('content'),
				'user_id' => Auth::user()->id,
				'user_name' => Auth::user()->name
			]);
		}

		if($lastid) {
			if(Input::hasFile('image')) {
				Input::file('image')->move('public/data/adds-img', $lastid);
				Image::make('public/data/adds-img/' . $lastid)->resize(1200, null, function ($constraint) {
					$constraint->aspectRatio();
				})->save();
			}

			if(!$update) {
				$data = [
					'id' => $lastid,
					'title' => Input::get('title')
				];
				define('USEREMAIL', Auth::user()->email);
				Mail::send('emails/adds-post', $data, function ($message) {
					$message->from('admin@koordinata.kz', 'Координата.kz');
					$message->subject('Размещено новое объявление');
					$message->to(USEREMAIL);
				});
			}
		}

		return Redirect::to('redirect?path=adds/single/' . $lastid);
	}

	public function remove($id) {
		if(!(Auth::check() && Auth::user()->admin)) {
			App::abort(401);
		}

		DB::delete("delete from adds where id = $id");
		DB::delete("delete from comments where post_id = $id");
		return Redirect::to('adds');
	}

}
