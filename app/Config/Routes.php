<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Rute untuk Login
$routes->get('/', 'UserController::login');
$routes->post('/', 'UserController::login');

//Rute untuk beranda
$routes->get('/beranda', 'berandaController::index');

// Rute untuk detail produk (Ini adalah GET karena dari "Beli Sekarang" di beranda)
$routes->get('produkdetail/tampilkan/(:num)', 'ProdukDetail::tampilkan/$1');

// Rute untuk aksi terkait produk (tambah keranjang, beli sekarang di halaman detail)
$routes->post('produkdetail/tambahKeranjang', 'ProdukDetail::tambahKeranjang');
$routes->post('produkdetail/beliSekarang', 'ProdukDetail::beliSekarang');
$routes->post('produkdetail/bayarDariKeranjang', 'ProdukDetail::bayarDariKeranjang');

// Rute untuk Keranjang Belanja
$routes->get('/keranjang', 'Keranjang::index');
$routes->post('keranjang/hapusItem/(:num)', 'Keranjang::hapusItem/$1');
$routes->post('keranjang/updateJumlah/(:num)', 'Keranjang::updateJumlah/$1');



// Rute untuk Riwayat Pembelian
$routes->get('/riwayat', 'Riwayat::index');

//Rute untuk Logout
$routes->get('logout', 'UserController::logout');


