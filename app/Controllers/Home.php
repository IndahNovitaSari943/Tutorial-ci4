<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $menu = [
            'beranda'=>[
                'title'=>'Beranda',
                'link'=>base_url(),
                'icon'=>'fa-solid fa-house',
                'aktif'=>'active',
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
                'icon'=>'fa-solid fa-desktop',
                'aktif'=>'',
            ],
            'petugas'=>[
                'title'=>'Petugas',
                'link'=>base_url() . '/petugas',
                'icon'=>'fa-solid fa-user-tie',
                'aktif'=>'',
            ],
        ];

        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Beranda</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Beranda</li>
                            </ol>
                        </div>';
        $data['menu'] = $menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Welcome to my site";
        $data['selamat_datang'] = "Selamat Datang di Web Peridzinan Santri";
        return view('template/content', $data);
    }
}
