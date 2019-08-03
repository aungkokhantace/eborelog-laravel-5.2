<?php

namespace App\Http\Controllers;

use App\Core\Utility;

use App\Http\Requests;
use App\Models\Project;
use App\Core\ReturnMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ProjectEditRequest;
use App\Repositories\User\UserRepository;
use App\Http\Requests\ProjectEntryRequest;
use App\Repositories\Config\ConfigRepository;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\ProjectUser\ProjectUserRepository;
use App\Repositories\Project\ProjectRepositoryInterface;

class ProjectController extends Controller
{
    private $repo;

    public function __construct(ProjectRepositoryInterface $repo)
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
        $projects = $this->repo->getObjs();
        return view('project.index')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* display create form */

        // get users to display in assign_to_users section
        $configRepo = new ConfigRepository();
        $roles_to_be_assigned_to_projects = $configRepo->getRolesAssignedToProjects();

        // convert to array
        $role_id_array = explode(",", $roles_to_be_assigned_to_projects);

        $userRepo = new UserRepository();
        $users    = $userRepo->getUsersByRoles($role_id_array);

        return view('project.project')->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectEntryRequest $request)
    {
        /* store a new record */
        try {
            /*
            get all inputs to get all the user checkboxes 
         */
            $all_inputs = Input::all();

            /* get validated input for each field except user checkboxes */
            $project_id                 = (Input::has('project_id')) ? Input::get('project_id') : "";
            $name                       = (Input::has('name')) ? Input::get('name') : "";
            $client_name                = (Input::has('client_name')) ? Input::get('client_name') : "";
            $contract_number            = (Input::has('contract_number')) ? Input::get('contract_number') : "";
            $is_soil_investigation      = (Input::has('is_soil_investigation')) ? 1 : 0;
            $is_instrumentation         = (Input::has('is_instrumentation')) ? 1 : 0;
            $project_start_date         = (Input::has('project_start_date')) ? Input::get('project_start_date') : "";
            $project_completion_date    = (Input::has('project_completion_date')) ? Input::get('project_completion_date') : "";
            $notes                      = (Input::has('note')) ? Input::get('note') : "";

            /* start changing date formats to Y-m-d to store in database */
            if (isset($project_start_date)) {
                $formatted_project_start_date = date('Y-m-d', strtotime($project_start_date));
            }
            if (isset($project_completion_date)) {
                $formatted_project_completion_date = date('Y-m-d', strtotime($project_completion_date));
            }
            /* end changing date formats to Y-m-d to store in database */

            $has_wo = (Input::has('has_wo')) ? 1 : 0;

            /* start the fields that exists only if 'has_wo' is not checked */
            if (!Input::has('has_wo')) {
                $location          = (Input::has('location')) ? Input::get('location') : null;
                $number_of_bh      = (Input::has('number_of_bh')) ? Input::get('number_of_bh') : 0;

                /* start getting users section */
                /* declare array to store the value of all checkboxes */
                $all_checkbox_values = array();

                /* get value of all inputs whose name start with "permission_checked_" */
                foreach ($all_inputs as $key => $input) {
                    /* check all inputs whose key includes "user_" */
                    if (strpos($key, "user_") !== false) {
                        $index = str_replace('user_', '', $key);
                        $all_checkbox_values[$index] = $input;
                    }
                }
                /* get only user_IDs whose value is "on" */
                $checked_users = array_keys($all_checkbox_values, "on");
                /* end getting users section */

                /* start file upload (location_plan) */
                if (Input::hasFile('location_plan')) {
                    //to avoid "allowed memory size of 134217728 bytes exhausted" issue
                    ini_set('memory_limit', '256M');

                    $file                       = Input::file('location_plan');
                    $file_extension             = $file->getClientOriginalExtension();
                    $current_timestamp_string   = date('YmdHis');
                    /* set the file name to store */
                    $file_name                  = $project_id . "_location_plan_" . $current_timestamp_string . "." . $file_extension;

                    /* define path to store file */
                    $path_name                  = '/uploads/location_plans/';
                    $full_path                  = public_path() . $path_name;

                    $file_path_and_name         = $path_name . $file_name;

                    /* create the folder with write permissions if it does not exist */
                    if (!file_exists($full_path)) {
                        mkdir($full_path, 0777, true);
                    }

                    /* move file to destination folder */
                    $file->move($full_path, $file_name);
                } else {
                    $file_path_and_name = null;
                }
                /* end file upload (location_plan)*/
            }
            /* end the fields that exists only if 'has_wo' is not checked */

            /* to rollback if something is wrong, commit only after all database transactions are successful. */
            DB::beginTransaction();
            //create object
            $paramObj = new Project();
            $paramObj->project_id               = $project_id;
            $paramObj->name                     = $name;
            $paramObj->client_name              = $client_name;
            $paramObj->contract_number          = $contract_number;
            $paramObj->is_soil_investigation    = $is_soil_investigation;
            $paramObj->is_instrumentation       = $is_instrumentation;
            $paramObj->project_start_date       = $formatted_project_start_date;
            $paramObj->project_completion_date  = $formatted_project_completion_date;
            $paramObj->notes                     = $notes;

            $paramObj->has_wo                   = $has_wo;

            // bind the corresponding fields to project object only if has_wo checkbox is not checked
            if ($has_wo == 0) {
                $paramObj->location                 = $location;
                /* store file path and name in database */
                $paramObj->location_plan            = $file_path_and_name;
                $paramObj->number_of_bh             = $number_of_bh;
            }

            /* save the object using repository */
            $result = $this->repo->create($paramObj);
            if ($has_wo == 0) {
                if ($result['statusCode'] == ReturnMessage::OK) {
                    /* 
                    if project insertion was successful, 
                    proceed to project_users insertion
                    */

                    /* array to store records to be inserted into database */
                    $records = array();

                    $current_timestamp = date("Y-m-d H:i:s");
                    $current_user_id   = Utility::getCurrentUserID();

                    /* loop users */
                    foreach ($checked_users as $key => $user_id) {
                        $records[$key]['project_id']    = $result['id'];
                        $records[$key]['user_id']       = $user_id;
                        $records[$key]['project_wo_id'] = 0;
                        $records[$key]['created_by']    = $current_user_id;
                        $records[$key]['updated_by']    = $current_user_id;
                        $records[$key]['created_at']    = $current_timestamp;
                        $records[$key]['updated_at']    = $current_timestamp;
                    }

                    /* insert records into project_user table */
                    $project_user_result = DB::table('project_user')->insert($records);

                    if ($project_user_result == false) {
                        DB::rollBack();
                        return redirect()->action('ProjectController@index')->with("Project users were not assigned successfully.");
                    }
                } else {
                    DB::rollBack();
                    return redirect()->action('ProjectController@index')->with("Project was not created successfully.");
                }
            }

            /* after all transactions are succesful, commit */
            DB::commit();
            return redirect()->action('ProjectController@index')->with('status', $result['statusMessage']);
        } catch (\Exception $e) {
            /* roll back database if something went wrong */
            DB::rollBack();
            return redirect()->action('ProjectController@index')->with('status', $e->getMessage());
        }
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
        $project = $this->repo->getObjByID($id);

        /* change date formats to display in edit form */

        $project->project_start_date = date('d-m-Y', strtotime($project->project_start_date));
        $project->project_completion_date = date('d-m-Y', strtotime($project->project_completion_date));

        // get users to display in assign_to_users section
        $configRepo = new ConfigRepository();
        $roles_to_be_assigned_to_projects = $configRepo->getRolesAssignedToProjects();

        // convert to array
        $role_id_array = explode(",", $roles_to_be_assigned_to_projects);

        $userRepo = new UserRepository();
        $users    = $userRepo->getUsersByRoles($role_id_array);

        $projectUserRepo = new ProjectUserRepository();
        $project_user_IDs   = $projectUserRepo->getUserIDsByProjectID($id);

        return view('project.project')
            ->with('project', $project)
            ->with('users', $users)
            ->with('project_user_IDs', $project_user_IDs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectEditRequest $request, $id)
    {
        /* update an existing record */
        try {
            /*
            get all inputs to get all the user checkboxes 
         */
            $all_inputs = Input::all();

            /* get validated input for each field except user checkboxes */
            $project_id                 = (Input::has('project_id')) ? Input::get('project_id') : "";
            $name                       = (Input::has('name')) ? Input::get('name') : "";
            $client_name                = (Input::has('client_name')) ? Input::get('client_name') : "";
            $contract_number            = (Input::has('contract_number')) ? Input::get('contract_number') : "";
            $is_soil_investigation      = (Input::has('is_soil_investigation')) ? 1 : 0;
            $is_instrumentation         = (Input::has('is_instrumentation')) ? 1 : 0;
            $project_start_date         = (Input::has('project_start_date')) ? Input::get('project_start_date') : "";
            $project_completion_date    = (Input::has('project_completion_date')) ? Input::get('project_completion_date') : "";
            $notes                      = (Input::has('note')) ? Input::get('note') : "";

            /* start changing date formats to Y-m-d to store in database */
            if (isset($project_start_date)) {
                $formatted_project_start_date = date('Y-m-d', strtotime($project_start_date));
            }
            if (isset($project_completion_date)) {
                $formatted_project_completion_date = date('Y-m-d', strtotime($project_completion_date));
            }
            /* end changing date formats to Y-m-d to store in database */

            $has_wo = (Input::has('has_wo')) ? 1 : 0;

            /* start the fields that exists only if 'has_wo' is not checked */
            if (!Input::has('has_wo')) {
                $location          = (Input::has('location')) ? Input::get('location') : null;
                $number_of_bh      = (Input::has('number_of_bh')) ? Input::get('number_of_bh') : 0;

                /* start getting users section */
                /* declare array to store the value of all checkboxes */
                $all_checkbox_values = array();

                /* get value of all inputs whose name start with "permission_checked_" */
                foreach ($all_inputs as $key => $input) {
                    /* check all inputs whose key includes "user_" */
                    if (strpos($key, "user_") !== false) {
                        $index = str_replace('user_', '', $key);
                        $all_checkbox_values[$index] = $input;
                    }
                }

                /* get only user_IDs whose value is "on" */
                $checked_users = array_keys($all_checkbox_values, "on");
                /* end getting users section */

                /* start file upload (location_plan) */
                if (Input::hasFile('location_plan')) {
                    //to avoid "allowed memory size of 134217728 bytes exhausted" issue
                    ini_set('memory_limit', '256M');

                    $file                       = Input::file('location_plan');
                    $file_extension             = $file->getClientOriginalExtension();
                    $current_timestamp_string   = date('YmdHis');
                    /* set the file name to store */
                    /* Example file name format is "P-1_location_plan_20190802070602.pdf" */
                    /* file path is "public/uploads/location_plans/" */
                    $file_name                  = $project_id . "_location_plan_" . $current_timestamp_string . "." . $file_extension;

                    /* define path to store file */
                    $path_name                  = '/uploads/location_plans/';
                    $full_path                  = public_path() . $path_name;

                    $file_path_and_name         = $path_name . $file_name;

                    /* create the folder with write permissions if it does not exist */
                    if (!file_exists($full_path)) {
                        mkdir($full_path, 0777, true);
                    }

                    /* move file to destination folder */
                    $file->move($full_path, $file_name);
                }
                /* end file upload (location_plan)*/
            }
            /* end the fields that exists only if 'has_wo' is not checked */

            /* to rollback if something is wrong, commit only after all database transactions are successful. */
            DB::beginTransaction();

            // retrieve object to be updated
            $projectObj = $this->repo->getObjByID($id);

            $projectObj->project_id               = $project_id;
            $projectObj->name                     = $name;
            $projectObj->client_name              = $client_name;
            $projectObj->contract_number          = $contract_number;
            $projectObj->is_soil_investigation    = $is_soil_investigation;
            $projectObj->is_instrumentation       = $is_instrumentation;
            $projectObj->project_start_date       = $formatted_project_start_date;
            $projectObj->project_completion_date  = $formatted_project_completion_date;
            $projectObj->notes                     = $notes;

            $projectObj->has_wo                   = $has_wo;

            // bind the corresponding fields to project object only if has_wo checkbox is not checked
            if (isset($has_wo) && $has_wo == 0) {
                /* bind new location and number_of_bh to object */
                $projectObj->location                 = $location;
                $projectObj->number_of_bh             = $number_of_bh;

                if (Input::hasFile('location_plan')) {
                    /* check if there is a new file upload to overwrite the old one */

                    if (isset($projectObj->location_plan) && $projectObj->location_plan !== "" && $projectObj->location_plan !== null) {
                        // and if there is an old file already uploaded
                        /* delete the old file, to clear storage space */
                        unlink(public_path() . $projectObj->location_plan) or die("Couldn't delete old file");
                    }

                    /* update new file path and name in database */
                    $projectObj->location_plan            = $file_path_and_name;
                }
            }

            /* update the object using repository */
            $result = $this->repo->update($projectObj);

            if ($has_wo == 0) {
                if ($result['statusCode'] == ReturnMessage::OK) {
                    /* 
                    if project insertion was successful, 
                    proceed to project_users insertion
                    */

                    /* array to store records to be inserted into database */
                    $records = array();

                    $current_timestamp = date("Y-m-d H:i:s");
                    $current_user_id   = Utility::getCurrentUserID();

                    /* loop users */
                    foreach ($checked_users as $key => $user_id) {
                        $records[$key]['project_id']    = $id;
                        $records[$key]['user_id']       = $user_id;
                        $records[$key]['project_wo_id'] = 0;
                        $records[$key]['created_by']    = $current_user_id;
                        $records[$key]['updated_by']    = $current_user_id;
                        $records[$key]['created_at']    = $current_timestamp;
                        $records[$key]['updated_at']    = $current_timestamp;
                    }

                    /* clear project users by project_id */
                    $projectUserRepo = new ProjectUserRepository();
                    $projectUserRepo->deleteUserIDsByProjectID($id);

                    /* insert records into project_user table */
                    $project_user_result = DB::table('project_user')->insert($records);

                    if ($project_user_result == false) {
                        DB::rollBack();
                        return redirect()->action('ProjectController@index')->with("Project users were not assigned successfully.");
                    }
                } else {
                    DB::rollBack();
                    return redirect()->action('ProjectController@index')->with("Project was not created successfully.");
                }
            }

            /* after all transactions are succesful, commit */
            DB::commit();
            return redirect()->action('ProjectController@index')->with('status', $result['statusMessage']);
        } catch (\Exception $e) {
            /* roll back database if something went wrong */
            DB::rollBack();
            return redirect()->action('ProjectController@index')->with('status', $e->getMessage());
        }
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
