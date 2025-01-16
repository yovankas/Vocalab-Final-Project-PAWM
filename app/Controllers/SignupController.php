<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\UserModel;
  
class SignupController extends Controller
{
    protected $userModel;
    
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    
    public function index()
    {
        helper(['form']);
        return view('auth/register');
    }
  
    public function store()
    {
        helper(['form']);
        $rules = [
            'username' => [
                'rules' => 'required|min_length[3]|max_length[20]|is_unique[users.username]',
                'errors' => [
                    'required' => 'Username is required',
                    'min_length' => 'Username must be at least 3 characters long',
                    'max_length' => 'Username cannot exceed 20 characters',
                    'is_unique' => 'This username is already taken'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Please enter a valid email address',
                    'is_unique' => 'This email is already registered'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must be at least 6 characters long'
                ]
            ]
        ];
          
        if($this->validate($rules)) {
            try {
                $data = [
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'password_hash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'full_name' => $this->request->getVar('username'),
                    'profile_image' => 'default.jpg'
                ];

                if ($this->userModel->save($data)) {
                    session()->setFlashdata('success', 'Registration successful! Please login.');
                    return redirect()->to(base_url('login'));
                } else {
                    session()->setFlashdata('error', 'Registration failed. Please try again.');
                    return redirect()->back()->withInput();
                }
            } catch (\Exception $e) {
                log_message('error', 'Registration error: ' . $e->getMessage());
                session()->setFlashdata('error', 'Registration failed. Please try again.');
                return redirect()->back()->withInput();
            }
        } else {
            return view('auth/register', [
                'validation' => $this->validator
            ]);
        }
    }
}