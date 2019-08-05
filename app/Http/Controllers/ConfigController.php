<?php

namespace App\Http\Controllers;

use Session;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Repositories\Config\ConfigRepository;

class ConfigController extends Controller
{
    private $repo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ConfigRepository $repo)
    {
        $this->middleware('auth');
        $this->repo = $repo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

        $configs      = $this->repo->getAllConfig();

        if (is_null($configs) || count($configs) == 0) {
            /* for the case where the configs table is empty */
            $configs = array();
            $configs["default_user_password"] = "";
            $configs["roles_assigned_to_projects"] = "";
            return view('config.config')->with('configs', $configs);
        }

        $tempConfigs = array();
        foreach ($configs as $config) {
            $tempCode = $config->code;
            $tempValue = $config->value;
            $tempConfigs[$tempCode] = $tempValue;
        }

        if (!array_key_exists("default_user_password", $tempConfigs)) {
            $tempConfigs["default_user_password"] = "";
        }

        if (!array_key_exists("roles_assigned_to_projects", $tempConfigs)) {
            $tempConfigs["roles_assigned_to_projects"] = "";
        }

        return view('config.config')->with('config', $tempConfigs);
    }

    public function update(Request $request)
    {

        $default_user_password = Input::get('default_user_password');

        try {
            $loginUserId = 1;
            $sessionObj = session('user');
            if (isset($sessionObj)) {
                $userSession = session('user');
                $loginUserId = $userSession['id'];
            }
            $updated_at = date('Y-m-d H:m:i');

            DB::statement("DELETE FROM `config` WHERE `code` = 'default_user_password'");
            DB::statement("INSERT INTO `config` (code,type,value,description,updated_by,updated_at) VALUES ('default_user_password','setting','$default_user_password','Default password for creating users',$loginUserId,'$updated_at')");

            return redirect()->action('ConfigController@edit')->with("status", "Success! config is updated");
        } catch (Exception $e) {
            return redirect()->action('Core\ConfigController@edit')->with("status", $e->getMessage());
        }
    }
}
