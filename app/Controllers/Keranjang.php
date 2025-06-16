<?php

namespace App\Controllers;

use App\Models\KeranjangModel;
use CodeIgniter\Controller;

class Keranjang extends Controller
{
    protected $keranjangModel;

    public function __construct()
    {
        $this->keranjangModel = new KeranjangModel();
    }

    public function index()
    {
        $data['items'] = $this->keranjangModel->getKeranjang();
        return view('keranjang_view', $data);
    }

    public function hapusItem($idPemesanan)
    {
        $this->keranjangModel->hapusDariKeranjang($idPemesanan);
        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }
    public function updateJumlah($idPemesanan)
{
    $keranjangModel = new \App\Models\KeranjangModel();
    $gudangModel = new \App\Models\GudangModel();

    // Ambil item keranjang dulu
    $item = $keranjangModel->find($idPemesanan);
    if (!$item) {
        return redirect()->back()->with('error', 'Item tidak ditemukan');
    }

    // Ambil data produk dari gudang berdasarkan idProduk dari item keranjang
    $produk = $gudangModel->find($item->id_produk); // pastikan ini sesuai nama kolom
    if (!$produk) {
        return redirect()->back()->with('error', 'Produk tidak ditemukan');
    }

    $jumlahBaru = (int)$this->request->getPost('jumlah');

    // Validasi jumlah minimal
    if ($jumlahBaru < 1) {
        return redirect()->back()->with('error', 'Jumlah minimal 1.');
    }

    // Validasi stok
    if ($jumlahBaru > $produk->stok) {
        return redirect()->back()->with('error', 'Jumlah melebihi stok yang tersedia.');
    }

    // Hitung total baru
    $totalBaru = $produk->harga * $jumlahBaru;

    // Update keranjang
    $keranjangModel->update($idPemesanan, [
        'jumlah_barang' => $jumlahBaru,
        'total_harga' => $totalBaru
    ]);

    return redirect()->back()->with('success', 'Jumlah produk diperbarui.');
}




}