<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Produk</title>
    <style>
            body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
        color: #333;
    }
    .header {
        background-color: #8B4513; /* Coklat Tua */
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
        background-color: #A0522D; /* Coklat Sedang */
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
        background-color: #CD853F; /* Coklat Muda */
    }
        .detail-container {
            display: flex;
            gap: 30px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            max-width: 900px;
            margin: auto;
        }
        .detail-container img {
            max-width: 400px;
            border-radius: 10px;
        }
        .product-info {
            flex: 1;
        }
        .product-info h2 {
            color: #8B4513;
            margin-top: 0;
        }
        .price {
            font-size: 1.5em;
            color: #D2691E;
            font-weight: bold;
            margin: 15px 0;
        }
        .btn-buy {
            display: inline-block;
            background-color: #D2691E;
            color: white;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1em;
            margin-right: 20px;
        }
        .btn-buy:hover {
            background-color: #CD853F;
        }
                .header {
            background-color: #8B4513; /* Coklat Tua */
            color: white;
            padding: 15px 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .footer {
            background-color: #8B4513;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
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
            background-color: #D2691E; color: white; 
            border: none; 
            cursor: pointer; 
            transition: background-color 0.3s ease; 
        }
        .checkout-form input[type="submit"]:hover { 
            background-color: #CD853F; 
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

<div class="detail-container">
    <img src="<?= htmlspecialchars($product->gambar) ?>" alt="<?= htmlspecialchars($product->nama) ?>">

    <div class="product-info">
        <h2><?= htmlspecialchars($product->nama) ?></h2>
        <p><?= nl2br(htmlspecialchars($product->deskripsi)) ?></p>

        <div class="price">Rp <?= number_format($product->harga, 0, ',', '.') ?></div>

        <div class="stock-info">
            Stok: 
            <?php if ($product->stok > 0) : ?>
                <span class="stok-available"><?= htmlspecialchars($product->stok) ?></span>
            <?php else : ?>
                <span class="stok-empty">Tidak Tersedia</span>
            <?php endif; ?>
        </div>

        <?php if ($product->stok > 0) : ?>
            <br>
            <form method="post" action="<?= base_url('produkdetail/beliSekarang') ?>">
            <?= csrf_field() ?>
            <input type="hidden" name="product_id" value="<?= $product->id ?>">
            <label for="jumlah">Jumlah:</label>
            <input type="number" name="quantity" min="1" max="<?= $product->stok ?>" required>
            <div class="checkout-form">
                    <label for="metode_pembayaran">Metode Pembayaran:</label>
                    <select name="metode_pembayaran" id="metode_pembayaran" required>
                        <option value="">Pilih Metode</option>
                        <option value="Transfer Bank">Transfer Bank</option>
                        <option value="Kartu Kredit">Kartu Kredit</option>
                        <option value="E-wallet">E-Wallet</option>
                    </select>
                        <button type="submit" class="btn-buy">Beli Sekarang</button>  
                
            </div>
                
</form> 
        <?php else : ?>
            <a href="#" class="btn-buy disabled" onclick="return false;">Stok Habis</a>
        <?php endif; ?>
    </div>
</div>


</body>
</html>
