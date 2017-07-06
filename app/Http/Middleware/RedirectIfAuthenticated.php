<?php namespace App\Http\Middleware;

use Closure;
use DB;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Session;

class RedirectIfAuthenticated {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard $auth
	 * @return void
	 */
	public function __construct(Guard $auth) {
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		if($this->auth->check()) {
			$user_id = Auth::user()->id;

			if(!DB::select("select * from users where id = $user_id and active = 1")) {
				if(!preg_match('/activate/', $request)) {
					Session::put('message', 'Ссылка для активации отправлена на почту');
					return new RedirectResponse(url('auth/logout'));
				}
			}
		}

		return $next($request);
	}

}
