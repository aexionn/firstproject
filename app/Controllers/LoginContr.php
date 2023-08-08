<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginContr extends BaseController
{
    public function index()
    {
        return view('Login');
    }

    public function login()
    {
        if (session('id')) {
            return redirect()->to('/dashboard');
        }
        return redirect()->to('/login');
    }

    public function auth()
    {
        $session = session();
        $model = model(UserModel::class);
        $post = $this->request->getPost();
        $data = $model->where('email', $post['email'])->first();
        if ($data){
            if(password_verify($post['password'], $data['password'])){
                $ses_data = [
                    'id'       => $data['id_user'],
                    'nama'     => $data['nama'],
                    'email'    => $data['email'],
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard');
            } else{
                $session->setFlashdata('logMsg', 'Kata Sandi Salah');
                return redirect()->back();
            }
        } else{
            $session->setFlashdata('logMsg', 'Email Tidak ditemukan');
            return redirect()->back();
        }
    }

    public function logout()
    {
        $session = session();
        $session->remove('id');
        return redirect()->to('/login');
    }

}