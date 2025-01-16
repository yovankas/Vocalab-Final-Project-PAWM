<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgressModel extends Model
{
    protected $table = 'user_progress';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'lab_id',
        'completed_questions',
        'status',
        'last_accessed'
    ];

    public function getProgressByUser($userId)
    {
        $db = \Config\Database::connect();
        
        // Get progress from user_question_progress
        $subquery = $db->table('user_question_progress')
            ->select('lab_id, COUNT(*) as completed_count')
            ->where('user_id', $userId)
            ->where('is_correct', 1)
            ->groupBy('lab_id');
            
        // Join with labs table to get total questions
        $query = $db->table('labs')
            ->select('labs.id as lab_id, labs.*, COALESCE(progress.completed_count, 0) as completed_count')
            ->join("({$subquery->getCompiledSelect()}) progress", 'labs.id = progress.lab_id', 'left');
            
        return $query->get()->getResultArray();
    }

    public function updateProgress($userId, $labId, $completedQuestions)
    {
        $data = [
            'user_id' => $userId,
            'lab_id' => $labId,
            'completed_questions' => $completedQuestions,
            'last_accessed' => date('Y-m-d H:i:s')
        ];

        // Get actual completed count from user_question_progress
        $questionProgress = new QuestionProgressModel();
        $actualCompleted = $questionProgress->where([
            'user_id' => $userId,
            'lab_id' => $labId,
            'is_correct' => 1
        ])->countAllResults();

        // Update status based on actual completion
        $lab = (new CourseModel())->find($labId);
        if ($actualCompleted >= $lab['total_questions']) {
            $data['status'] = 'completed';
        } else if ($actualCompleted > 0) {
            $data['status'] = 'in_progress';
        } else {
            $data['status'] = 'not_started';
        }

        // Insert or update using unique constraint
        return $this->replace($data);
    }
}