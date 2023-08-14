<?php 
namespace App\Controllers;  

use App\Models\NoteModel;
use App\Models\UserModel;
  
class NoteContr extends BaseController
{
    public function dashboard()
    {
        $session = session();
        $id = $session->get('id');
        $model = model(NoteModel::class);
        $data['note'] = $model->join("kategori", "kategori.id_kategori = diary.id_kategori", "inner")->getWhere(["id_user" => $id])->getResultArray();
        return view('Dashboard', $data);
    }

    public function save()
    {
        $kategori = model(KategoriModel::class);
        $list['data'] = $kategori->findAll();
        return view('AddNote', $list);
    }

    public function saveProcess()
    {
        helper('form');

        if (!$this->request->is('post')) {
            return view('Dashboard');
        }

        $post = $this->request->getPost();

        $model = model(NoteModel::class);

        $model->insert($post);

        session()->setFlashdata('addMsg', 'Data berhasil disimpan');
        return redirect()->to('/saveNote');
    }

    public function edit($id=null)
    {
        $kategori = model(KategoriModel::class);
        $note = model(NoteModel::class);
        $this->user = model(UserModel::class);
        if ($id != null) {
            $query = $note->getWhere(['id' => $id]);
             if ($query->resultID->num_rows > 0) {
                 $data['note'] = $query->getRow();
                 $data['kategori'] = $kategori->findAll();
                 $data['user'] = $this->user->findAll();
                 return view('EditNote', $data);
             } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
             }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function editProcess($id)
    {
        $model = model(NoteModel::class);
        $data = $this->request->getPost();
        var_dump($data);
        $model->update($id, $data);
        return redirect()->to('/dashboard')->with('editMsg', 'Data berhasil diubah'); 
    }

    public function delete($id)
    {
        $model = model(NoteModel::class);
        $model->delete($id); 
        return redirect()->to('/dashboard');
    }

}