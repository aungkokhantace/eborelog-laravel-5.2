<?php

namespace App\Http\Controllers;

use Auth;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Repositories\Role\RoleRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Config\ConfigRepository;
use App\Repositories\Nationality\NationalityRepository;
use App\User;
use App\Http\Requests\UserEntryRequest;
use App\Http\Requests\UserEditRequest;

class UserController extends Controller
{
    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
            retrieve all users and display
         */
        $users = $this->repo->getObjs();
        return view('user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* display entry form */
        // get roles
        $roleRepo = new RoleRepository();
        $roles = $roleRepo->getObjs();

        // get nationalities
        $nationalityRepo = new NationalityRepository();
        $nationalities = $nationalityRepo->getObjs();

        return view('user.user')
            ->with('roles', $roles)
            ->with('nationalities', $nationalities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserEntryRequest $request)
    {
        /* store a new record */
        //get validated input
        $name           = (Input::has('name')) ? Input::get('name') : "";
        $email          = (Input::has('email')) ? Input::get('email') : "";
        $phone          = (Input::has('phone')) ? Input::get('phone') : "";
        $nric           = (Input::has('nric')) ? Input::get('nric') : "";
        $permit_no      = (Input::has('permit_no')) ? Input::get('permit_no') : "";
        $nationality_id = (Input::has('nationality_id')) ? Input::get('nationality_id') : "";
        $role_id        = (Input::has('role_id')) ? Input::get('role_id') : "";

        /* 
        * When a user is created, his/her password is set as defined in 'config' table
        * He/she can later change password
        */
        // get default object from config table
        $configRepo = new ConfigRepository();
        $password = $configRepo->getDefaultUserPassword();

        //create object
        $paramObj = new User();
        $paramObj->name             = $name;
        $paramObj->email            = $email;
        $paramObj->password         = bcrypt($password); //encrypt and store the password
        $paramObj->phone            = $phone;
        $paramObj->nric             = $nric;
        $paramObj->permit_no        = $permit_no;
        $paramObj->nationality_id   = $nationality_id;
        $paramObj->role_id          = $role_id;

        // save the object using repository
        $result = $this->repo->create($paramObj);

        return redirect()->action('UserController@index')->with('status', $result['statusMessage']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /* display edit form */
        $user = $this->repo->getObjByID($id);

        // get roles
        $roleRepo = new RoleRepository();
        $roles = $roleRepo->getObjs();

        // get nationalities
        $nationalityRepo = new NationalityRepository();
        $nationalities = $nationalityRepo->getObjs();

        return view('user.user')
            ->with('user', $user)
            ->with('roles', $roles)
            ->with('nationalities', $nationalities);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        /* update a given record */
        //get validated input
        $name           = (Input::has('name')) ? Input::get('name') : "";
        $email          = (Input::has('email')) ? Input::get('email') : "";
        $phone          = (Input::has('phone')) ? Input::get('phone') : "";
        $nric           = (Input::has('nric')) ? Input::get('nric') : "";
        $permit_no      = (Input::has('permit_no')) ? Input::get('permit_no') : "";
        $nationality_id = (Input::has('nationality_id')) ? Input::get('nationality_id') : "";
        $role_id        = (Input::has('role_id')) ? Input::get('role_id') : "";

        // retrieve object to be updated
        $userObj = $this->repo->getObjByID($id);

        // bind parameters to userObj
        $userObj->name             = $name;
        $userObj->email            = $email;
        $userObj->phone            = $phone;
        $userObj->nric             = $nric;
        $userObj->permit_no        = $permit_no;
        $userObj->nationality_id   = $nationality_id;
        $userObj->role_id          = $role_id;

        // update the object using repository
        $result = $this->repo->update($userObj);

        return redirect()->action('UserController@index')->with('status', $result['statusMessage']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
