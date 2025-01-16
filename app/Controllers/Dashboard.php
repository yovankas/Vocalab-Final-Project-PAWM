<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    protected $courseModel;
    protected $progressModel;

    public function __construct()
    {
        $this->courseModel = new \App\Models\CourseModel();
        $this->progressModel = new \App\Models\ProgressModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');
        $courses = $this->progressModel->getProgressByUser($userId);

        return view('dashboard/index', ['labs' => $courses]);
    }
}