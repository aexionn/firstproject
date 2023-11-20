<?php 
namespace App\Controllers;  

use CodeIgniter\I18n\Time;
use App\Models\DiaryModel;
use App\Models\UserModel;
use App\Models\KategoriModel;
  
class NoteContr extends BaseController
{
    protected $helpers = ['form'];

    public function dashboard()
    {
        helper('text');
        $pager = \Config\Services::pager();
        $model = model(DiaryModel::class);
        $katModel = model(Kategori::class);
        $OtherModel = model(OtherModel::class);
        $where = "diary.id_user = '" . session()->get('id') . "' AND diary.deleted_at IS NULL ";
        
        $entries = $model->select('diary.*, GROUP_CONCAT(kategori.kategori) AS kategoris')->join('kategori_diary', 'kategori_diary.id_diary = diary.id_diary')
        ->join('kategori', 'kategori.id_kategori = kategori_diary.id_kategori')
        ->where($where)
        ->groupBy('diary.id_diary');

        $data = [
            'note' => $entries->paginate(2, 'note'),
            'pager' => $pager,
            'softdel' => $entries->where('deleted_at IS NOT NULL')->get()->getResultArray()
        ];
        
        // dd($data);
        return view('Dashboard', $data);
       
    }

    public function save()
    {   
        session();
        $kategori = model(KategoriModel::class);
        $list = [
            'data' => $kategori->where('kategori.id_user', NULL)->orWhere('kategori.id_user', session()->get('id'))->findAll(),
            'validation' => \Config\Services::validation(),
        ];
        
        return view('AddNote', $list); 
    }

    public function edit($id=null)
    {
        session();
        $kategori = model(KategoriModel::class);
        $note = model(DiaryModel::class);

        $entries = $note->select('diary.*, GROUP_CONCAT(kategori.kategori) AS kategoris')->join('kategori_diary', 'kategori_diary.id_diary = diary.id_diary')
        ->join('kategori', 'kategori.id_kategori = kategori_diary.id_kategori')
        ->where('diary.id_diary', $id)
        ->findAll();

        $ubahKat = $note->select('*')->join('kategori_diary', 'kategori_diary.id_diary = diary.id_diary')
        ->join('kategori', 'kategori.id_kategori = kategori_diary.id_kategori')
        ->where('diary.id_diary', $id)
        ->findAll();

        if ($id != null) {
            $data = [
                'note' => $entries,
                'kategori' => $kategori->where('kategori.id_user', NULL)->orWhere('kategori.id_user', session()->get('id'))->findAll(),
                'ubahkat' => $ubahKat,
                'validation' => \Config\Services::validation(),
            ];
               
            return view('EditNote', $data); 
        } 
    }

    public function addCategory()
    {
        session();
        return view('AddCategory', ['validation' =>  \Config\Services::validation()]);
    }

    public function editCategory($id_kategori)
    {
        $katModel = model(KategoriModel::class);
        $data = $katModel->where('id_kategori', $id_kategori)->findAll();
        return view('EditCategory', ['data' => $data]);
    }

    public function listCategory()
    {
        $katModel = model(KategoriModel::class);
        $data = [
            "data" => $katModel->where('kategori.id_user', session()->get('id'))->findAll(),                    
        ];

        return view('ListCategory', $data);
    }

