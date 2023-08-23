<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;

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
        $passUpdate = Time::now('Asia/Shanghai');
        $rules = [
            'password'      => ['required', 'min_length[4]', 'max_length[50]', 'matches[confpassword]'],
            'confpassword'  => ['matches[password]'],
        ];

        $data = $this->request->getPost();

        if($this->validate($rules)){
            $model = model(UserModel::class);
            $dataUser = [
                'password'   => password_hash($data['password'], PASSWORD_DEFAULT),
                'password_updated_at' => $passUpdate,
            ];
            // var_dump($dataUser);
            $model->update($id_user, $dataUser);
            return redirect()->to('/userProfile')->with('userEditMsg', 'Kata Sandi berhasil diubah'); 
        } else{
            session()->setFlashData('userEditMsg', "Kata Sandi gagal diubah");
            return redirect()->to('/userProfile'); 
        }
    }

    public function editUserAvatar()
    {
        $validationRule = [
            'avatar' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[avatar]',
                    'is_image[avatar]',
                    'mime_in[avatar,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[avatar,100]',
                    'max_dims[avatar,1024,768]',
                ],
            ],
        ];
        if (! $this->validate($validationRule)) {
            return redirect()->to('/userProfile')->with('errors', $this->validator->getErrors());
        }

        $img = $this->request->getFile('avatar');

        // if (! $img->hasMoved()) {
        //     $filepath = WRITEPATH . 'uploads/' . $img->store();
        //     return redirect()->to('/userProfile')->with('uploaded_fileinfo', new File($filepath));
        // }

        // return redirect()->to('/userProfile')->with('errors', 'The file has already been moved.');
    }

    public function deleteUser($id)
    {
        $model = model(UserModel::class);
        $model->delete($id);
        session()->remove('id');
        return redirect()->to('/login');
    }
}
