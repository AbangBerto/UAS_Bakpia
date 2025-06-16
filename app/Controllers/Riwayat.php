<?php

namespace App\Controllers;

use App\Models\RiwayatModel;
use CodeIgniter\Controller;

class Riwayat extends BaseController
{
    protected $riwayatModel;

    public function __construct()
    {
        $this->riwayatModel = new RiwayatModel();
    }

    public function index()
    {
        $data['riwayatPembelian'] = $this->riwayatModel->getRiwayat();
        return view('riwayat_view', $data);
    }
}