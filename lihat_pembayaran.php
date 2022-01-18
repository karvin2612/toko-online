<?php  
session_start();
//koneksi ke database
include 'koneksi.php';
  
$id_pembelian = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM  pembayaran 
	LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian
	 WHERE pembelian.id_pembelian='$id_pembelian'");
$detbay = $ambil->fetch_assoc();
//jika belum ada data pembayaran
if (empty($detbay)) 
{
	echo "<script>alert('belum ada data pembayaran')</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
// jika data pelanggan yang bayar tidak sesuai dengan yang login
if($_SESSION["pelanggan"]['id_pelanggan']!==$detbay["id_pelanggan"])
{
	echo "<script>alert('anda tidak berhak melihat pembayaran orang lain')</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>
	
<!DOCTYPE html>
<html>
<head>
	<title>Lihat Pembayaran </title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">

</head>
<body>
<?php include 'menu.php'; ?>

<div class="container">
	<h3>Lihat Pembayaran</h3>
	<div class="row">
		<div class="col-md-6">
			<table class="table">
				<tr>
					<th>Nama</th>
					<td><?php echo $detbay["nama"] ?></td>

				</tr>
				<tr>
					<th>Bank</th>
					<td><?php echo $detbay["bank"] ?></td>
				</tr>
				<tr>
					<th>Tanggal</th>
					<td>><?php echo $detbay["tanggal"] ?></td>
				</tr> 
				<tr>
					<th>Jumlah</th>
					<td>Rp. <?php echo number_format($detbay["jumlah"]) ?></td>
				</tr>
			</table>
		</div>
		<div class="col-md-6">
			<img src="bukti_pembayaran/<?php echo $detbay["bukti"] ?>" alt="" class="img-responsive">
		</div>
	</div>
</div>
</body>
</html
