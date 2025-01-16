<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $session;
    
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
    }

    public function login()
    {
        if ($this->session->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[6]'
            ];

            if ($this->validate($rules)) {
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');
                
                $user = $this->userModel->where('email', $email)->first();
                
                if ($user && password_verify($password, $user['password'])) {
                    $sessionData = [
                        'user_id' => $user['id'],
                        'email' => $user['email'],
                        'username' => $user['username'],
                        'logged_in' => true
                    ];
                    
                    $this->session->set($sessionData);
                    return redirect()->to('/dashboard');
                }
                
                $this->session->setFlashdata('error', 'Invalid login credentials');
                return redirect()->back()->withInput();
            }
        }

        return view('auth/login');
    }

    public function register()
    {
        helper(['form']);

        if ($this->request->getMethod() === 'post') {
            // Debug: Print posted data
            log_message('debug', 'Posted data: ' . print_r($this->request->getPost(), true));

            // Your validation rules...
            $rules = [
                'username' => 'required|min_length[3]|max_length[20]|is_unique[users.username]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]'
            ];

            if ($this->validate($rules)) {
                $userData = [
                    'username' => $this->request->getPost('username'),
                    'email' => $this->request->getPost('email'),
                    'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'full_name' => $this->request->getPost('username'), // Using username as full_name
                    'profile_image' => 'default.jpg'
                ];

                // Debug: Print prepared data
                log_message('debug', 'Attempting to insert: ' . print_r($userData, true));

                try {
                    if ($this->userModel->insert($userData)) {
                        log_message('info', 'User registered successfully');
                        session()->setFlashdata('success', 'Registration successful! Please login.');
                        return redirect()->to(base_url('login'));
                    } else {
                        log_message('error', 'Database errors: ' . print_r($this->userModel->errors(), true));
                        session()->setFlashdata('error', 'Registration failed. Database error.');
                        return redirect()->back()->withInput();
                    }
                } catch (\Exception $e) {
                    log_message('error', 'Exception: ' . $e->getMessage());
                    session()->setFlashdata('error', 'Registration failed: ' . $e->getMessage());
                    return redirect()->back()->withInput();
                }
            } else {
                // Debug: Print validation errors
                log_message('debug', 'Validation errors: ' . print_r($this->validator->getErrors(), true));
                return redirect()->back()
                    ->with('validation', $this->validator)
                    ->withInput();
            }
        }

        return view('auth/register');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('login');
    }
}