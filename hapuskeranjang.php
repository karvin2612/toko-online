<?php
session_start();

$id_produk=$_GET["id"];
unset($_SESSION["keranjang"][$id_produk]);

echo "<script>alert('Produk telah di hapus dari keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
?>