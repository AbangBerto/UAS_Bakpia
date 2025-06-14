<?php

namespace App\Models;

use CodeIgniter\Model;

class gudangModel extends Model
{
    protected $table = 'gudang';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nama', 'jenis', 'stok', 'harga', 'deskripsi', 'gambar'];
    protected $useTimestamps = false;

    protected $validationRules = [
        'nama'      => 'required|min_length[3]|max_length[100]',
        'jenis'     => 'required|min_length[1]|max_length[4]',
        'stok'      => 'required|integer|greater_than_equal_to[0]',
        'harga'     => 'required|numeric|greater_than[0]',
        'deskripsi' => 'permit_empty',
        'gambar'    => 'permit_empty|valid_url_strict',
    ];

    protected $validationMessages = [
        'nama' => [
            'required'   => 'Nama produk harus diisi.',
            'min_length' => 'Nama produk terlalu pendek.',
            'max_length' => 'Nama produk terlalu panjang.',
        ],
        'jenis' => [
            'required'   => 'Jenis produk harus diisi.',
            'min_length' => 'Jenis produk terlalu pendek.',
            'max_length' => 'Jenis produk terlalu panjang.',
        ],
        'stok' => [
            'required'            => 'Stok harus diisi.',
            'integer'             => 'Stok harus berupa angka bulat.',
            'greater_than_equal_to' => 'Stok tidak boleh kurang dari 0.',
        ],
        'harga' => [
            'required'      => 'Harga harus diisi.',
            'numeric'       => 'Harga harus berupa angka.',
            'greater_than'  => 'Harga harus lebih besar dari 0.',
        ],
        'gambar' => [
            'valid_url_strict' => 'URL gambar tidak valid.',
        ],
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    public function hapusGudang($id)
    {
        return $this->delete($id);
    }

    public function getGudangById($id)
    {
        return $this->find($id);
    }

    public function getProductMinimalDetailsById($id)
    {
        return $this->select('id, nama, deskripsi, harga, gambar, stok')->find($id);
    }

    public function getAllProductsMinimalDetails()
    {
        return $this->select('id, nama, deskripsi, harga, gambar, stok')->findAll();
    }

    public function decreaseStock($productId, $quantity)
    {
        $product = $this->find($productId);

        if (!$product) {
            return false;
        }

        if ($product->stok < $quantity) {
            return false;
        }

        $newStock = $product->stok - $quantity;
        return $this->update($productId, ['stok' => $newStock]);
    }
}