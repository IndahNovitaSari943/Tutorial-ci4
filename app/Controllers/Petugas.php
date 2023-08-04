<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PetugasModel;

class Petugas extends BaseController
{
    protected $sm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->gm = new PetugasModel();

        $this->menu = [
            'beranda'=>[
                'title'=>'Beranda',
                'link'=>base_url(),
                'icon'=>'fa-solid fa-house',
                'aktif'=>'',
            ],
            'santri'=>[
                'title'=>'Santri',
                'link'=>base_url() . '/santri',
                'icon'=>'fa-solid fa-users',
                'aktif'=>'',
            ],
            'peridzinan'=>[
                'title'=>'Peridzinan',
                'link'=>base_url() . '/peridzinan',
                'icon'=>'fa-solid fa-building-columns',
                'aktif'=>'',
            ],
            'petugas'=>[
                'title'=>'Petugas',
                'link'=>base_url() . '/petugas',
                'icon'=>'fa-solid fa-users',
                'aktif'=>'active',
            ],
        ];

        $this->rules = [
            'kd_petugas'           => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  => 'Kode petugas tidak boleh kosong',
                ]
            ],
            'nama_petugas'   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  => 'Nama petugas tidak boleh kosong',
                ]
            ],
        ];
    }
    public function index()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Petugas</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href ="' . base_url() . '">Beranda</a></li>
                            <li class="breadcrumb-item active">Petugas</li>
                            </ol>
                        </div>';
       
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Data Petugas";

        $query = $this->gm->find();
        $data['data_petugas'] = $query;
        return view('petugas/content', $data);
    }

    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                        <h1 class="m-0">Petugas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item><a href="' . base_url() . '">Beranda / </a></li>
                            <li class="breadcrumb-item"><a href="' . base_url() . '/petugas">Petugas</a></li>
                            <li class="breadcrumb-item active">Tambah Petugas</li>
                        </ol>
                    </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Petugas';
        $data['action'] = base_url() . '/petugas/simpan';
        return view('petugas/input', $data);
    }

    public function simpan()
    {
        
        if (! $this->request->is('post')) {
           
            return redirect()->back()->withInput();
        }
        
        if (! $this->validate($this->rules)) {

            return redirect()->back()->withInput();
        }
        $dt = $this->request->getPost();
        try {
            $simpan = $this->sm->insert($dt);
            return redirect()->to('petugas')->with('Success', 'Data berhasil disimpan');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {

            session()->setFlashdata('error', $e->getMassage());
            return redirect()->back()->withInput();
        }
        

    }

    public function hapus($id)
    {
        if(empty($id)){
            return redirect()->back()->with('error', 'Hapus data gagal dilakukan');
        }

        try {
            $this->sm->delete($id);
            return redirect()->to('petugas')->with('success', 'Data petugas dengan kode petugas '.$id.' berhasil dihapus');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->to('petugas')->with('error', $e->getMassage());
        }
        
    }

    public function edit($id){
        $breadcrumb = '<div class="col-sm-6">
                        <h1 class="m-0">Petugas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item><a href="' . base_url() . '">Beranda / </a></li>
                            <li class="breadcrumb-item"><a href="' . base_url() . '/petugas">Petugas</a></li>
                            <li class="breadcrumb-item active">Edit Petugas</li>
                        </ol>
                    </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Edit Petugas';
        $data['action'] = base_url() . '/petugas/update';

        $data['edit_data'] = $this->gm->find($id);
        return view('petugas/input', $data);


    }

    public function update(){
        $dtEdit = $this->request->getPost();
        $param = $dtEdit['param'];
        unset($dtEdit['param']);
        unset ($this->rules['password']);


        if (! $this->validate($this->rules)) {

            return redirect()->back()->withInput();
        }

        if(empty($dtEdit['password'])){
            unset($dtEdit['password']);
        }

        try {
            $this->sm->update($param, $dtEdit);
            return redirect()->to('petugas')->with('success', 'Data berhasil diupdate');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', $e->getMassage());
            return redirect()->back()->withInput();
        }
    }
}
