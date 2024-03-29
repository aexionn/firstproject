<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;

class ProfileContr extends BaseController
{
    
    public function profile()
    {
        $session = session();
        $model = model(UserModel::class);
        $id = $session->get('id');
        $data = [
            'user' => $model->getWhere(['id_user' => $id])->getResultArray(),
            'validation' => \Config\Services::validation(),
        ];
        return view('UserProfile', $data);
    }

    public function editUserData($id_user)
    {
        $model = model(UserModel::class);
        $data = $this->request->getPost();

        if(!empty($data)){
            $model->update($id_user, $data);
            return redirect()->to('/userProfile')->with('userEditMsg', 'Data berhasil diubah'); 
        }else{
            return redirect()->to('/userProfile')->with('userEditMsgGagal', 'Data gagal diubah'); 
        }

    }

    public function editUserPassword($id_user)
    {
        $passUpdate = Time::now('Asia/Shanghai');
        // $rules = [
        //     'oldpassword'  => ['required', 'min_length[4]', 'max_length[50]', 'matches[confpassword]'],
        //     'newpassword'  => ['matches[password]'],
        // ];
        $data = $this->request->getPost();
        $model = model(UserModel::class);
        $builder = $model->table('user');
        $passDb = $builder->select('password')->where('id_user', $id_user)->first();
        // dd($passDb);

        if(password_verify($data['oldpassword'], $passDb['password'])){
            $model = model(UserModel::class);
            $dataUser = [
                'password'   => password_hash($data['newpassword'], PASSWORD_DEFAULT),
                'password_updated_at' => $passUpdate,
            ];
            // var_dump($dataUser);
            $model->update($id_user, $dataUser);
            return redirect()->to('/userProfile')->with('userEditMsg', 'Kata Sandi berhasil diubah'); 
        } else{
            return redirect()->to('/userProfile')->with('userEditMsgGagal', 'Kata Sandi gagal diubah'); 
        }
    }

    public function editUserAvatar($id_user)
    {
        $model = model(UserModel::class);
        $validationRule = [
            'avatar' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[avatar]',
                    'is_image[avatar]',
                    'mime_in[avatar,image/jpg,image/jpeg,image/gif,image/PNG,image/webp]',
                    'max_size[avatar,1024]',
                    'max_dims[avatar,1024,768]',
                ],
            ],
        ];
        if (!$this->validate($validationRule)) {
            return redirect()->to('/userProfile')->with('errors', $this->validator->getErrors());
        }

        $img = $this->request->getFile("avatar");
        $img->move('image');
        $img_name = ['image' => $img->getName()];
        $model->update($id_user, $img_name);
        return redirect()->to('/userProfile')->with('userEditMsg', 'Foto berhasil diubah');

        // if (! $img->hasMoved()) {
        //     $filepath = WRITEPATH . 'uploads/' . $img->store();
        //     return redirect()->to('/userProfile')->with('uploaded_fileinfo', new File($filepath));
        // }

        // return redirect()->to('/userProfile')->with('errors', 'The file has already been moved.');
    }

    public function removeAvatar($id_user)
    {
        $model = model(UserModel::class);
        $avatar = $model->find($id_user);

        if ($avatar['image'] == '') {
            return redirect()->to('/userProfile')->with('avatarErr', 'Anda tidak memiliki foto profil!');
        }
        unlink('image/' . $avatar['image']);

        $newAvatar = ['image' => null];
    
        if ($model->update($id_user, $newAvatar)) {
            return redirect()->to('/userProfile')->with('userEditMsg', 'Foto berhasil dihapus!');
        }
    }
    
    public function deleteUser($id)
    {
        $model = model(UserModel::class);

        unlink('image/' . $model['image']);
        $model->delete($id);
        session()->remove('id');
        return redirect()->to('/login');
    }
}
