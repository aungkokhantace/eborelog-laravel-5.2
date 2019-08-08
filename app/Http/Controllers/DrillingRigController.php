<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\DrillingRig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\DrillingRigEditRequest;
use App\Http\Requests\DrillingRigEntryRequest;
use App\Repositories\DrillingRig\DrillingRigRepositoryInterface;

class DrillingRigController extends Controller
{

    private $repo;

    public function __construct(DrillingRigRepositoryInterface $repo)
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
        $drilling_rigs = $this->repo->getObjs();
        return view('drilling_rig.index')->with('drilling_rigs', $drilling_rigs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* display create form */
        return view('drilling_rig.drilling_rig');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DrillingRigEntryRequest $request)
    {
        /* store a new record */

        //get validated input
        $rig_no                 = (Input::has('rig_no')) ? Input::get('rig_no') : null;
        $model                  = (Input::has('model')) ? Input::get('model') : null;
        $year_made              = (Input::has('year_made')) ? Input::get('year_made') : null;
        $lm_cert_no             = (Input::has('lm_cert_no')) ? Input::get('lm_cert_no') : null;
        $noise_reduce_cylinder  = (Input::has('noise_reduce_cylinder')) ? Input::get('noise_reduce_cylinder') : null;

        //create object
        $paramObj                           = new DrillingRig();
        $paramObj->rig_no                   = $rig_no;
        $paramObj->model                    = $model;
        $paramObj->year_made                = $year_made;
        $paramObj->lm_cert_no               = $lm_cert_no;
        $paramObj->noise_reduce_cylinder    = $noise_reduce_cylinder;

        // save the object using repository
        $result = $this->repo->create($paramObj);
        return redirect()->action('DrillingRigController@index')->with('status', $result['statusMessage']);
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
        $drilling_rig = $this->repo->getObjByID($id);
        return view('drilling_rig.drilling_rig')->with('drilling_rig', $drilling_rig);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DrillingRigEditRequest $request, $id)
    {
        /* update the specified object */
        //get validated input
        $rig_no                 = (Input::has('rig_no')) ? Input::get('rig_no') : null;
        $model                  = (Input::has('model')) ? Input::get('model') : null;
        $year_made              = (Input::has('year_made')) ? Input::get('year_made') : null;
        $lm_cert_no             = (Input::has('lm_cert_no')) ? Input::get('lm_cert_no') : null;
        $noise_reduce_cylinder  = (Input::has('noise_reduce_cylinder')) ? Input::get('noise_reduce_cylinder') : null;

        // get object by ID
        $paramObj                           = $this->repo->getObjByID($id);
        $paramObj->rig_no                   = $rig_no;
        $paramObj->model                    = $model;
        $paramObj->year_made                = $year_made;
        $paramObj->lm_cert_no               = $lm_cert_no;
        $paramObj->noise_reduce_cylinder    = $noise_reduce_cylinder;

        // save the object using repository
        $result = $this->repo->update($paramObj);

        return redirect()->action('DrillingRigController@index')->with('status', $result['statusMessage']);
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
        return redirect()->action('DrillingRigController@index')->with('status', $result['statusMessage']);
    }
}
