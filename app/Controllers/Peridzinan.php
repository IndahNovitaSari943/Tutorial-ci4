<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PeridzinanModel;

class Peridzinan extends BaseController
{
    protected $pm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->pm = new PeridzinanModel();

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
                'aktif'=>'active',
            ],
            'petugas'=>[
                'title'=>'Petugas',
                'link'=>base_url() . '/petugas',
                'icon'=>'fa-solid fa-users',
                'aktif'=>'',
            ],
        ];

        $this->rules = [
            'tanggal'           => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  => 'Tanggal tidak boleh kosong',
                ]
            ],
            'kd_petugas'   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  => 'Kode petugas tidak boleh kosong',
                ]
            ],
            'NIS'    =>[
                'rules'     => 'required',
                'errors'    => [
                    'required'  => ' NIS tidak boleh kosong',
                ]
            ],
            'lama'     => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  => 'Lama tidak boleh kosong',
                ]
            ],
            'alasan'        => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  => 'Alasan tidak boleh kosong',
                ]
            ],
            'tujuan'        => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  => 'Tujuan tidak boleh kosong',
                ]
            ],
        ];
    }
    public function index()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Peridzinan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href ="' . base_url() . '">Beranda</a></li>
                            <li class="breadcrumb-item active">Peridzinan</li>
                            </ol>
                        </div>';
       
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Data Peridzinan";

        $query = $this->pm->find();
        $data['data_peridzinan'] = $query;
        return view('peridzinan/content', $data);
    }

    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                        <h1 class="m-0">Peridzinan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item><a href="' . base_url() . '">Beranda / </a></li>
                            <li class="breadcrumb-item"><a href="' . base_url() . '/peridzinan">Peridzinan</a></li>
                            <li class="breadcrumb-item active">Tambah Peridzinan</li>
                        </ol>
                    </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Peridzinan';
        $data['action'] = base_url() . '/peridzinan/simpan';
        return view('peridzinan/input', $data);
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
            return redirect()->to('peridzinan')->with('Success', 'Data berhasil disimpan');
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
            return redirect()->to('peridzinan')->with('success', 'Data peridzinan dengan tanggal '.$id.' berhasil dihapus');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->to('peridzinan')->with('error', $e->getMassage());
        }
        
    }

    public function edit($id){
        $breadcrumb = '<div class="col-sm-6">
                        <h1 class="m-0">Peridzinan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item><a href="' . base_url() . '">Beranda / </a></li>
                            <li class="breadcrumb-item"><a href="' . base_url() . '/peridzinan">Peridzinan</a></li>
                            <li class="breadcrumb-item active">Edit Peridzinan</li>
                        </ol>
                    </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Edit Peridzinan';
        $data['action'] = base_url() . '/peridzinan/update';

        $data['edit_data'] = $this->pm->find($id);
        return view('peridzinan/input', $data);


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
            return redirect()->to('peridzinan')->with('success', 'Data berhasil diupdate');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', $e->getMassage());
            return redirect()->back()->withInput();
        }
    }
}
