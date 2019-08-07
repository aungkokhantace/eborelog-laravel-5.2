<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\Driller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\DrillerEditRequest;
use App\Http\Requests\DrillerEntryRequest;
use App\Repositories\Nationality\NationalityRepository;
use App\Repositories\Driller\DrillerRepositoryInterface;

class DrillerController extends Controller
{

    private $repo;

    public function __construct(DrillerRepositoryInterface $repo)
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
        $drillers = $this->repo->getObjs();
        return view('driller.index')->with('drillers', $drillers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* display create form */
        // get nationalities
        $nationalityRepo = new NationalityRepository();
        $nationalities = $nationalityRepo->getObjs();

        return view('driller.driller')->with('nationalities', $nationalities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DrillerEntryRequest $request)
    {
        /* store a new record */

        //get validated input
        $name = (Input::has('name')) ? Input::get('name') : null;
        $nric = (Input::has('nric')) ? Input::get('nric') : null;
        $permit_no = (Input::has('permit_no')) ? Input::get('permit_no') : null;
        $nationality_id = (Input::has('nationality_id')) ? Input::get('nationality_id') : null;

        //create object
        $paramObj                   = new Driller();
        $paramObj->name             = $name;
        $paramObj->nric             = $nric;
        $paramObj->permit_no        = $permit_no;
        $paramObj->nationality_id   = $nationality_id;

        // save the object using repository
        $result = $this->repo->create($paramObj);
        return redirect()->action('DrillerController@index')->with('status', $result['statusMessage']);
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
        $driller = $this->repo->getObjByID($id);

        // get nationalities
        $nationalityRepo = new NationalityRepository();
        $nationalities = $nationalityRepo->getObjs();

        return view('driller.driller')->with('driller', $driller)->with('nationalities', $nationalities);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DrillerEditRequest $request, $id)
    {
        /* update the specified object */
        //get validated input
        $name = (Input::has('name')) ? Input::get('name') : null;
        $nric = (Input::has('nric')) ? Input::get('nric') : null;
        $permit_no = (Input::has('permit_no')) ? Input::get('permit_no') : null;
        $nationality_id = (Input::has('nationality_id')) ? Input::get('nationality_id') : null;

        // retrieve object by given ID
        $paramObj                   = $this->repo->getObjByID($id);

        $paramObj->name             = $name;
        $paramObj->nric             = $nric;
        $paramObj->permit_no        = $permit_no;
        $paramObj->nationality_id   = $nationality_id;

        // update the object using repository
        $result = $this->repo->update($paramObj);

        return redirect()->action('DrillerController@index')->with('status', $result['statusMessage']);
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
        return redirect()->action('DrillerController@index')->with('status', $result['statusMessage']);
    }
}
