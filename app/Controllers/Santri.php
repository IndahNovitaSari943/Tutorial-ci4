<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SantriModel;

class Santri extends BaseController
{
    protected $sm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->sm = new SantriModel();

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
                'aktif'=>'active',
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
                'aktif'=>'',
            ],
        ];

        $this->rules = [
            'NIS'           => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  => 'NIS tidak boleh kosong',
                ]
            ],
            'nama_santri'   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  => 'Nama santri tidak boleh kosong',
                ]
            ],
            'tmpt_lahir'    =>[
                'rules'     => 'required',
                'errors'    => [
                    'required'  => 'Tempat lahir tidak boleh kosong',
                ]
            ],
            'tgl_lahir'     => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  => 'Tanggal lahir tidak boleh kosong',
                ]
            ],
            'alamat'        => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  => 'Alamat tidak boleh kosong',
                ]
            ],
            'asrama'        => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  => 'Asrama tidak boleh kosong',
                ]
            ],
            'nama_ayah'     => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  => 'Nama ayah tidak boleh kosong',
                ]
            ],
            'nama_ibu'      => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  => 'Nama ibu tidak boleh kosong',
                ]
            ],
        ];
    }
    public function index()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Santri</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href ="' . base_url() . '">Beranda</a></li>
                            <li class="breadcrumb-item active">Santri</li>
                            </ol>
                        </div>';
       
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Data Santri";

        $query = $this->sm->find();
        $data['data_santri'] = $query;
        return view('santri/content', $data);
    }

    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                        <h1 class="m-0">Santri</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item><a href="' . base_url() . '">Beranda / </a></li>
                            <li class="breadcrumb-item"><a href="' . base_url() . '/santri">Santri</a></li>
                            <li class="breadcrumb-item active">Tambah Santri</li>
                        </ol>
                    </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Santri';
        $data['action'] = base_url() . '/santri/simpan';
        return view('santri/input', $data);
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
            return redirect()->to('santri')->with('Success', 'Data berhasil disimpan');
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
            return redirect()->to('santri')->with('success', 'Data santri dengan NIS '.$id.' berhasil dihapus');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->to('santri')->with('error', $e->getMassage());
        }
        
    }

    public function edit($id){
        $breadcrumb = '<div class="col-sm-6">
                        <h1 class="m-0">Santri</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item><a href="' . base_url() . '">Beranda / </a></li>
                            <li class="breadcrumb-item"><a href="' . base_url() . '/santri">Santri</a></li>
                            <li class="breadcrumb-item active">Edit Santri</li>
                        </ol>
                    </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Edit Santri';
        $data['action'] = base_url() . '/santri/update';

        $data['edit_data'] = $this->sm->find($id);
        return view('santri/input', $data);


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
            return redirect()->to('santri')->with('success', 'Data berhasil diupdate');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', $e->getMassage());
            return redirect()->back()->withInput();
        }
    }
}
