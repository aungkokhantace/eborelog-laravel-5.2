<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\DrillingFluid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\DrillingFluidEditRequest;
use App\Http\Requests\DrillingFluidEntryRequest;
use App\Repositories\DrillingFluid\DrillingFluidRepositoryInterface;

class DrillingFluidController extends Controller
{

    private $repo;

    public function __construct(DrillingFluidRepositoryInterface $repo)
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
        $drilling_fluids = $this->repo->getObjs();
        return view('drilling_fluid.index')->with('drilling_fluids', $drilling_fluids);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* display create form */
        return view('drilling_fluid.drilling_fluid');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DrillingFluidEntryRequest $request)
    {
        /* store a new record */

        //get validated input
        $name = (Input::has('name')) ? Input::get('name') : null;

        //create object
        $paramObj                           = new DrillingFluid();
        $paramObj->name                     = $name;

        // save the object using repository
        $result = $this->repo->create($paramObj);
        return redirect()->action('DrillingFluidController@index')->with('status', $result['statusMessage']);
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
        $drilling_fluid = $this->repo->getObjByID($id);
        return view('drilling_fluid.drilling_fluid')->with('drilling_fluid', $drilling_fluid);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DrillingFluidEditRequest $request, $id)
    {
        /* update the specified object */
        //get validated input
        $name                   = (Input::has('name')) ? Input::get('name') : null;

        // get object by ID
        $paramObj       = $this->repo->getObjByID($id);
        $paramObj->name = $name;

        // save the object using repository
        $result = $this->repo->update($paramObj);

        return redirect()->action('DrillingFluidController@index')->with('status', $result['statusMessage']);
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
        return redirect()->action('DrillingFluidController@index')->with('status', $result['statusMessage']);
    }
}
