<?php

namespace App\Controllers;

use App\Models\gudangModel;
use App\Models\KeranjangModel;
use App\Models\RiwayatModel;
use CodeIgniter\Controller;

class UserController extends Controller
{
  

    public function login()
{
    helper('form');

    if (!$this->request->is('post')) {
        return view('login'); 
    }

    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    $validUsername = 'superman';
    $validPassword = 'rahasia';

    if ($username === $validUsername && $password === $validPassword) {
        session()->set('isLoggedIn', true);
        session()->set('username', $username);
        return redirect()->to('/beranda');
    } else {
        session()->setFlashdata('error_message', 'Username atau password salah.');
        return redirect()->to('/');
    }
}

    public function logout()
{
    return redirect()->to('/?message=' . urlencode('Anda berhasil logout, silakan berkunjung kembali~'));
}


}