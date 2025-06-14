<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'idPemesanan';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useTimestamps = false;
    protected $allowedFields = ['nama', 'gambar', 'jumlah_barang', 'total_harga', 'id_produk'];

    public function tambahKeKeranjang($data)
{
    // Cek apakah produk sudah ada di keranjang
    $existing = $this->where('id_produk', $data['id_produk'])->first();

    if ($existing) {
        // Update jumlah dan total
        $data['jumlah_barang'] += $existing->jumlah_barang;
        $data['total_harga'] += $existing->total_harga;
        return $this->update($existing->idPemesanan, $data);
    } else {
        // Tambah baru
        return $this->insert($data);
    }
}

    public function getKeranjang()
    {
        return $this->findAll();
    }

    public function hapusDariKeranjang($idPemesanan)
    {
        return $this->delete($idPemesanan);
    }

    public function hapusKeranjang()
    {
        return $this->emptyTable();
    }
}