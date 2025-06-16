<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakpia Manis - Beranda</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; padding: 0; 
            background-color: #f4f4f4; 
            color: #333; 
        }

        .header { 
            background-color: #8B4513; 
            color: white; padding: 15px 20px; 
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
            max-width: 1200px; 
            margin: 20px auto; 
            padding: 0 20px; 
        }

        .hero { 
            background-image: url('/beranda2.png'); 
            background-size: cover; 
            background-position: center; 
            height: 400px; display: flex; 
            justify-content: center; 
            align-items: center; color: white; 
            text-shadow: 2px 2px 4px rgba(0,0,0,0.6); 
            margin-bottom: 30px; 
        }

        .hero h2 { 
            font-size: 3em; 
            text-align: center; 
            margin: 0; 
        }

        .section-title { 
            text-align: center; 
            font-size: 2em; 
            margin-bottom: 30px; 
            color: #8B4513; 
        }
        
        .products { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); 
            gap: 30px; 
        }

        .product-card { 
            background-color: white; 
            border-radius: 8px; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); 
            overflow: hidden; text-align: center; 
            transition: transform 0.3s ease; 
        }

        .product-card:hover { 
            transform: translateY(-5px); 
        }

        .product-card img { 
            width: 100%; 
            max-height: 200px; 
            object-fit: cover; 
            border-bottom: 1px solid #eee; 
        }

        .product-card h3 { 
            font-size: 1.5em; 
            margin: 15px 0 10px; 
            color: #A0522D; 
        }

        .product-card p { 
            padding: 0 15px 15px; 
            font-size: 1.1em; 
            color: #555; 
        }

        .product-card .price { 
            font-size: 1.3em; 
            color: #D2691E; 
            font-weight: bold; 
            margin-bottom: 15px; 
        }

        .product-card .actions { 
            display: flex; 
            justify-content: space-around; 
            padding-bottom: 15px; 
        }

        .product-card .actions button {
            background-color: #D2691E;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 0.9em;
        }
        .product-card .actions button:hover { 
            background-color: #CD853F; 
        }

        .product-card .actions .btn-add-cart { 
            background-color: #5cb85c; 
        }

        .product-card .actions .btn-add-cart:hover { 
            background-color: #4cae4c; 
        }

        .product-card .actions form { 
            display: inline-block; 
            margin: 0 5px; 
        }

        .product-card .actions input[type="hidden"] { 
            display: none; 
        }

        .product-card img {
            cursor: pointer;
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
            border: 1px solid #f5c6cb; 
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Bakpia Pathok Agung</h1>
        <p>Bakpia Khas Nusantara, Lezat di Setiap Gigitan!</p>
    </div>

    <div class="navbar">
        <a href="<?= base_url('/beranda') ?>">Beranda</a>
        <a href="<?= base_url('/keranjang') ?>">Keranjang</a>
        <a href="<?= base_url('/riwayat') ?>">Riwayat</a>
        <a href="<?= base_url('/logout') ?>" onclick="return confirm('Yakin ingin logout?')">Logout</a>
</div>
    </div>

    <div class="hero">
        <h2>Nikmati Kelezatan Bakpia Tradisional</h2>
    </div>

    <div class="container">
        <h2 class="section-title" id="produk">Produk Unggulan Kami</h2>

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

        <div class="products">
            <?php if (isset($products) && is_array($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <a href="<?= base_url('produkdetail/tampilkan/' . esc($product->id ?? '')) ?>">
                        <img src="<?= esc($product->gambar ?? 'https://via.placeholder.com/300x200/A0522D/FFFFFF?text=Produk') ?>" alt="<?= esc($product->nama ?? 'Produk Bakpia') ?>">
                        </a>
                        <h3><?= esc($product->nama ?? 'Nama Produk') ?></h3>
                        <p><?= esc("Stok : ".$product->stok ?? 'Stok') ?></p>
                        <div class="price">Rp <?= number_format($product->harga ?? 0, 0, ',', '.') ?></div>
                        <div class="actions">
                            <?php if (($product->stok ?? 0) > 0): ?>
                                <form method="post" action="<?= base_url('produkdetail/tambahKeranjang') ?>">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="product_id" value="<?= esc($product->id ?? '') ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn-add-cart"> +Keranjang</button>
                                </form>

                                <form action="<?= base_url('produkdetail/tampilkan/' . esc($product->id ?? '')) ?>" method="get">
                                    <button type="submit" class="btn-buy">Beli Sekarang</button>
                                </form>
                            <?php else: ?>
                                <p style="color: red; font-weight: bold; width: 100%; text-align: center;">Stok Habis!</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="text-align: center; width: 100%;">Tidak ada produk unggulan yang ditampilkan.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="footer">
        <p>&copy; <?= date("Y"); ?> Bakpia Pathok Agung. Semua Hak Dilindungi.</p>
    </div>

</body>
</html>