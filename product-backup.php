<?php
    include('admin/config/proses.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="style_product.css">
</head>
<body>
    <div class="container header">
        <h1><a style="color: #614124;">sneakresID.</a></h1>
        <ul>
            <li><a href="index.html" style="color: #614124;">Home</a></li>
            <li class="active"><a href="product.php" style="color: #614124;">Product</a></li>
            <li><a href="contact.html" style="color: #614124;">Contact</a></li>
            <li><a href="admin/login" style="color: #614124;">Log in</a></li>
        </ul>
    </div>

    <div class="flex" style="padding-left: 0px;padding-right: 0px;width:100%">
        <?php
        $qw = $db->query("select a.*, b.username as username from produk a left join users b on a.user_id = b.id");
        foreach ($qw as $data) {
        ?>

        <div class="card">
            <div class="img-card">
                <img src="foto/produkspt.png" class="img">
            </div>
            <div class="content-text">
                <h2><?php echo $data['nama'] ?>.</h2>
                <h2 class="harga">Rp. <?= number_format($data['harga']) ?></h2>
                <small class="user"><?php echo $data['username'] ?></small>
                <br>
                <div class="btn-block">
                    <a href="#" class="btn-order">Order</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</body>
</html>