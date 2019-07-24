<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleEntryRequest;
use App\Http\Requests\RoleEditRequest;
use Illuminate\Support\Facades\Input;
use App\Models\Role;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\Role\RoleRepository;
use App\Core\ReturnMessage;
use Alert;
use App\Repositories\Permission\PermissionRepository;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    private $repo;

    public function __construct(RoleRepositoryInterface $repo)
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
        /* retrieve the records and return to list view */
        $roles = $this->repo->getObjs();
        return view('role.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* display create form */
        return view('role.role');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleEntryRequest $request)
    {
        /* store a new record */

        //get validated input
        $name           = (Input::has('name')) ? Input::get('name') : "";
        $description    = (Input::has('description')) ? Input::get('description') : "";

        //create object
        $paramObj = new Role();
        $paramObj->name         = $name;
        $paramObj->description  = $description;

        // save the object using repository
        $result = $this->repo->create($paramObj);
        return redirect()->action('RoleController@index')->with('status', $result['statusMessage']);
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
        /* retrieve the object by id and display edit form */
        $role = $this->repo->getObjByID($id);
        return view('role.role')->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleEditRequest $request, $id)
    // public function update(Request $request, $id)
    {
        /* update the specified object */
        //get validated input
        $name           = (Input::has('name')) ? Input::get('name') : "";
        $description    = (Input::has('description')) ? Input::get('description') : "";

        // get object by ID
        $paramObj = $this->repo->getObjByID($id);
        $paramObj->name         = $name;
        $paramObj->description  = $description;

        // save the object using repository
        $result = $this->repo->update($paramObj);

        return redirect()->action('RoleController@index')->with('status', $result['statusMessage']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* destroy the specified object */
        // destroy the model using repository
        $result = $this->repo->destroy($id);
        return redirect()->action('RoleController@index')->with('status', $result['statusMessage']);
    }

    /** 
     * Edit permissions for given role
     * **/
    public function editPermissions($id)
    {
        /* get permissions for given role */
        $permissionRepo = new PermissionRepository();
        $permissions_for_role = $permissionRepo->getPermissionsByRoleId($id);

        $all_permissions = $permissionRepo->getObjs();

        /* retrieve the object by id and display edit form */
        $role = $this->repo->getObjByID($id);

        foreach ($all_permissions as $all_permission) {
            $all_permission->checked = false;
            if (isset($permissions_for_role) && count($permissions_for_role) > 0) {
                foreach ($permissions_for_role as $permission_for_role) {
                    // if $permission_for_role is included in the all_permission_id array, set flag to true, else, false.
                    if ($all_permission->id == $permission_for_role['id']) {
                        $all_permission->checked = true;
                    }
                }
            }
        }

        return view('role.role_permission')
            ->with('role', $role)
            ->with('permissions_for_role', $permissions_for_role)
            ->with('all_permissions', $all_permissions);
    }

    /** 
     * Update permissions for given role
     * **/
    public function updatePermissions($id)
    {
        $all_inputs = Input::all();

        /* array to store the value of all checkboxes */
        $all_checkbox_values = array();

        /* get value of all inputs whose name start with "permission_checked_" */
        foreach ($all_inputs as $key => $input) {
            /* skip the _token hidden input field */
            if ($key != "_token") {
                $index = str_replace('permission_checked_', '', $key);
                $all_checkbox_values[$index] = $input;
            }
        }

        /* get only permission_ids whose value is "on" */
        $checked_permissions = array_keys($all_checkbox_values, "on");

        /* delete all old permissions for the given role */
        DB::table('role_permissions')->where('role_id', $id)->delete();

        /* array to store records to be inserted into database */
        $records = array();

        /* prepare data to insert into database */
        foreach ($checked_permissions as $key => $checked_permission) {
            $records[$key]['role_id'] = $id;
            $records[$key]['permission_id'] = $checked_permission;
        }

        /* insert updated permissions for the given role */
        DB::table('role_permissions')->insert($records);

        return redirect()->action('RoleController@index')->with('status', "Permissions updated");
    }
}
