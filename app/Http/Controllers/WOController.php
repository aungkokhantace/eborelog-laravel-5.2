<?php

namespace App\Http\Controllers;

use App\Models\WO;

use App\Core\Utility;
use App\Http\Requests;
use App\Core\ReturnMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\WOEntryRequest;
use Illuminate\Support\Facades\Input;
use App\Repositories\User\UserRepository;
use App\Repositories\Config\ConfigRepository;
use App\Repositories\WO\WORepositoryInterface;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\ProjectUser\ProjectUserRepository;
use App\Repositories\WO\WORepository;

class WOController extends Controller
{
    private $repo;

    public function __construct(WORepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($project_id)
    {
        /* retrieve the records and return to list view */
        $wos = $this->repo->getObjsByProjectID($project_id);
        return view('wo.index')
            ->with('wos', $wos)
            ->with('project_id', $project_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($project_id)
    {
        $projectRepo = new ProjectRepository();
        $project = $projectRepo->getObjByID($project_id);
        $project_id_name = $project->project_id;

        // get users to display in assign_to_users section
        $configRepo = new ConfigRepository();
        $roles_to_be_assigned_to_projects = $configRepo->getRolesAssignedToProjects();

        // convert to array
        $role_id_array = explode(",", $roles_to_be_assigned_to_projects);

        $userRepo = new UserRepository();
        $users    = $userRepo->getUsersByRoles($role_id_array);

        return view('wo.wo')
            ->with('project_id', $project_id)
            ->with('users', $users)
            ->with('project_id_name', $project_id_name);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WOEntryRequest $request)
    {
        try {
            /*
            get all inputs to get all the user checkboxes 
         */
            $all_inputs = Input::all();

            /* get validated input for each field except user checkboxes */
            $project_id                 = (Input::has('project_id')) ? Input::get('project_id') : 0;
            $wo_number                       = (Input::has('wo_number')) ? Input::get('wo_number') : null;
            $number_of_bh                = (Input::has('number_of_bh')) ? Input::get('number_of_bh') : null;
            $location            = (Input::has('location')) ? Input::get('location') : null;
            $wo_start_date         = (Input::has('wo_start_date')) ? Input::get('wo_start_date') : null;
            $wo_completion_date    = (Input::has('wo_completion_date')) ? Input::get('wo_completion_date') : null;

            /* start changing date formats to Y-m-d to store in database */
            if (isset($wo_start_date)) {
                $formatted_wo_start_date = date('Y-m-d', strtotime($wo_start_date));
            } else {
                $formatted_wo_start_date = null;
            }
            if (isset($wo_completion_date)) {
                $formatted_wo_completion_date = date('Y-m-d', strtotime($wo_completion_date));
            } else {
                $formatted_wo_completion_date = null;
            }
            /* end changing date formats to Y-m-d to store in database */

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
                $file_name                  = "project_" . $project_id . "_wo_" . $wo_number . "_location_plan_" . $current_timestamp_string . "." . $file_extension;

                /* define path to store file */
                $path_name                  = '/uploads/wo_location_plans/';
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

            /* to rollback if something is wrong, commit only after all database transactions are successful. */
            DB::beginTransaction();
            //create object
            $paramObj = new WO();
            $paramObj->project_id          = $project_id;
            $paramObj->wo_number           = $wo_number;
            $paramObj->number_of_bh        = $number_of_bh;
            $paramObj->location            = $location;
            $paramObj->location_plan       = $file_path_and_name;
            $paramObj->wo_start_date       = $formatted_wo_start_date;
            $paramObj->wo_completion_date  = $formatted_wo_completion_date;

            /* save the object using repository */
            $result = $this->repo->create($paramObj);

            if ($result['statusCode'] == ReturnMessage::OK) {
                /* 
                    if WO insertion was successful, 
                    proceed to project_users insertion
                    */

                /* array to store records to be inserted into database */
                $records = array();

                $current_timestamp = date("Y-m-d H:i:s");
                $current_user_id   = Utility::getCurrentUserID();

                /* loop users */
                foreach ($checked_users as $key => $user_id) {
                    $records[$key]['project_id']    = $project_id;
                    $records[$key]['user_id']       = $user_id;
                    $records[$key]['project_wo_id'] = $result['id'];
                    $records[$key]['created_by']    = $current_user_id;
                    $records[$key]['updated_by']    = $current_user_id;
                    $records[$key]['created_at']    = $current_timestamp;
                    $records[$key]['updated_at']    = $current_timestamp;
                }

                /* insert records into project_user table */
                $projectUserRepo = new ProjectUserRepository();
                $project_user_result   = $projectUserRepo->insertProjectUsersByArray($records);

                if ($project_user_result == false) {
                    DB::rollBack();
                    return redirect()->action('WOController@index', [$project_id])->with("Project WO users were not assigned successfully.");
                }
            } else {
                DB::rollBack();
                return redirect()->action('WOController@index', [$project_id])->with("Project was not created successfully.");
            }

            /* after all transactions are succesful, commit */
            DB::commit();
            return redirect()->action('WOController@index', [$project_id])->with('status', $result['statusMessage']);
        } catch (\Exception $e) {
            /* roll back database if something went wrong */
            DB::rollBack();
            return redirect()->action('WOController@index', [$project_id])->with('status', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($project_id, $id)
    {
        $projectRepo = new ProjectRepository();
        $project = $projectRepo->getObjByID($project_id);
        $project_id_name = $project->project_id;

        /* retrieve the object by id and display edit form */
        $wo = $this->repo->getObjByID($id);

        /* change date formats to display in edit form */
        $wo->wo_start_date = date('d-m-Y', strtotime($wo->wo_start_date));
        $wo->wo_completion_date = date('d-m-Y', strtotime($wo->wo_completion_date));

        // get users to display in assign_to_users section
        $configRepo = new ConfigRepository();
        $roles_to_be_assigned_to_projects = $configRepo->getRolesAssignedToProjects();

        // convert to array
        $role_id_array = explode(",", $roles_to_be_assigned_to_projects);

        /* get all users */
        $userRepo = new UserRepository();
        $users    = $userRepo->getUsersByRoles($role_id_array);

        /* get user IDs assigned to project */
        $projectUserRepo = new ProjectUserRepository();
        $wo_user_IDs   = $projectUserRepo->getUserIDsByProjectIDAndWoID($project_id, $id);

        if (isset($wo_user_IDs) && count($wo_user_IDs) > 0) {
            /* 
                if there is any user IDs for current project,
                get user objects by those IDs
                 */
            $userRepo       = new UserRepository();
            $wo_users  = $userRepo->getUsersByIDs($wo_user_IDs);
        } else {
            /* set project->users to empty array */
            $project_users = [];
        }

        /* 
        if project start date or completion date is equal to "01-01-1970" 
        change date to null
        */
        if ($wo->wo_start_date == "01-01-1970") {
            $wo->wo_start_date = null;
        }
        if ($wo->wo_completion_date == "01-01-1970") {
            $wo->wo_completion_date = null;
        }

        return view('wo.detail')
            ->with('project_id', $project_id)
            ->with('project_id_name', $project_id_name)
            ->with('wo', $wo)
            ->with('users', $users)
            ->with('wo_users', $wo_users)
            ->with('wo_user_IDs', $wo_user_IDs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($project_id, $id)
    {
        $projectRepo = new ProjectRepository();
        $project = $projectRepo->getObjByID($project_id);
        $project_id_name = $project->project_id;

        /* retrieve the object by id and display edit form */
        $wo = $this->repo->getObjByID($id);

        /* change date formats to display in edit form */
        $wo->wo_start_date = date('d-m-Y', strtotime($wo->wo_start_date));
        $wo->wo_completion_date = date('d-m-Y', strtotime($wo->wo_completion_date));

        // get users to display in assign_to_users section
        $configRepo = new ConfigRepository();
        $roles_to_be_assigned_to_projects = $configRepo->getRolesAssignedToProjects();

        // convert to array
        $role_id_array = explode(",", $roles_to_be_assigned_to_projects);

        /* get all users */
        $userRepo = new UserRepository();
        $users    = $userRepo->getUsersByRoles($role_id_array);

        /* get user IDs assigned to project */
        $projectUserRepo = new ProjectUserRepository();
        $wo_user_IDs   = $projectUserRepo->getUserIDsByProjectIDAndWoID($project_id, $id);

        /* 
        if project start date or completion date is equal to "01-01-1970" 
        change date to null
        */
        if ($wo->wo_start_date == "01-01-1970") {
            $wo->wo_start_date = null;
        }
        if ($wo->wo_completion_date == "01-01-1970") {
            $wo->wo_completion_date = null;
        }

        return view('wo.wo')
            ->with('project_id', $project_id)
            ->with('project_id_name', $project_id_name)
            ->with('wo', $wo)
            ->with('users', $users)
            ->with('wo_user_IDs', $wo_user_IDs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $project_id, $id)
    {
        /* update an existing record */
        try {
            /*
            get all inputs to get all the user checkboxes 
         */
            $all_inputs = Input::all();

            /* get validated input for each field except user checkboxes */
            $project_id                 = (Input::has('project_id')) ? Input::get('project_id') : 0;
            $wo_number                       = (Input::has('wo_number')) ? Input::get('wo_number') : null;
            $number_of_bh                = (Input::has('number_of_bh')) ? Input::get('number_of_bh') : null;
            $location            = (Input::has('location')) ? Input::get('location') : null;
            $wo_start_date         = (Input::has('wo_start_date')) ? Input::get('wo_start_date') : null;
            $wo_completion_date    = (Input::has('wo_completion_date')) ? Input::get('wo_completion_date') : null;

            /* start changing date formats to Y-m-d to store in database */
            if (isset($wo_start_date)) {
                $formatted_wo_start_date = date('Y-m-d', strtotime($wo_start_date));
            } else {
                $formatted_wo_start_date = null;
            }
            if (isset($wo_completion_date)) {
                $formatted_wo_completion_date = date('Y-m-d', strtotime($wo_completion_date));
            } else {
                $formatted_wo_completion_date = null;
            }
            /* end changing date formats to Y-m-d to store in database */

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
                $file_name                  = "project_" . $project_id . "_wo_" . $wo_number . "_location_plan_" . $current_timestamp_string . "." . $file_extension;

                /* define path to store file */
                $path_name                  = '/uploads/wo_location_plans/';
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

            /* to rollback if something is wrong, commit only after all database transactions are successful. */
            DB::beginTransaction();

            /* retrieve object by id */
            $woRepo = new WORepository();
            $woObj  = $woRepo->getObjByID($id);

            $woObj->project_id          = $project_id;
            $woObj->wo_number           = $wo_number;
            $woObj->number_of_bh        = $number_of_bh;
            $woObj->location            = $location;
            // $woObj->location_plan       = $file_path_and_name;
            $woObj->wo_start_date       = $formatted_wo_start_date;
            $woObj->wo_completion_date  = $formatted_wo_completion_date;

            /* if there is file upload */
            if (Input::hasFile('location_plan')) {
                /* check if there is a new file upload to overwrite the old one */
                if (isset($woObj->location_plan) && $woObj->location_plan !== "" && $woObj->location_plan !== null) {
                    // and if there is an old file already uploaded
                    /* delete the old file, to clear storage space */
                    // unlink(public_path() . $woObj->location_plan) or die("Couldn't delete old file");
                }

                /* update new file path and name in database */
                $woObj->location_plan            = $file_path_and_name;
            }
            /* save the object using repository */
            $result = $this->repo->update($woObj);

            if ($result['statusCode'] == ReturnMessage::OK) {
                /* 
                    if WO insertion was successful,
                    proceed to project_users insertion
                */

                /* array to store records to be inserted into database */
                $records = array();

                $current_timestamp = date("Y-m-d H:i:s");
                $current_user_id   = Utility::getCurrentUserID();

                /* loop users */
                foreach ($checked_users as $key => $user_id) {
                    $records[$key]['project_id']    = $project_id;
                    $records[$key]['user_id']       = $user_id;
                    $records[$key]['project_wo_id'] = $id;
                    $records[$key]['created_by']    = $current_user_id;
                    $records[$key]['updated_by']    = $current_user_id;
                    $records[$key]['created_at']    = $current_timestamp;
                    $records[$key]['updated_at']    = $current_timestamp;
                }

                /* clear project users by project_id and wo_id */
                $projectUserRepo = new ProjectUserRepository();
                $projectUserRepo->deleteUserIDsByProjectIDAndWoID($project_id, $id);

                /* insert records into project_user table */
                $projectUserRepo = new ProjectUserRepository();
                $project_user_result   = $projectUserRepo->insertProjectUsersByArray($records);

                if ($project_user_result == false) {
                    DB::rollBack();
                    return redirect()->action('WOController@index', [$project_id])->with("Project WO users were not assigned successfully.");
                }
            } else {
                DB::rollBack();
                return redirect()->action('WOController@index', [$project_id])->with("Project was not created successfully.");
            }

            /* after all transactions are succesful, commit */
            DB::commit();
            return redirect()->action('WOController@index', [$project_id])->with('status', $result['statusMessage']);
        } catch (\Exception $e) {
            /* roll back database if something went wrong */
            DB::rollBack();
            return redirect()->action('WOController@index', [$project_id])->with('status', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($project_id, $id)
    {
        try {
            DB::beginTransaction();
            /* 
            to destroy a WO,
            project_users table(which is a child of WO table) required to be deleted first
            **** WO will be deleted only after successful deletion of all children
            */

            /* soft-delete project users by project_id */
            $projectUserRepo = new ProjectUserRepository();
            $project_user_deletion_result = $projectUserRepo->softDeleteUserIDsByProjectIDAndWoID($project_id, $id);

            /* 
            if project_user deletion is successful,
            then proceed to delete project
            */

            /* destroy the model using repository */
            $result = $this->repo->destroy($id);

            if ($result["statusCode"] !== ReturnMessage::OK) {
                /* if something went wrong, rollback the database */
                DB::rollBack();
                return redirect()->action('WOController@index', [$project_id])->with('status', $result["statusMessage"]);
            }

            /* after all transaction finished successfully, commit the database */
            DB::commit();

            return redirect()->action('WOController@index', [$project_id])->with('status', $result['statusMessage']);
        } catch (\Exception $e) {
            /* if something went wrong, rollback the database */
            DB::rollBack();
            return redirect()->action('WOController@index', [$project_id])->with('status', $e->getMessage());
        }
    }
}
