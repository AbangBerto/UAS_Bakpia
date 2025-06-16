<?php

namespace App\Controllers;

use App\Models\gudangModel;
use App\Models\KeranjangModel;
use App\Models\RiwayatModel;
use CodeIgniter\Controller;

class ProdukDetail extends Controller
{
    protected $gudangModel;
    protected $keranjangModel;
    protected $riwayatModel;

    

    public function __construct()
    {
        $this->gudangModel = new gudangModel();
        $this->keranjangModel = new KeranjangModel();
        $this->riwayatModel = new RiwayatModel();
    }

    public function tampilkan($id = null)
    {
        if ($id === null) {
            return redirect()->to('/beranda')->with('error', 'ID produk tidak diberikan.');
        }

        $productDetails = $this->gudangModel->getProductMinimalDetailsById($id);
        if (!$productDetails) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("Produk dengan ID $id tidak ditemukan.");
        }

        return view('detail_produk', ['product' => $productDetails]);
    }

    public function tambahKeranjang()
    {
        $request = service('request');


        $productId = $request->getPost('product_id');
        $quantity = (int)$request->getPost('quantity');

        if (empty($productId) || $quantity <= 0) {
            return redirect()->back()->with('error', 'Data keranjang tidak valid.');
        }

        $product = $this->gudangModel->getProductMinimalDetailsById($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        if ($product->stok < $quantity) {
             return redirect()->back()->with('error', 'Stok untuk ' . esc($product->nama) . ' tidak mencukupi.');
        }

        $dataKeranjang = [
            'nama'          => $product->nama,
            'gambar'        => $product->gambar,
            'jumlah_barang' => $quantity,
            'total_harga'   => $product->harga * $quantity,
            'id_produk'     => $productId,
        ];

        $this->keranjangModel->tambahKeKeranjang($dataKeranjang);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function beliSekarang()
    {
        $request = service('request');

        $productId = $request->getPost('product_id');
        $quantity = (int)$request->getPost('quantity');
        $metodePembayaran = $request->getPost('metode_pembayaran');

        if (empty($productId) || $quantity <= 0 || empty($metodePembayaran)) {
            return redirect()->back()->with('error', 'Data pembelian tidak valid.');
        }

        $product = $this->gudangModel->getProductMinimalDetailsById($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $success = $this->gudangModel->decreaseStock($productId, $quantity);

        if (!$success) {
            return redirect()->back()->with('error', 'Pembelian gagal. Mungkin stok tidak cukup (Stok saat ini: ' . ($product->stok ?? 0) . ').');
        }

        $dataRiwayat = [
            'nama'              => $product->nama,
            'gambar'            => $product->gambar,
            'jumlah_barang'     => $quantity,
            'total_harga'       => $product->harga * $quantity,
            'metode_pembayaran' => $metodePembayaran,
            'idProduk'          => $productId
        ];

        $this->riwayatModel->tambahRiwayat($dataRiwayat);
        return redirect()->to('/riwayat')->with('success', 'Pembelian berhasil! Terima kasih.');
    }

    public function bayarDariKeranjang()
    {
        $request = service('request');

        $metodePembayaran = $request->getPost('metode_pembayaran');
        if (empty($metodePembayaran)) {
            return redirect()->back()->with('error', 'Metode pembayaran tidak valid.');
        }

        $itemsInCart = $this->keranjangModel->getKeranjang();

        if (empty($itemsInCart)) {
            return redirect()->to('/keranjang')->with('error', 'Keranjang Anda kosong.');
        }

        $allPurchasesSuccessful = true;
        foreach ($itemsInCart as $item) {
            $originalProduct = $this->gudangModel->getProductMinimalDetailsById($item->id_produk);

            if (!$originalProduct) {
                session()->setFlashdata('error', 'Produk ' . esc($item->nama) . ' tidak ditemukan di gudang.');
                $allPurchasesSuccessful = false;
                break;
            }

            if ($originalProduct->stok < $item->jumlah_barang) {
                 session()->setFlashdata('error', 'Stok untuk ' . esc($item->nama) . ' tidak mencukupi (Stok saat ini: ' . ($originalProduct->stok ?? 0) . ').');
                 $allPurchasesSuccessful = false;
                 break;
            }

            $stockReduced = $this->gudangModel->decreaseStock($item->id_produk, $item->jumlah_barang);

            if ($stockReduced) {
                $dataRiwayat = [
                    'nama'              => $item->nama,
                    'gambar'            => $item->gambar,
                    'jumlah_barang'     => $item->jumlah_barang,
                    'total_harga'       => $item->total_harga,
                    'metode_pembayaran' => $metodePembayaran,
                    'idProduk'         => $item->id_produk,
                ];
                $this->riwayatModel->tambahRiwayat($dataRiwayat);
            } else {
                $allPurchasesSuccessful = false;
                session()->setFlashdata('error', 'Gagal mengurangi stok untuk ' . esc($item->nama) . '.');
                break;
            }
        }

        if ($allPurchasesSuccessful) {
            $this->keranjangModel->hapusKeranjang();
            return redirect()->to('/riwayat')->with('success', 'Pembayaran berhasil! Riwayat pembelian telah diperbarui.');
        } else {
            return redirect()->to('/keranjang')->with('error', 'Pembayaran sebagian gagal. Mohon periksa kembali keranjang Anda.');
        }
    }
   

}