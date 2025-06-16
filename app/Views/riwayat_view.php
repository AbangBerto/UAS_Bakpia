<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembelian</title>
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
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h2 { 
            text-align: center; 
            color: #8B4513; 
            margin-bottom: 30px; 
        }
        .history-item { 
            display: flex; 
            align-items: center; 
            border-bottom: 1px solid #eee; 
            padding: 15px 0; 
        }
        .history-item:last-child {
            border-bottom: none; 
        }
        .history-item img { width: 80px; 
            height: 80px; 
            object-fit: cover; 
            border-radius: 4px; 
            margin-right: 15px; 
        }
        .item-details { flex-grow: 1; }
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
        .item-date { 
            font-size: 0.8em; 
            color: #999; 
            margin-left: 20px; 
        }
        .footer {
            background-color: #8B4513;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
        }
        .alert { padding: 10px; 
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
    </style>
</head>
<body>
    <div class="header">
        <h1>Bakpia Pathok Agung</h1>
        <p>Riwayat Pembelian Anda</p>
    </div>
    <div class="navbar">
        <a href="<?= base_url('/beranda') ?>">Beranda</a>
        <a href="<?= base_url('/keranjang') ?>">Keranjang</a>
        <a href="<?= base_url('/riwayat') ?>">Riwayat</a>
        <a href="<?= base_url('/logout') ?>" onclick="return confirm('Yakin ingin logout?')">Logout</a>
    </div>

    <div class="container">
        <h2>Riwayat Pembelian</h2>

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
            
        <?php if (!empty($riwayatPembelian)): ?>
            <?php foreach ($riwayatPembelian as $item): ?>
                <div class="history-item">
                    <img src="<?= esc($item->gambar ?? '') ?>" alt="<?= esc($item->nama) ?>">
                    <div class="item-details">
                        <h3><?= esc($item->nama) ?></h3>
                        <p>Jumlah: <?= esc($item->jumlah_barang) ?></p>
                        <p>Metode Pembayaran: <?= esc(ucwords(str_replace('_', ' ', $item->metode_pembayaran))) ?></p>
                    </div>
                    <div class="item-price">Rp <?= number_format($item->total_harga, 0, ',', '.') ?></div>
                    <div class="item-date">
                        <?= (new DateTime($item->tanggalPembelian))->format('d M Y H:i') ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center;">Anda belum memiliki riwayat pembelian.</p>
        <?php endif; ?>

    </div>

    <div class="footer">
        <p>&copy; <?= date("Y"); ?> Bakpia Pathok Agung. Semua Hak Dilindungi.</p>
    </div>

</body>
</html>