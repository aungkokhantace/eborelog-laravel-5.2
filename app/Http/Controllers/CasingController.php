<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\Casing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CasingEditRequest;
use App\Http\Requests\CasingEntryRequest;
use App\Repositories\Casing\CasingRepositoryInterface;

class CasingController extends Controller
{

    private $repo;

    public function __construct(CasingRepositoryInterface $repo)
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
        $casings = $this->repo->getObjs();
        return view('casing.index')->with('casings', $casings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* display create form */
        return view('casing.casing');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CasingEntryRequest $request)
    {
        /* store a new record */

        //get validated input
        $name   = (Input::has('name')) ? Input::get('name') : null;
        $od     = (Input::has('od')) ? Input::get('od') : 0.0;

        //create object
        $paramObj = new Casing();
        $paramObj->name = $name;
        $paramObj->od   = $od;

        // save the object using repository
        $result = $this->repo->create($paramObj);
        return redirect()->action('CasingController@index')->with('status', $result['statusMessage']);
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
        $casing = $this->repo->getObjByID($id);
        return view('casing.casing')->with('casing', $casing);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CasingEditRequest $request, $id)
    {
        /* update the specified object */
        //get validated input
        $name = (Input::has('name')) ? Input::get('name') : null;
        $od   = (Input::has('od')) ? Input::get('od') : 0.0;

        // get object by ID
        $paramObj = $this->repo->getObjByID($id);
        $paramObj->name = $name;
        $paramObj->od   = $od;

        // save the object using repository
        $result = $this->repo->update($paramObj);

        return redirect()->action('CasingController@index')->with('status', $result['statusMessage']);
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
        return redirect()->action('CasingController@index')->with('status', $result['statusMessage']);
    }
}
