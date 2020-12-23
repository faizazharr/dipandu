<?php

namespace App\Controllers;

use App\Models\ArtikelModel;

class User extends BaseController
{
    protected $artikelmodel;
    public function __construct()
    {
        $this->artikelmodel = new ArtikelModel();
    }

    public function index()
    {
        if (session()->get('level') == null) {
            session()->setFlashdata('warning', 'Anda Belum Login !');
            return redirect()->to(base_url('/'));
        }

        $artikel = $this->artikelmodel->findAll();

        $data = [
            'title' => "Panduan Posyandu",
            'artikel' => $artikel
        ];
        return view('user/index', $data);
    }

    public function profile()
    {
        $data = ['title' => "Profile"];
        return view('user/profile', $data);
    }

    public function edit_profile()
    {
        $data = ['title' => "Edit Profile"];
        return view('user/editprofile', $data);
    }
}
