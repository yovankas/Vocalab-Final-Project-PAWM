<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'labs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'icon', 'total_questions', 'order_number'];

    public function getCourseWithQuestions($userId)
    {
        // Get all labs with their completion status
        $builder = $this->db->table($this->table);
        $courses = $builder->select($this->table.'.*, 
                                COALESCE(up.completed_questions, 0) as completed_count,
                                COALESCE(up.status, "not_started") as status')
                        ->join('user_progress up', 
                              'up.lab_id = '.$this->table.'.id AND up.user_id = ' . (int)$userId, 
                              'left')
                        ->orderBy($this->table.'.order_number', 'ASC')
                        ->get()
                        ->getResultArray();

        // Get questions for each lab
        foreach ($courses as &$course) {
            $course['questions'] = $this->db->table('questions')
                ->where('lab_id', $course['id'])
                ->orderBy('question_number', 'ASC')
                ->get()
                ->getResultArray();
        }

        return $courses;
    }
}