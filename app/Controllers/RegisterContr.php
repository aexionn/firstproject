<?php 

namespace App\Controllers;  

use App\Models\UserModel;
use CodeIgniter\I18n\Time;

  
class RegisterContr extends BaseController
{
    protected $helpers = ['form'];

    public function index()
    {
        $data = [
            'validation' => \Config\Services::validation(),
        ];
       
        return view('/register', $data);
    }
  
    public function store()
    {
        
        $rules = [
            'name'          => [
                'rules' => 'required|min_length[4]|max_length[50]',
                'errors' => [
                    'required' => 'nama harus diisi',
                    'min_length' => 'nama harus lebih dari 4 karakter',
                    'max_length' => 'nama harus kurang dari 50 karakter',
                ]
            ],
            'email'         => [
                'rules' => 'required|min_length[12]|max_length[100]|valid_email|is_unique[user.email]',
                'errors' => [
                    'required' => 'email harus diisi',
                    'min_length' => 'email harus lebih dari 12 karakter',
                    'max_length' => 'email harus kurang dari 100 karakter',
                    'valid_email' => 'email yang anda tulis setidaknya berisi karakter "@" atau "."',
                    'is_unique' => 'email sudah terdaftar',
                ]
            ],
            'password'      => [
                'rules' => 'required|min_length[4]|max_length[50]',
                'errors' => [
                    'required' => 'kata sandi harus diisi',
                    'min_length' => 'kata sandi harus lebih dari 12 karakter',
                    'max_length' => 'kata sandi harus kurang dari 100 karakter',
                ]
            ],
            'confpassword'      => [
                'rules' => 'required|matches[password]|',
                'errors' => [
                    'required' => 'pengulangan sandi harus diisi',
                    'matches' => 'pengulangan sandi tidak sama dengan kata sandi'
                ]
            ],
        ];
        $post = $this->request->getPost();
          
        if($this->validate($rules)){
            $userModel = new UserModel();
            $date = Time::now('Asia/Shanghai');
            $data = [
                'nama'       => $post['name'],
                'email'      => $post['email'],
                'password'   => password_hash($post['password'], PASSWORD_DEFAULT),
                'image'      => 'default.jpg',
                'created_at' => $date
            ];
            // var_dump($data);
            $userModel->insert($data);
            return redirect()->to('/login');
        } else{
            return redirect()->to('/')->withInput()->with('regMsg', 'Gagal Registrasi');
        }
          
    }
  
}

