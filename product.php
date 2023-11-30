<?php
    include('admin/config/proses.php');
    $qw = $db->query("select a.*, b.username as username from produk a left join users b on a.user_id = b.id");
?>
<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = $_SESSION['cart'];

if (isset($_GET['id']) && isset($_GET['name']) && isset($_GET['price']) && isset($_GET['jmlBrg'])) {

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
            'name'  => $_GET['name'],
            'jmlBrg'  => $_GET['jmlBrg'],
            'price' => $_GET['price']
        ]);
    } else {
        $cart[$exist]['jmlBrg'] = $_GET['jmlBrg'];
    }

    $_SESSION['cart'] = $cart;

    header("Location: description.php?id=" . $_GET['id']);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>web ika</title>
        <link rel="stylesheet" href="styleind.css">
    </head>
    <body>
        <div class="main">
            <div class="navbar">
                <label class="logo">sneakresID.</label>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="product.php">Product</a></li>
                    <li><a href="Pesanan.php">Pesanan</a></li>
                    <!-- <li><a href="admin/login">login</a></li> -->
                </ul>
            </div>
            <div class="produk">
                <?php
                foreach ($qw as $data) {
                ?>
                <div class="card">
                    <img src="img/produk.jpg" width="100%"/>
                    <a href="#"><?= $data['nama'] ?></a>
                    <p>Rp. <?= number_format($data['harga']) ?></p> 
                    <a href="Pesanan.php?id=<?= $data['id'] ?>&nama=<?= $data['nama'] ?>&price=<?= $data['harga'] ?>"><button type="button" >tambah ke keranjang</button></a>
                </div>
                <?php
                }
                ?>
                <!-- <div class="card">
                    <img src="img/produk.jpg" width="100%"/>
                    <a href="#">Nama Produk</a>
                    <p>harga</p>       
                </div>
                <div class="card">
                    <img src="img/produk.jpg" width="100%"/>
                    <a href="#">Nama Produk</a>
                    <p>harga</p>       
                </div>
                <div class="card">
                    <img src="img/produk.jpg" width="100%"/>
                    <a href="#">Nama Produk</a>
                    <p>harga</p>       
                </div> -->
            </div>
            </div>
        </div>
        <div class="footer-container">
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