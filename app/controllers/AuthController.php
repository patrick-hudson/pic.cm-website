<?php

class AuthController extends Controller {

    public function doLogout() {
        Session::flush(); // clear the session
        return Redirect::to('/m/login'); // redirect the user to the login screen
    }

    public function doLogin() {
        if (Input::server("REQUEST_METHOD") == "POST") {
            if (Auth::attempt(array('email' => Input::get("email"), 'password' => Input::get("password")), Input::get('remember')))
                return Redirect::to('/m');
            else
                Session::flash('message', 'The information you entered does not match our system');
        }
        return View::make('auth.login');
    }

    public function doRegister() {
        if (Input::server("REQUEST_METHOD") == "POST") {
            if (!Input::get('agree')) {
                Session::flash('message', 'You did not agree to our <a href="/tos" target="_blank">Terms of Service</a>');
            } else {
                $results = DB::select('select count(id) as `cnt` from user where email = ?', array(Input::get("email")));
                if ($results[0]->cnt > 0) {
                    Session::flash('message', 'The email address provided is already in use');
                } else {
                    $results = DB::select('select count(id) as `cnt` from user where username = ?', array(Input::get("username")));
                    if ($results[0]->cnt > 0) {
                        Session::flash('message', 'The username provided is already in use');
                    } else {
                        if (Input::get('password') != Input::get('password_again')) {
                            Session::flash('message', 'The passwords provided do not match');
                        } else {
                            Session::flash('message', 'Registration successful, please login to continue');
                            $user = new User;
                            $user->username = Input::get('username');
                            $user->email = Input::get('email');
                            $user->password = Hash::make(Input::get('password'));
                            $user->save();
                            return Redirect::to('/m/login'); // redirect the user to the login screen
                        }
                    }
                }
            }
        }
        return View::make('auth.register');
    }

    /**
     * Display the password reminder view.
     *
     * @return Response
     */
    public function getRemind() {
        return View::make('auth.remind');
    }

    /**
     * Handle a POST request to remind a user of their password.
     *
     * @return Response
     */
    public function postRemind() {
        switch ($response = Password::remind(Input::only('email'))) {
            case Password::INVALID_USER:
                return Redirect::back()->with('error', Lang::get($response));

            case Password::REMINDER_SENT:
                return Redirect::back()->with('status', Lang::get($response));
        }
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string  $token
     * @return Response
     */
    public function getReset($token = null) {
        if (is_null($token))
            App::abort(404);

        return View::make('auth.reset')->with('token', $token);
    }

    /**
     * Handle a POST request to reset a user's password.
     *
     * @return Response
     */
    public function postReset() {
        $credentials = Input::only(
                        'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function($user, $password) {
                    $user->password = Hash::make($password);

                    $user->save();
                });

        switch ($response) {
            case Password::INVALID_PASSWORD:
            case Password::INVALID_TOKEN:
            case Password::INVALID_USER:
                return Redirect::back()->with('error', Lang::get($response));

            case Password::PASSWORD_RESET:
                return Redirect::to('/');
        }
    }

}
