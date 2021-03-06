<?php

/*
  |--------------------------------------------------------------------------
  | Confide Controller Template
  |--------------------------------------------------------------------------
  |
  | This is the default Confide controller template for controlling user
  | authentication. Feel free to change to your needs.
  |
 */

class UserController extends BaseController {

    /**
     * Displays the form for account creation
     *
     */
    public function create() {
        return View::make('auth.register');
    }

    /**
     * Stores new account
     *
     */
    public function doCreate() {
        $user = new User;

        $user->username = Input::get('username');
        $user->email = Input::get('email');
        $user->password = Input::get('password');

        // The password confirmation will be removed from model
        // before saving. This field will be used in Ardent's
        // auto validation.
        $user->password_confirmation = Input::get('password_confirmation');

        // Save if valid. Password field will be hashed before save
        $user->save();

        if ($user->id) {
            $user = User::find($user->id);
            $user->attachRole(2);
            $user->save();


            return Redirect::action('UserController@login')
                            ->with('notice', Lang::get('confide::confide.alerts.account_created'));
        } else {
            // Get validation errors (see Ardent package)
            $error = $user->errors()->all(':message');

            return Redirect::action('UserController@create')
                            ->withInput(Input::except('password'))
                            ->with('error', $error);
        }
    }

    /**
     * Displays the login form
     *
     */
    public function login() {
        if (Confide::user()) {
            return Redirect::to('/user');
        } else {
            return View::make('auth.login');
        }
    }

    /**
     * Attempt to do login
     *
     */
    public function doLogin() {
        $input = array(
            'email' => Input::get('email'), // May be the username too
            'username' => Input::get('username'), // so we have to pass both
            'password' => Input::get('password'),
            'remember' => true,
        );

        // If you wish to only allow login from confirmed users, call logAttempt
        // with the second parameter as true.
        // logAttempt will check if the 'email' perhaps is the username.
        // Get the value from the config file instead of changing the controller
        if (Confide::logAttempt($input, Config::get('confide::signup_confirm'))) {
            // Redirect the user to the URL they were trying to access before
            // caught by the authentication filter IE Redirect::guest('user/login').
            // Otherwise fallback to '/'
            // Fix pull #145
            return Redirect::intended('/user'); // change it to '/admin', '/dashboard' or something
        } else {
            $user = new User;

            // Check if there was too many login attempts
            if (Confide::isThrottled($input)) {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            } elseif ($user->checkUserExists($input) and !$user->isConfirmed($input)) {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            } else {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }

            return Redirect::action('UserController@login')
                            ->withInput(Input::except('password'))
                            ->with('error', $err_msg);
        }
    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string  $code
     */
    public function confirm($code) {
        if (Confide::confirm($code)) {
            $notice_msg = Lang::get('confide::confide.alerts.confirmation');
            return Redirect::action('UserController@login')
                            ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
            return Redirect::action('UserController@login')
                            ->with('error', $error_msg);
        }
    }

    /**
     * Displays the forgot password form
     *
     */
    public function forgotPassword() {
        return View::make('auth.forgot');
    }

    /**
     * Attempt to send change password link to the given email
     *
     */
    public function doForgotPassword() {
        if (Confide::forgotPassword(Input::get('email'))) {
            $notice_msg = Lang::get('confide::confide.alerts.password_forgot');
            return Redirect::action('UserController@login')
                            ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
            return Redirect::action('UserController@forgotPassword')
                            ->withInput()
                            ->with('error', $error_msg);
        }
    }

    /**
     * Shows the change password form with the given token
     *
     */
    public function reset_password($token) {
        return View::make('auth.reset')
                        ->with('token', $token);
    }

    /**
     * Attempt change password of the user
     *
     */
    public function do_reset_password() {
        $input = array(
            'token' => Input::get('token'),
            'password' => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation'),
        );

        // By passing an array with the token, password and confirmation
        if (Confide::resetPassword($input)) {
            $notice_msg = Lang::get('confide::confide.alerts.password_reset');
            return Redirect::action('UserController@login')
                            ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
            return Redirect::action('UserController@reset_password', array('token' => $input['token']))
                            ->withInput()
                            ->with('error', $error_msg);
        }
    }

    /**
     * Log the user out of the application.
     *
     */
    public function logout() {
        Confide::logout();

        return Redirect::to('/');
    }

    public function doDashboard() {
        $sort = (Input::get('sort') ? Input::get('sort') : 'imageid');
        $order = (Input::get('order') ? Input::get('order') : 'desc');
        return View::make('user.dashboard')
                        ->with(
                                array(
                                    'images' => User::getImages(0, 30, $order, $sort),
                                    'order' => $order,
                                    'sort' => $sort,
                                )
        );
    }

    public function accountSettings() {
        return View::make('user.account');
    }

    public function uploadFiles() {
        return View::make('user.upload');
    }

}
