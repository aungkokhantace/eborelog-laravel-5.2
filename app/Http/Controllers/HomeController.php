<?php

namespace App\Http\Controllers;

use Session;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use App\Repositories\Project\ProjectRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* declare repositories */
        $projectRepo    = new ProjectRepository();
        // $boreHoleRepo = new BoreHoleRepository();
        $userRepo       = new UserRepository();

        /* get counts */
        $project_count = count($projectRepo->getObjs());
        $bore_hole_count = 112;
        $user_count = count($userRepo->getObjs());

        return view('home')
            ->with('project_count', $project_count)
            ->with('bore_hole_count', $bore_hole_count)
            ->with('user_count', $user_count);
    }
}
