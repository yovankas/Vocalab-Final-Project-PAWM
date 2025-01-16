<?php 

namespace App\Models;

use CodeIgniter\Model;

class QuestionProgressModel extends Model
{
    protected $table = 'user_question_progress';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'lab_id',
        'question_id',
        'completed_at',
        'answer_given',
        'is_correct'
    ];
}