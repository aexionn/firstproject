<?php 
namespace App\Controllers;  

use App\Models\NoteModel;
use App\Models\UserModel;
  
class NoteContr extends BaseController
{
    protected $helpers = ['form'];
    public function dashboard()
    {
        $pager = \Config\Services::pager();
        $session = session();
        $id = $session->get('id');
        $model = model(NoteModel::class);
        $data = [
            'note' => $model->join("kategori", "kategori.id_kategori = diary.id_kategori", "inner")->where("id_user", $id)->paginate(3, 'note'),
            'pager' => $model->pager,
        ];
        return view('Dashboard', $data);
    }

    public function save()
    {
        $kategori = model(KategoriModel::class);
        $list = [
            'data' => $kategori->findAll(),
            'validation' => \Config\Services::validation(),
        ];
        return view('AddNote', $list);
    }

    public function saveProcess()
    {
        $model = model(NoteModel::class);

        $rules = [
            'title'     => [
                'rules'  => 'required|is_unique[diary.title]',
                'errors' => [
                    'required' => '{field}Judul Harus Diisi',
                    'is_unique'=> '{field}Judul Sudah Terpakai',
                ]
            ],
            'category'  => [
                'rules'  => 'required',
                'errors' => 'Kategori harus dipilih'
            ],
        ];

        if (!$this->validate([
            'title'=> [
            'rules'  => 'required|is_unique[diary.title]',
            'errors' => [
                'required' => '{field}Judul Harus Diisi',
                'is_unique'=> '{field}Judul Sudah Terpakai',
            ]
        ],
        'category'  => [
            'rules'  => 'required',
            'errors' => 'Kategori harus dipilih'
        ]
        ])){
            return redirect()->to('/saveNote')->withInput();
        }

        // if (!$this->request->is('post')) {
        //     return view('AddNote');
        // }

        $post = $this->request->getPost();

        $model->insert($post);

        return redirect()->to('/saveNote')->with('addMsg', 'Data berhasil disimpan');
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
        // var_dump($data);
        $model->update($id, $data);
        return redirect()->to('/dashboard')->with('editMsg', 'Data berhasil diubah'); 
    }

    public function delete($id)
    {
        $model = model(NoteModel::class);
        $model->delete($id); 
        return redirect()->to('/dashboard');
    }

    public function search()
    {
        $model = model(NoteModel::class);
        $title = $this->request->getVar('cari');
        $searchRow['row'] = $model->join("kategori", "kategori.id_kategori = diary.id_kategori", "inner")->where("title", $title)->first();        
        return view('SearchRes', $searchRow);
    }
}