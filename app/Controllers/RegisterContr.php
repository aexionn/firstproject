<?php 

namespace App\Controllers;  

use App\Models\UserModel;
  
class RegisterContr extends BaseController
{
    public function index()
    {
        helper('form');
        $data = [];
        return view('Register', $data);
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
            $data = [
                'nama'     => $post['name'],
                'email'    => $post['email'],
                'password' => password_hash($post['password'], PASSWORD_DEFAULT)
            ];
            $userModel->save($data);
            return redirect()->to('/login');
        } else{
            //$data['validation'] = $this->validator;
            session()->setFlashData('regMsg', "Gagal Registrasi");
            return redirect()->back();//to('/Register', $data);
        }
          
    }
  
}

