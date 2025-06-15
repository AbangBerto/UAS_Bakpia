<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatModel extends Model
{
    protected $table = 'riwayat';
    protected $primaryKey = 'idRiwayat';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useTimestamps = false;
    protected $createdField  = 'tanggalPembelian';
    protected $allowedFields = ['nama', 'gambar', 'jumlah_barang', 'total_harga', 'metode_pembayaran', 'idProduk'];
    protected $useSoftDeletes = false;

    public function tambahRiwayat($data)
{
    
        // Insert baru
        return $this->insert($data);
    }
    
     public function getRiwayat()
    {
        return $this->orderBy('idRiwayat', 'DESC')->findAll();
    }
}
