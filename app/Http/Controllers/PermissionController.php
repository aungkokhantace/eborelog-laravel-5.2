<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\PermissionEntryRequest;
use App\Http\Requests\PermissionEditRequest;
use App\Repositories\Permission\PermissionRepositoryInterface;
use Illuminate\Support\Facades\Input;

class PermissionController extends Controller
{
	private $repo;

	public function __construct(PermissionRepositoryInterface $repo)
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
		$permissions = $this->repo->getObjs();
		return view('permission.index')->with('permissions', $permissions);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		/* display create form */
		return view('permission.permission');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(PermissionEntryRequest $request)
	{
		/* store a new record */

		//get validated input
		$module         = (Input::has('permission_module_name')) ? Input::get('permission_module_name') : "";
		$action         = (Input::has('permission_action')) ? Input::get('permission_action') : "";
		$route_name     = (Input::has('route_name')) ? Input::get('route_name') : "";
		$method         = (Input::has('method')) ? Input::get('method') : "";
		$description    = (Input::has('description')) ? Input::get('description') : "";

		//create object
		$paramObj = new Permission();
		$paramObj->module       = $module;
		$paramObj->action       = $action;
		$paramObj->method       = $method;
		$paramObj->description  = $description;
		$paramObj->route_name   = $route_name;

		// save the object using repository
		$result = $this->repo->create($paramObj);
		return redirect()->action('PermissionController@index')->with('status', $result['statusMessage']);
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
		$permission = $this->repo->getObjByID($id);
		return view('permission.permission')->with('permission', $permission);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(PermissionEditRequest $request, $id)
	{
		/* update the specified object */
		//get validated input
		$module         = (Input::has('permission_module_name')) ? Input::get('permission_module_name') : "";
		$action         = (Input::has('permission_action')) ? Input::get('permission_action') : "";
		$route_name     = (Input::has('route_name')) ? Input::get('route_name') : "";
		$method         = (Input::has('method')) ? Input::get('method') : "";
		$description    = (Input::has('description')) ? Input::get('description') : "";

		// get object by ID
		$paramObj = $this->repo->getObjByID($id);
		$paramObj->module       = $module;
		$paramObj->action       = $action;
		$paramObj->method       = $method;
		$paramObj->description  = $description;
		$paramObj->route_name   = $route_name;

		// save the object using repository
		$result = $this->repo->update($paramObj);

		return redirect()->action('PermissionController@index')->with('status', $result['statusMessage']);
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
		return redirect()->action('PermissionController@index')->with('status', $result['statusMessage']);
	}
}
