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
        session();
        $kategori = model(KategoriModel::class);
        $list = [
            'data' => $kategori->findAll(),
            'validation' => \Config\Services::validation(),
        ];
        return view('AddNote', $list);
    }

    public function saveProcess()
    {
        $rules = [
            'title'   => [
                'rules'  => 'required',
                'errors' => [
                    'required'  => 'Judul Harus Diisi'
                ]
            ],
            'kategori' => [
                'rules'  => 'required',
                'errors' => [
                    'required'  => 'Kategori Harus Diisi'
                ]
            ],
            'content'  => [
                'rules'  => 'required',
                'errors' => [
                    'required'  => 'Konten Harus Diisi'
                ]
            ],
        ];

        if (!$this->request->is('post')) {
            return view('AddNote');
        }
           
        if ($this->validate($rules)){
            $model = model(NoteModel::class);
            $post = $this->request->getPost();

            $data = [
                'title' => $post['title'],
                'content' => $post['content'],
                'id_kategori' => $post['kategori'],
                'id_user' => $post['id_user']
            ];

            $model->insert($data); 
            return redirect()->to('/saveNote')->with('addMsg', 'Data berhasil disimpan');
        }else{
            // $validation = \Config\Services::validation();
            // return redirect()->to('/saveNote')->withInput()->with('validation', $validation);
            return redirect()->to('/saveNote')->withInput();
        }
    }

    public function edit($id=null)
    {
        session();
        $kategori = model(KategoriModel::class);
        $note = model(NoteModel::class);
        if ($id != null) {
            $query = $note->join('kategori', 'diary.id_kategori=kategori.id_kategori', 'inner')->join('user', 'diary.id_user=user.id_user', 'inner')->getWhere(['id' => $id]);
             if ($query->resultID->num_rows > 0) {
                 $data = [
                    'note' => $query->getRow(),
                    'kategori' => $kategori->findAll(),
                    'validation' => \Config\Services::validation(),
                 ];
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
        $rules = [
            'title'   => [
                'rules'  => 'required',
                'errors' => [
                    'required'  => 'Judul Harus Diisi'
                ]
            ],
            'id_kategori' => [
                'rules'  => 'required',
                'errors' => [
                    'required'  => 'Kategori Harus Diisi'
                ]
            ],
            'content'  => [
                'rules'  => 'required',
                'errors' => [
                    'required'  => 'Konten Harus Diisi'
                ]
            ],
        ];

        if ($this->validate($rules)) {
            $model = model(NoteModel::class);
            $data = $this->request->getPost();
            // var_dump($data);
            $model->update($id, $data);
            return redirect()->to('/dashboard')->with('editMsg', 'Data berhasil diubah'); 
        }else{
            return redirect()->back()->with('editMsgGagal', 'Data gagal diubah'); 
        }
    }

    public function delete($id)
    {
        $model = model(NoteModel::class);
        $model->delete($id); 
        return redirect()->to('/dashboard');
    }

    // public function search()
    // {
    //     $model = model(NoteModel::class);
    //     $title = $this->request->getVar('cari');
    //     $searchRow['row'] = $model->join("kategori", "kategori.id_kategori = diary.id_kategori", "inner")->where("title", $title)->first();        
    //     return view('SearchRes', $searchRow);
    // }

    public function search(){
        $pager = \Config\Services::pager();
        $model = model(NoteModel::class);
        $session = session();
        $id = $session->get('id');
        $kata_kunci = $this->request->getVar('cari');
        // $query = $model->query("SELECT * FROM diary INNER JOIN kategori ON diary.id_kategori=kategori.id_kategori WHERE title LIKE '%" . $kata_kunci . "%'"); 

        if (!empty($kata_kunci)) {
            $data['hasil'] = $model->select('*')->join("kategori", "kategori.id_kategori = diary.id_kategori", "inner")->where("id_user", $id)->like('title', $kata_kunci)->orLike('content', $kata_kunci)->paginate(3, 'note');
            $data ['pager'] = $model->pager;
        } else {
            $data['hasil'] = array();
        }
        $data['kata_kunci'] = $kata_kunci;
        return view('SearchRes', $data);
    }
}