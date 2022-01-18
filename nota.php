<?php 
session_start();
include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Nota Pembelian</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<?php include 'menu.php' ?>


<section class="konten">
	<div class="container">
		<!-- Nota sini ambil dari nota admin-->
		<h1>Detail Pembelian</h1>
<?php
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>
<!-- jika pelanggan yang beli tidak sama dengan pelanggan yang login, maka dilarikan ke riwayat.php karena dia tidak berhak melihat nota orang lain -->
<!-- pelanggan yang beli harus pelanggan yang login -->

<?php
//mendapatkan id_pelanggan yang beli
$idpelangganyangbeli = $detail["id_pelanggan"];

//mendapatkan id pelanggan yang login
$idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

if ($idpelangganyangbeli!==$idpelangganyanglogin)
{
	echo "<script>alert('Jangan Nakal');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>


<div class="row">
	<div class="col-md-4">
	<h3>Pembelian</h3>
		<p>
		Tanggal: <?php echo $detail['tanggal_pembelian']; ?> <br>
		Total : Rp. <?php echo number_format($detail['total_pembelian']); ?> <br>
		Status :<?php echo $detail['status_pembelian']; ?> 
		</p>
	</div>

	<div class="col-md-4">
	<h3>Pelanggan</h3>
		<strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
		<p>
		<?php echo $detail['telepon_pelanggan']; ?> <br>
		<?php echo $detail['email_pelanggan']; ?> 
		</p>
	</div>

	<div class="col-md-4"><h3>Pengiriman</h3>
		<strong><?php echo $detail["nama_kota"]; ?></strong> <br>
		<p>
			Tarif: Rp. <?php echo number_format($detail["tarif"]); ?><br>
			Alamat: <?php echo $detail["alamat_pengiriman"]; ?>
		</p>
	</div>
</div>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Subharga</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]' "); ?>
		<?php while($pecah=$ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_produk']; ?></td>
			<td> Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td>
				Rp. <?php echo number_format($pecah['harga_produk']*$pecah['jumlah']); ?>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>
<div class="row">
    <div class="col-md-7">
        <div class="alert alert-info">
            <p>
                Silakan melakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?> ke <br>
                <strong>BANK MANDIRI 089-9928-420-6 A.N. Karvin Halim</strong>
            </p>
        </div>
    </div>
</div>
	</div>
</section>
</body>
</html>