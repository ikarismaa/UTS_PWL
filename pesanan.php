<?php
include('admin/config/proses.php');
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$sweet_alert = false;
$cart = $_SESSION['cart'];

/** Add to cart */
if (isset($_GET['id']) && isset($_GET['nama']) && isset($_GET['price']) ) {

    // Logic Cart

    // Check if product exist in cart
    $exist = false;
    foreach ($cart as $key => $item) {
        if ($item['id'] == $_GET['id']) {
            $exist = $key;
        }
    }

    if ($exist === false) {
        array_push($cart, [
            'id'  => $_GET['id'],
            'nama'  => $_GET['nama'],
            'jmlBrg'  => 1,
            'price' => $_GET['price']
        ]);
    }

    $_SESSION['cart'] = $cart;

    // header("Location: description.php?id=" . $_GET['id']);
}

// var_dump($_POST);
/** Add to database */
if (isset($_POST['nama']) && isset($_POST['nomor']) && isset($_POST['bayar']) && isset($_POST['alamat']) && isset($_POST['pesan']) ) {
    /** Table transaksi */
    $qw = $db->insert('transaksi', 'nama, telfon, metode_bayar, alamat, catatan', 
                "
                    '{$_POST['nama']}',
                    '{$_POST['nomor']}',
                    '{$_POST['bayar']}',
                    '{$_POST['alamat']}',
                    '{$_POST['pesan']}'
                ");
    $datas = $db->get('id', 'transaksi', 'order by id desc limit 1');
    $transaksi_id = [];
    foreach ($datas as $item) {
        $transaksi_id = $item['id'];
    }
    
    // var_dump($transaksi_id);
    foreach ($cart as $key => $item) {
        $price = $item['price'] * $item['jmlBrg'];

        $db->insert('transaksi_item', 'transaksi_id, produk_id, qty, total_harga',
            "
            $transaksi_id,
            {$item['id']},
            {$item['jmlBrg']},
            {$price}
            "
        );
    }

    $sweet_alert = true;
}

if ( isset($_POST['hapus']) ) {
    // var_dump('asdasd');
    unset($_SESSION['cart'][$_POST['hapus']]);
    $cart = $_SESSION['cart'];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta nama="viewport" content="width=device-width, initial-scale=1.0">
        <title>web ika</title>
        <link rel="stylesheet" href="styleind.css">
        <link rel="stylesheet" href="style_order.css?v=<?= time(); ?>">

    </head>
    <body>
        <div class="main">
            <div class="navbar">
                <label class="logo">sneakresID.</label>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="product.php">Product</a></li>
                    <li><a href="pesanan.php">Pesanan</a></li>
                    <!-- <li><a href="admin/login">login</a></li> -->
                </ul>
            </div>
            </div>
        </div>
        <div class="content" style="margin-top: 200px;">
            <div style="padding-left:10%; padding-right:10%; width:80%">
                <h1>Cart Barang</h1>
                <table style="width:80%;" class="tChart">
                    <thead>
                        <tr>
                            <th style="padding: 8px;">Nama Produk</th>
                            <th style="padding: 8px;">QTY</th>
                            <th style="padding: 8px;">Harga</th>
                            <th style="padding: 8px;">Total</th>
                            <th style="padding: 8px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($cart as $key => $item) {

                            $price = (int)$item['price'] * (int)$item['jmlBrg'];
                            $total = $total + $price;
                        ?>
                            <tr>
                                <td><?= $item['nama'] ?></td>
                                <td class="center"><?= $item['jmlBrg'] ?></td>
                                <td class="center"><?= 'Rp ' . number_format($item['price'], 0, ' ,', '.') ?></td>
                                <td class="center"><?= 'Rp ' . number_format($price, 0, ' ,', '.') ?></td>
                                <td class="center">
                                    <form action="" method="post">
                                        <input type="hidden" class="" name="hapus" value="<?= $key ?>" hidden="hidden">
                                        <button type="submit">hapus</button>
                                    </form>
                                    <!-- <a href="hapusCart.php?id=<?= $item['id'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus produk?')">
                                        hapus
                                    </a> -->
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="4" class="right bold">Total Harga</td>
                            <td colspan="2" class="center bold"><?= 'Rp ' . number_format($total, 0, ' ,', '.') ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h1>Form Pemesanan</h1>
            <div style="padding-bottom: 80px;">
                <form method="POST" action="pesanan.php">
                    <div>
                        <label for="">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" placeholder="Nama anda" >
                    </div>
                    <div>
                        <label for="">Nomor Telepon / WA</label>
                        <input type="number" id="nomor" name="nomor" placeholder="Nomor telepon" >
                    </div>
                    <div>
                        <label for="">Metode Pembayaran</label>
                        <select id="bayar" name="bayar" class="custom-select" >
                            <option value="" disabled selected hidden class="placeholder">Metode pembayaran</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Debit">Debit</option>
                            <option value="Credit">Credit</option>
                            <option value="COD">COD</option>
                        </select>
                        <!-- <input type="number" id="nomor" name="nomor" placeholder="Your answer" > -->
                    </div>
                    <div>
                        <label for="">Alamat Penerima</label>
                        <textarea type="text" rows="4" id="alamat" name="alamat" placeholder="Alamat" ></textarea>
                    </div>
                    <div>
                        <label for="">Catatan Pelanggan</label>
                        <textarea type="text" rows="6" id="pesan" name="pesan" placeholder="Your answer" ></textarea>
                    </div>
                    <div>
                        <button type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer-container"  style="padding-top: 200px">
            <div class="footer">
                <div class="footer-heading footer-1">
                    <h2>About Us</h2>
                    <a href="#">Blog</a>
                    <a href="#">Demo</a>
                    <a href="#">Customers</a>
                    <a href="#">Investors</a>
                    <a href="#">Terms of Service</a>
                </div>
                <div class="footer-heading footer-2">
                    <h2>Contact Us</h2>
                    <a href="#">Jobs</a>
                    <a href="#">Support</a>
                    <a href="#">Contact</a>
                    <a href="#">Sponsorships</a>
                </div>
                <div class="footer-heading footer-3">
                    <h2>Social Media</h2>
                    <a href="#">Instagram</a>
                    <a href="#">Facebook</a>
                    <a href="#">Youtube</a>
                    <a href="#">Twitter</a>
                </div>
                <div class="footer-email-form">
                    <h2>Join Our Newsletter</h2>
                    <input type="email" placeholder="Enter your email address" id="footer-email">
                    <input type="submit" value="Sing Up" id="footer-email-btn">
                </div>
                <p class="copyright-line">Copyright &copy; 2022 | ika</p><br>
            </div>
    </body>
</html>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    <?php 
        if($sweet_alert) {
    ?>
    swal("Data Tersimpan!", "Data anda sudah tersimpan, admin akan memproses dan menghubungi anda secepatnya!", "info");
    <?php } ?>
</script>