<?php

namespace App\Controllers;

class Courses extends BaseController
{
    protected $courseModel;
    protected $progressModel;
    protected $labSectionModel;

    public function __construct()
    {
        $this->courseModel = new \App\Models\CourseModel();
        $this->progressModel = new \App\Models\ProgressModel();
        $this->labSectionModel = new \App\Models\LabSectionModel();
    }

    public function index()
    {
        // Check if user is logged in
        if (!session()->get('user_id')) {
            return redirect()->to('/login');
        }

        // Get user's progress
        $progress = $this->progressModel->getProgressByUser(session()->get('user_id'));

        // Get course details including sections
        $courses = $this->courseModel->findAll();

        // Create a lookup array for progress data
        $progressLookup = [];
        foreach ($progress as $item) {
            $progressLookup[$item['lab_id']] = $item['completed_count'];
        }

        // Prepare courses data with progress
        $coursesWithProgress = [];
        foreach ($courses as $course) {
            $sections = $this->labSectionModel->getLabSections($course['id']);
            $courseData = [
                'id' => $course['id'],
                'name' => $course['name'],
                'icon' => $course['icon'],
                'total_questions' => $course['total_questions'],
                'completed_count' => isset($progressLookup[$course['id']]) ? $progressLookup[$course['id']] : 0,
                'sections' => $sections
            ];
            $coursesWithProgress[] = $courseData;
        }

        // Pass data to the view
        return view('courses/index', [
            'courses' => $coursesWithProgress
        ]);
    }
}