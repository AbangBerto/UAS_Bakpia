<?php

namespace App\Controllers;

use App\Models\gudangModel;

class berandaController extends BaseController
{
    protected $gudangModel;

    public function __construct()
    {
        $this->gudangModel = new gudangModel();
    }

    public function index()
    {
        $data['products'] = $this->gudangModel->getAllProductsMinimalDetails();
        return view('beranda', $data);
    }
}