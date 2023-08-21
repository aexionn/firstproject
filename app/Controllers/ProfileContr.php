<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProfileContr extends BaseController
{
    public function profile()
    {
        $session = session();
        $id = $session->get('id');
        $model = model(UserModel::class);
        $data['user'] = $model->getWhere(['id_user' => $id])->getResultArray();
        return view('UserProfile', $data);
    }

    public function editUserData($id_user)
    {
        $model = model(UserModel::class);
        $data = $this->request->getPost();
        $model->update($id_user, $data);
        return redirect()->to('/userProfile')->with('userEditMsg', 'Data berhasil diubah'); 
    }

    public function editUserPassword($id_user)
    {
        $rules = [
            'password'      => ['required', 'min_length[4]', 'max_length[50]', 'matches[confpassword]'],
            'confpassword'  => ['matches[password]'],
        ];

        $data = $this->request->getPost();

        if($this->validate($rules)){
            $model = model(UserModel::class);
            $dataUser = [
                'password'   => password_hash($data['password'], PASSWORD_DEFAULT),
            ];
            var_dump($dataUser);
            // $userModel->update($id_user, $data);
            // return redirect()->to('/userProfile')->with('userEditMsg', 'Data berhasil diubah'); 
        } else{
            //$data['validation'] = $this->validator;
            session()->setFlashData('userEditMsg', "Data gagal diubah");
            return redirect()->to('/userProfile'); 
        }
    }

    public function deleteUser($id)
    {
        $model = model(UserModel::class);
        $model->delete($id);
        session()->remove('id');
        return redirect()->to('/login');
    }
}