    public function saveProcess()
    {
        $db = \Config\Database::connect();
        $noteCreated = Time::now('Asia/Shanghai');
        $rules = [
            'title'   => [
                'rules'  => 'required',
                'errors' => [
                    'required'  => 'Judul Harus Diisi'
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
            $DiaryModel = model(DiaryModel::class);
            $OtherModel = model(OtherModel::class);
            $post = $this->request->getPost();

            $data = [
                'title' => $post['title'],
                'created_at' => $noteCreated,
                'content' => $post['content'],
                'id_user' => $post['id_user'],
            ]; 

            $DiaryModel->insert($data); 

            $id_diary = $db->insertID();  

            foreach ($post['kategori'] as $id_kategori) {
                $OtherModel->insert([
                    'id_diary' => $id_diary,
                    'id_kategori' => $id_kategori
                ]);
            }            
        
            return redirect()->to('/dashboard')->with('sukses', 'Data berhasil disimpan');
        }else{
            // $validation = \Config\Services::validation();
            return redirect()->to('/saveNote')->withInput()->with('gagal', 'Data gagal disimpan');
        }
    }

    public function editProcess($id_diary)
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

        if ($this->validate($rules)) {
            $model = model(DiaryModel::class);
            $OtherModel = model(OtherModel::class);
            
            $data = $this->request->getPost();
            $model->update($id_diary, $data);

            foreach ($data['kategori'] as $id_kategori) {
                $OtherModel->upsert([
                    'id_diary' => $id_diary,
                    'id_kategori' => $id_kategori
                ]);
            }
            return redirect()->to('/dashboard')->with('sukses', 'Data berhasil diubah'); 
        }else{
            return redirect()->back()->with('gagal', 'Data gagal diubah'); 
        }
    }

    public function delete($id)
    {
        $model = model(DiaryModel::class);        
        $model->delete($id); 
        return redirect()->to('/dashboard')->with('sukses', 'Data berhasil dihapus');
    }


    public function addCatProcess()
    {
        $rules = [
            'kategori'   => [
                'rules'  => 'required',
                'errors' => [
                    'required'  => 'Judul Harus Diisi'
                ]
            ],
        ];

        if (!$this->request->is('post')) {
            return view('AddCategory');
        }
           
        if ($this->validate($rules)){
            $katModel = model(KategoriModel::class);
            $post = $this->request->getPost();

            $data = [
                'kategori' => $post['kategori'],
                'deskripsi' => $post['deskripsi'],
                'id_user'=> session()->get("id"),
            ];

            $katModel->upsert($data); 
            return redirect()->to('/dashboard')->with('sukses', 'Data Kategori berhasil disimpan');
        }else{
            // $validation = \Config\Services::validation();
            return redirect()->to('/addCate')->withInput()->with('gagal', 'Data Kategori gagal disimpan');
        }
    }

    public function editCProcess($id_kategori)
    {
        $rules = [
            'kategori' => [
                'rules'  => 'required',
                'errors' => [
                    'required'  => 'Kategori Harus Diisi'
                ]
            ],
        ];

        if ($this->validate($rules)) {
            $model = model(KategoriModel::class);
            
            $data = $this->request->getPost();
            $model->update($id_kategori, $data);
            return redirect()->to('/listCate')->with('sukses', 'Data berhasil diubah'); 
        }else{
            return redirect()->back()->with('gagal', 'Data gagal diubah'); 
        }
    }

    public function deletecate($id_kategori)
    {
        $model = model(KategoriModel::class);
        $model->delete($id_kategori); 
        return redirect()->to('/dashboard')->with('sukses', 'Kategori Anda Telah di Hapus');
    }

    public function search()
    {
        $pager = \Config\Services::pager();
        $model = model(DiaryModel::class);
        $session = session();
        $id = $session->get('id');
        $kata_kunci = $this->request->getVar('cari');
        // $query = $model->query("SELECT * FROM diary INNER JOIN kategori ON diary.id_kategori=kategori.id_kategori WHERE title LIKE '%" . $kata_kunci . "%'"); 

        if (!empty($kata_kunci)) {
            $data['hasil'] = $model->select('*')->join("kategori", "kategori.id_kategori = diary.id_kategori", "inner")->where("id_user", $id)->like('title', $kata_kunci)->orLike('content', $kata_kunci)->paginate(3, 'note');
            $data ['pager'] = $model->pager;
        } else {
            $data['hasil'] = array();
            redirect()->to()->back();
        }
        $data['kata_kunci'] = $kata_kunci;
        return view('SearchRes', $data);
    }

    public function restore($id = null)
    {
        $noteModel = model(DiaryModel::class);
        $otherModel = model(OtherModel::class);
        if($id != null){
            $noteModel->update($id, ['deleted_at' => null]);
            return redirect()->to('/dashboard')->with('sukses', 'Data Sampah berhasil dipulihkan');
        }else{
            $noteModel->set('deleted_at', null)->where('deleted_at is NOT NULL', NULL)->update();
            return redirect()->to('/dashboard')->with('sukses', 'Semua Data Sampah berhasil dipulihkan');
        }
    }

    public function delPermanent($id = null)
    {
        $noteModel = model(DiaryModel::class);
        $otherModel = model(OtherModel::class);
        if($id != null){
            $noteModel->delete($id, true);
            return redirect()->to('/dashboard')->with('sukses', 'Data Sampah berhasil di hapus permanen');
        }else{
            $noteModel->purgeDeleted();
            return redirect()->to('/dashboard')->with('sukses', 'Semua Data Sampah berhasil di hapus permanen');
        }
    }

    public function delCateOnNote($id_diary, $id_kategori)
    {
        $model = model(OtherModel::class);
        $model->where(['id_diary' => $id_diary, 'id_kategori' => $id_kategori])->delete(); 
        return redirect()->to('/dashboard')->with('sukses', 'Kategori Anda Telah di Hapus');
    }
}