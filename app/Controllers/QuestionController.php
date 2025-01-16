<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\QuestionModel;
use App\Models\ProgressModel;
use App\Models\LabSectionModel;
use App\Models\QuestionProgressModel;

class QuestionController extends BaseController
{
    protected $db;
    protected $questionModel;
    protected $progressModel;
    protected $labSectionModel;
    protected $questionProgressModel;

    public function __construct()
    {
        $this->db = db_connect(); 
        $this->questionModel = new QuestionModel();
        $this->progressModel = new ProgressModel();
        $this->labSectionModel = new LabSectionModel();
        $this->questionProgressModel = new QuestionProgressModel();
    }

    public function show($labId, $sectionSlug)
    {
        $labSection = $this->labSectionModel->getSectionBySlug($labId, $sectionSlug);
        
        if (!$labSection) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Debugging statement
        log_message('debug', 'Lab Section: ' . json_encode($labSection));

        // Get questions for this section
        $questions = $this->questionModel->getQuestionsBySection($labSection['lab_id'], $labSection['section_number']);
        
        if (empty($questions)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Debugging statement
        log_message('debug', 'Questions: ' . json_encode($questions));

        return view('questions/show', [
            'section' => $labSection,
            'question' => $questions[0]
        ]);
    }

    public function check()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON([
                'error' => 'Invalid request method'
            ]);
        }

        $questionId = $this->request->getPost('question_id');
        $answer = $this->request->getPost('answer');

        if (!$questionId || !$answer) {
            return $this->response->setStatusCode(400)->setJSON([
                'error' => 'Missing required fields'
            ]);
        }

        $question = $this->questionModel->find($questionId);

        if (!$question) {
            return $this->response->setStatusCode(404)->setJSON([
                'error' => 'Question not found'
            ]);
        }

        $isCorrect = strtolower(trim($answer)) === strtolower(trim($question['correct_answer']));
        $userId = session()->get('user_id');

        try {
            $this->db->transStart();
            
            if ($isCorrect) {
                $this->questionProgressModel->insert([
                    'user_id' => $userId,
                    'lab_id' => $question['lab_id'],
                    'question_id' => $questionId,
                    'completed_at' => date('Y-m-d H:i:s'),
                    'answer_given' => $answer,
                    'is_correct' => true
                ]);

                // Update user progress
                $completedQuestions = $this->questionProgressModel->where([
                    'user_id' => $userId,
                    'lab_id' => $question['lab_id'],
                    'is_correct' => true
                ])->countAllResults();

                $this->progressModel->updateProgress($userId, $question['lab_id'], $completedQuestions);
            }

            $this->db->transComplete();

            return $this->response->setJSON([
                'correct' => $isCorrect,
                'correct_trivia' => $isCorrect ? $question['correct_trivia'] : null,
                'csrf_hash' => csrf_hash() // Include new CSRF hash
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error saving progress: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'error' => 'Failed to save progress',
                'csrf_hash' => csrf_hash()
            ]);
        }
    }
}