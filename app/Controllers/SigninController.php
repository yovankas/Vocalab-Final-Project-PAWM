<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\UserModel;
  
class SigninController extends Controller
{
    protected $userModel;
    
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    
    public function index()
    {
        helper(['form']);
        return view('auth/login');
    }
  
    public function authenticate()
    {
        helper(['form']);
        $rules = [
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Please enter a valid email address'
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
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            
            $user = $this->userModel->where('email', $email)->first();
            
            if ($user && password_verify($password, $user['password_hash'])) {
                $sessionData = [
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'logged_in' => true
                ];
                
                session()->set($sessionData);
                return redirect()->to('/dashboard');
            } else {
                session()->setFlashdata('error', 'Invalid login credentials');
                return redirect()->back()->withInput();
            }
        } else {
            return view('auth/login', [
                'validation' => $this->validator
            ]);
        }
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}