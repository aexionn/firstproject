<?php 

namespace App\Controllers;  

use App\Models\UserModel;
use CodeIgniter\I18n\Time;

  
class RegisterContr extends BaseController
{
    public function index()
    {
        helper('form');
        $data = [];
        return view('/register', $data);
    }
  
    public function store()
    {
        helper('form');
        $rules = [
            'name'          => ['required', 'min_length[4]', 'max_length[50]'],
            'email'         => ['required', 'min_length[4]', 'max_length[100]', 'valid_email', 'is_unique[user.email]'],
            'password'      => ['required', 'min_length[4]', 'max_length[50]'],
            'confpassword'  => ['matches[password]'],
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
            //$data['validation'] = $this->validator;
            session()->setFlashData('regMsg', "Gagal Registrasi");
            return redirect()->back();//to('/Register', $data);
        }
          
    }
  
}

