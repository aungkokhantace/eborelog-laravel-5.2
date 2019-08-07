<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\NationalityEditRequest;
use App\Http\Requests\NationalityEntryRequest;
use App\Repositories\Nationality\NationalityRepositoryInterface;

class NationalityController extends Controller
{

    private $repo;

    public function __construct(NationalityRepositoryInterface $repo)
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
        $nationalities = $this->repo->getObjs();
        return view('nationality.index')->with('nationalities', $nationalities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* display create form */
        return view('nationality.nationality');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NationalityEntryRequest $request)
    {
        /* store a new record */

        //get validated input
        $name = (Input::has('name')) ? Input::get('name') : "";

        //create object
        $paramObj = new Nationality();
        $paramObj->name = $name;

        // save the object using repository
        $result = $this->repo->create($paramObj);
        return redirect()->action('NationalityController@index')->with('status', $result['statusMessage']);
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
        $nationality = $this->repo->getObjByID($id);
        return view('nationality.nationality')->with('nationality', $nationality);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NationalityEditRequest $request, $id)
    {
        /* update the specified object */
        //get validated input
        $name = (Input::has('name')) ? Input::get('name') : "";

        // get object by ID
        $paramObj = $this->repo->getObjByID($id);
        $paramObj->name = $name;

        // save the object using repository
        $result = $this->repo->update($paramObj);

        return redirect()->action('NationalityController@index')->with('status', $result['statusMessage']);
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
        return redirect()->action('NationalityController@index')->with('status', $result['statusMessage']);
    }
}
