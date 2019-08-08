<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\DrillingCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\DrillingCompanyEditRequest;
use App\Http\Requests\DrillingCompanyEntryRequest;
use App\Repositories\DrillingCompany\DrillingCompanyRepositoryInterface;

class DrillingCompanyController extends Controller
{

    private $repo;

    public function __construct(DrillingCompanyRepositoryInterface $repo)
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
        $drilling_companies = $this->repo->getObjs();
        return view('drilling_company.index')->with('drilling_companies', $drilling_companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* display create form */
        return view('drilling_company.drilling_company');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DrillingCompanyEntryRequest $request)
    {
        /* store a new record */

        //get validated input
        $name = (Input::has('name')) ? Input::get('name') : "";

        //create object
        $paramObj = new DrillingCompany();
        $paramObj->name = $name;

        // save the object using repository
        $result = $this->repo->create($paramObj);
        return redirect()->action('DrillingCompanyController@index')->with('status', $result['statusMessage']);
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
        $drilling_company = $this->repo->getObjByID($id);
        return view('drilling_company.drilling_company')->with('drilling_company', $drilling_company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DrillingCompanyEditRequest $request, $id)
    {
        /* update the specified object */
        //get validated input
        $name = (Input::has('name')) ? Input::get('name') : "";

        // get object by ID
        $paramObj = $this->repo->getObjByID($id);
        $paramObj->name = $name;

        // save the object using repository
        $result = $this->repo->update($paramObj);

        return redirect()->action('DrillingCompanyController@index')->with('status', $result['statusMessage']);
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
        return redirect()->action('DrillingCompanyController@index')->with('status', $result['statusMessage']);
    }
}
