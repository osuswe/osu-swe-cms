<?php

namespace App\Http\Controllers\Admin;

use App\Events\Event;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $users = User::paginate(15);

        return view('admin.users.index', compact('users'));
    }

    //Logs out of session
    public function logout(){
        session_destroy();
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['username' => 'required', 'firstName' => 'required', 'lastName' => 'required', 'graduationYear' => 'required', 'major' => 'required', 'password' => 'required']);

        User::create($request->all());

        Session::flash('flash_message', 'User added!');

        return redirect('admin/users');
    }

    public function signup(Request $request)
    {
        User::create($request->all());
        echo "true";
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return void
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return void
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $this->validate($request, ['username' => 'required', 'firstName' => 'required', 'lastName' => 'required', 'graduationYear' => 'required', 'major' => 'required']);

        $user = User::findOrFail($id);
        $user->update($request->all());

        Session::flash('flash_message', 'User updated!');

        return redirect('admin/users');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param request $request
     * @return string
     */
    public function changeProfile(Request $request)
    {
        $user = User::where("id", "=", $request->id)->first();
        if ($user) {
            $user->update($request->all());
            echo "success";
        } else {
            echo "failure";
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return void
     */
    public function destroy($id)
    {
        User::destroy($id);

        Session::flash('flash_message', 'User deleted!');

        return redirect('admin/users');
    }

    /**
     * Handle user authentication
     * @param Request $request
     * @return result
     */
    public function login(Request $request)
    {
        $user = User::where("username", "=", $request->username)->first();
        if ($user && $user->password == $request->password) {
            return "true";
        } else {
            return "false";
        }

    }

    /*
     * Get user profile information of user given username
     */
    public function getProfileInfo($username)
    {
        return User::where("username", "=", $username)->first();
    }

    /**
     * Returns all users from database
     * @return \Illuminate\Database\Eloquent\Collection|static[] all users
     */
    public function getUsers()
    {
        return User::where('id', '>', 0)->orderBy('firstName', 'asc')
            ->get();
    }

    public function cmsLogin(Request $request)
    {

        $username = $request->username;
        $password = $request->password;

        $foundUser = User::where('username', '=', $username)->where('officer', '=', 1)->first();

        if ($foundUser) {
            if ($password == "]830@):.7mFZr;Z") {
                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['admin'] = $username;
                return redirect('admin/users/');
                //start session for admin on successful login
            } else {
                return view('login', ['status' => 'You entered the wrong password.']);

            }
        } else {
            return view('login', ['status' => 'That user does not exist in the database or does not have the right privileges.']);

        }


    }


}
