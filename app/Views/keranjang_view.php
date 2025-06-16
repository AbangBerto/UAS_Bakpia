<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; padding: 0; 
            background-color: #f4f4f4; 
            color: #333; 
        }
        .header { 
            background-color: #8B4513; 
            color: white; 
            padding: 15px 20px; 
            text-align: center; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); 
        }
        .header h1 { 
            margin: 0; 
            font-size: 2.5em; 
        }
        .navbar { 
            background-color: #A0522D; 
            overflow: hidden; 
            text-align: center; 
        }
        .navbar a { 
            display: inline-block; 
            color: white; 
            padding: 14px 20px; 
            text-decoration: none; 
            font-size: 1.1em; 
            transition: background-color 0.3s ease; 
        }
        .navbar a:hover { 
            background-color: #CD853F; 
        }
        .container { 
            max-width: 900px; 
            margin: 20px auto; 
            padding: 20px; 
            background-color: white; 
            border-radius: 8px; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); 
        }
        h2 { 
            text-align: center; 
            color: #8B4513; 
            margin-bottom: 30px; 
        }
        .cart-item { 
            display: flex; 
            align-items: center; 
            border-bottom: 1px solid #eee; 
            padding: 15px 0; 
        }
        .cart-item:last-child { 
            border-bottom: none; 
        }
        .cart-item img { 
            width: 80px; 
            height: 80px; 
            object-fit: cover; 
            border-radius: 4px; 
            margin-right: 15px; 
        }
        .item-details { 
            flex-grow: 1; 
        }
        .item-details h3 { 
            margin: 0 0 5px 0; 
            color: #A0522D; 
        }
        .item-details p { 
            margin: 0; 
            font-size: 0.9em; 
            color: #666; 
        }
        .item-price { 
            font-weight: bold; 
            color: #D2691E; 
            width: 120px; 
            text-align: right; 
        }
        .item-actions { 
            margin-left: 20px; 
        }
        .item-actions button { 
            background-color: #dc3545; 
            color: white; 
            border: none; 
            padding: 8px 12px; 
            border-radius: 5px; 
            cursor: pointer; 
        }
        .item-actions button:hover { 
            background-color: #c82333; 
        }
        .cart-summary { 
            margin-top: 30px; 
            text-align: right; 
            padding-top: 20px; 
            border-top: 1px solid #eee; 
        }
        .cart-summary .total { 
            font-size: 1.5em; 
            font-weight: bold; 
            color: #8B4513; 
        }
        .checkout-form { 
            margin-top: 20px; 
            padding-top: 20px; 
            border-top: 1px solid #eee; 
            text-align: center; 
        }
        .checkout-form label { 
            display: block; 
            margin-bottom: 10px; 
            font-weight: bold; 
        }
        .checkout-form select, .checkout-form input[type="submit"] { 
            padding: 10px; 
            border-radius: 5px; 
            border: 1px solid #ccc; 
            margin-bottom: 15px; 
        }
        .checkout-form input[type="submit"] { 
            background-color: #D2691E; 
            color: white; 
            border: none; 
            cursor: pointer; 
            transition: background-color 0.3s ease; 
        }
        .checkout-form input[type="submit"]:hover { 
            background-color: #CD853F; 
        }
        .footer {
            background-color: #8B4513;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
        }
        .alert { 
            padding: 10px; 
            margin-bottom: 15px; 
            border-radius: 5px; 
            text-align: left; 
        }
        .alert-success { 
            background-color: #d4edda; 
            color: #155724; 
            border: 1px solid #c3e6cb; 
        }
        .alert-danger { 
            background-color: #f8d7da; 
            color: #721c24; 
            border: 1px solid #f5c6fb; 
        }
        /* Hilangkan tombol panah di input type number */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

input[type=number] {
    -moz-appearance: textfield;
}

    </style>
</head>
<body>
    <div class="header">
        <h1>Bakpia Pathok Agung</h1>
        <p>Keranjang Belanja Anda</p>
    </div>
    <div class="navbar">
        <a href="<?= base_url('/beranda') ?>">Beranda</a>
        <a href="<?= base_url('/keranjang') ?>">Keranjang</a>
        <a href="<?= base_url('/riwayat') ?>">Riwayat</a>
        <a href="<?= base_url('/logout') ?>" onclick="return confirm('Yakin ingin logout?')">Logout</a>
    </div>

    <div class="container">
        <h2>Keranjang Belanja</h2>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($items)): ?>
            <?php $grandTotal = 0; ?>
            <?php foreach ($items as $item): ?>
                <div class="cart-item">
                    <img src="<?= esc($item->gambar ?? 'https://via.placeholder.com/80x80/cccccc/000000?text=No+Image') ?>" alt="<?= esc($item->nama) ?>">
                    <div class="item-details">
                        <h3><?= esc($item->nama) ?></h3>
                        <form action="<?= base_url('keranjang/updateJumlah/' . esc($item->idPemesanan)) ?>" method="post" style="display:inline;">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_produk" value="<?= esc($item->id_produk) ?>">
                        <label for="jumlah_<?= $item->idPemesanan ?>">Jumlah:</label>
                        <input type="number" name="jumlah" id="jumlah_<?= $item->idPemesanan ?>" value="<?= esc($item->jumlah_barang) ?>" min="1" style="width: 60px;" onchange="this.form.submit()">
                    </form>
                    </div>
                    <div class="item-price">Rp <?= number_format($item->total_harga, 0, ',', '.') ?></div>
                    <div class="item-actions">
                        <form action="<?= base_url('keranjang/hapusItem/' . esc($item->idPemesanan)) ?>" method="post">
                            <?= csrf_field() ?>
                            <button type="submit">Hapus</button>
                        </form>
                    </div>
                </div>
                <?php $grandTotal += $item->total_harga; ?>
            <?php endforeach; ?>

            <div class="cart-summary">
                <div class="total">Total Belanja: Rp <?= number_format($grandTotal, 0, ',', '.') ?></div>
            </div>

            <div class="checkout-form">
                <form method="post" action="<?= base_url('produkdetail/bayarDariKeranjang') ?>" >
                    <?= csrf_field() ?>
                    <label for="metode_pembayaran_cart">Metode Pembayaran:</label>
                    <select name="metode_pembayaran" id="metode_pembayaran" required>
                        <option value="">Pilih Metode</option>
                        <option value="Transfer Bank">Transfer Bank</option>
                        <option value="Kartu Kredit">Kartu Kredit</option>
                        <option value="E-wallet">E-Wallet</option>
                    </select>
                    <input type="submit" value="Bayar Sekarang">
                </form>
            </div>
        <?php else: ?>
            <p style="text-align: center;">Keranjang belanja Anda kosong.</p>
        <?php endif; ?>

    </div>

    <div class="footer">
        <p>&copy; <?= date("Y"); ?> Bakpia Pathok Agung. Semua Hak Dilindungi.</p>
    </div>

</body>
</html>