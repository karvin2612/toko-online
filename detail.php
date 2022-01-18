<?php session_start(); ?>
<?php include 'koneksi.php'; ?>
<?php
//mendaptkan id_produk dari url
$id_produk= $_GET['id'];

//query ambil data
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Produk</title>
    <link rel="stylesheet" href="Admin/assets/css/bootstrap.css">
    <script type="text/javascript" src="Admin/assets/js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="Admin/assets/js/bootstrap.min.js"></script>
</head>
<body style="margin-top:100px;">

<!-- navbar -->
<?php include 'menu.php'; ?>

 <section class="kontent">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="Foto_produk/<?php echo $detail['foto_produk']; ?>" class="img-responsive"><br/>
                </div>

             <div class="col-md-6">
                <h2><?php echo $detail['nama_produk'] ?></h2>
                <h4>Rp. <?php echo number_format($detail['harga_produk']); ?></h4>

                <h5>Stok: <?php echo $detail['stok_produk']; ?></h5>

                <form method="post">
                    <div class="form-group">
                        <div class="input-group">
                         <input type="number" id="hasil" class="form-control" name="jumlah" min="1" max="<?php echo $detail['stok_produk'] ?>" required>
                            <div class="input-group-btn">
                                <button class="btn btn-primary" name="beli">Beli</button>
                            </div>
                        </div>
                    </div>
                </form>

                <?php
                // jk ada tombol beli
                if (isset($_POST['beli']))
                {
                        // mendapatkan jumlah yg diinputkan
                        $jumlah = $_POST['jumlah'];
                        // masukkan dikeranjang belanja
                        $_SESSION['keranjang'][$id_produk] = $jumlah;
                        echo "<script>alert('produk telah masuk ke keranjang belanja');</script>";
                        echo "<script>location='keranjang.php';</script>";
                }

                ?>

                <p><?php echo $detail['deskripsi_produk']; ?></p>
            </div>

        </div>
     </div>
 </section>

</body>
</html>