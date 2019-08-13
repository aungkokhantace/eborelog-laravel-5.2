<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\CoringMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CoringMethodEditRequest;
use App\Http\Requests\CoringMethodEntryRequest;
use App\Repositories\CoringMethod\CoringMethodRepositoryInterface;

class CoringMethodController extends Controller
{

    private $repo;

    public function __construct(CoringMethodRepositoryInterface $repo)
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
        $coring_methods = $this->repo->getObjs();
        return view('coring_method.index')->with('coring_methods', $coring_methods);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* display create form */
        return view('coring_method.coring_method');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CoringMethodEntryRequest $request)
    {
        /* store a new record */

        //get validated input
        $name = (Input::has('name')) ? Input::get('name') : null;

        //create object
        $paramObj                           = new CoringMethod();
        $paramObj->name                     = $name;

        // save the object using repository
        $result = $this->repo->create($paramObj);
        return redirect()->action('CoringMethodController@index')->with('status', $result['statusMessage']);
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
        $coring_method = $this->repo->getObjByID($id);
        return view('coring_method.coring_method')->with('coring_method', $coring_method);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CoringMethodEditRequest $request, $id)
    {
        /* update the specified object */
        //get validated input
        $name                   = (Input::has('name')) ? Input::get('name') : null;

        // get object by ID
        $paramObj       = $this->repo->getObjByID($id);
        $paramObj->name = $name;

        // save the object using repository
        $result = $this->repo->update($paramObj);

        return redirect()->action('CoringMethodController@index')->with('status', $result['statusMessage']);
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
        return redirect()->action('CoringMethodController@index')->with('status', $result['statusMessage']);
    }
}
