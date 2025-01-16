<?php

namespace App\Models;

use CodeIgniter\Model;

class QuestionModel extends Model
{
    protected $table = 'questions';  // Assuming your table name is 'questions'
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'lab_id',
        'question_number',
        'question_type',
        'content',
        'image_url',
        'correct_answer',
        'context_sentence',
        'correct_trivia',
        'incorrect_trivia',
        'options'
    ]; 

    // Get questions for a specific section (1 or 2) of a lab
    public function getQuestionsBySection($labId, $section)
    {
        return $this->where('lab_id', $labId)
                    ->where('question_number', $section)
                    ->orderBy('question_number', 'ASC')
                    ->findAll();
    }
}