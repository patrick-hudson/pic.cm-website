<?php

class AdminController extends Controller {

    public function doDashboard() {

        $images = DB::table('user_images')
                        ->join('users', 'users.id', '=', 'user_images.userid')
                        ->join('user_upload_addresses', 'user_upload_addresses.addressid', '=', 'user_images.addressid')
                        ->select('user_images.imageid', 'user_images.mimetype', 'user_images.uploaddate', 'user_images.imagesize', 'users.username', 'user_upload_addresses.address')
                        ->orderBy('user_images.imageid', 'desc')
                        ->skip(0)->take(5)->get();

        return View::make('admin.dashboard')
                        ->with(
                                array(
                                    'images' => $images,
                                )
        );
    }

    public function listUsers() {
        $users = DB::table('users')->paginate(50);
        return View::make('admin.user_list')->with(array('users' => $users));
    }

    public function listUsersSearch() {
        if (Input::get('username')) {
            $users = DB::table('users')
                    ->where('username', 'like', '%' . Input::get('username') . '%')
                    ->paginate(50);
            return View::make('admin.user_list')->with(array('users' => $users));
        } else {
            return Redirect::action('AdminController@listUsers')
                            ->with('error', array('Please enter a valid username'));
        }
    }

    public function listUserImages() {
        $sort = (Input::get('sort') ? Input::get('sort') : 'imageid');
        $order = (Input::get('order') ? Input::get('order') : 'desc');
        if (Input::get('userid')) {
            return View::make('admin.user_images')
                            ->with(
                                    array(
                                        'images' => User::getImages(Input::get('userid'), 30, $order, $sort),
                                        'order' => $order,
                                        'sort' => $sort,
            ));
        } else {
            return View::make('admin.user_images')
                            ->with(
                                    array(
                                        'images' => User::getImages(-1, 30, $order, $sort),
                                        'order' => $order,
                                        'sort' => $sort,
            ));
        }
    }

    public function editUser() {
        $user = User::find(Input::get('userid'));
        $global_roles = DB::table('roles')->get();

        $roles = array();
        foreach ($global_roles as $grole) {
            $roles[$grole->id]['id'] = $grole->id;
            $roles[$grole->id]['name'] = $grole->name;
            $roles[$grole->id]['assigned'] = ($user->hasRole($grole->name) ? true : false);
        }

        return View::make('admin.user_edit')->with(array('user' => $user, 'roles' => $roles));
    }

    public function doEditUser() {
        $user = User::find(Input::get('userid'));
        $global_roles = DB::table('roles')->get();
        $roles = array();
        foreach ($global_roles as $grole) {
            $roles[$grole->id] = $grole->name;
        }

        $user->roles()->detach();
        $user->attachRole(Input::get('roles'));

        $user->username = Input::get('username');
        $user->email = Input::get('email');
        $user->confirmed = Input::get('confirmed');

        if ($user->updateUniques()) {
            return Redirect::action('AdminController@listUsers')
                            ->with('notice', 'User settings for ' . $user->username . ' saved!');
        } else {
            $error = $user->errors()->all(':message');
            return Redirect::action('AdminController@editUser', array('userid' => $user->id))
                            ->with('error', $error);
        }
    }

}
