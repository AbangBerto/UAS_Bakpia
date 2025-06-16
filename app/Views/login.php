<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Login Page</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f7e9d7;
            /* Warna latar belakang cream */
            margin: 0;
             background-image: url('bg_login.png'); /* Nama file gambar */
            background-size: cover; /* Agar gambar menutupi seluruh layar */
            background-repeat: no-repeat;
            background-position: center;
            margin: 0;
        }

        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
            /* Lebar container */
            max-width: 90%;
            /* Fleksibilitas untuk layar kecil */
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            font-size: 2.2em;
            /* Ukuran font H1 */
            font-weight: bold;
        }
        .input-group {
            margin-bottom: 20px;
            /* Jarak antar input field */
        }

        .input-group input[type="text"],
        .input-group input[type="password"] {
            width: calc(100% - 40px);
            /* Kurangi padding dari lebar total */
            padding: 15px 20px;
            border: none;
            border-radius: 10px;
            /* Sudut lebih membulat */
            background-color: #f0f0f0;
            /* Warna latar belakang input */
            font-size: 1.1em;
            color: #555;
            outline: none;
            /* Hilangkan outline saat focus */
        }

        .input-group input[type="text"]::placeholder,
        .input-group input[type="password"]::placeholder {
            color: #888;
        }

        .login-button {
            width: 100%;
            padding: 15px;
            background-color: #000000;
            /* Warna hitam untuk tombol login */
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-size: 1.2em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            /* Jarak dari input ke tombol */
        }

        .login-button:hover {
            background-color: #333333;
            /* Sedikit lebih terang saat di-hover */
        }

    </style>
</head>

<body>
    <h1> BAKPIA PATHOK AGUNG</h1>
    <div class="login-container">
        <h1>Login</h1>
    <?php if (session()->getFlashdata('error_message')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error_message') ?>
        </div>
    <?php endif; ?>

        <form action="/" method="post">
            <div class="input-group">
                <input type="text" id="username" name="username" placeholder="Nama / Nomor HP">
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Password">
            </div>
            <button type="submit" class="login-button">Login</button>
        </form>
    </div>
    <?php if (isset($_GET['message'])): ?>
<script>
    Swal.fire({
        title: 'Cihuyy!',
        text: "<?= esc($_GET['message']) ?>",
        imageUrl: '<?= base_url('kucink.gif') ?>', 
        imageWidth: 250,
        imageHeight: 250,
        imageAlt: 'Kucing lucu',
        confirmButtonText: 'Oke 😺'
    });
</script>
<?php elseif (isset($_GET['error'])): ?>
<script>
    alert("<?= esc($_GET['error']) ?>");
</script>
<?php endif; ?>


</body>

</html>