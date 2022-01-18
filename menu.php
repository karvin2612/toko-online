<nav class="navbar navbar-default">
	<div class="container">
	<ul class="nav navbar-nav">
		<li><a href="index.php">HOME</a></li>
		<li><a href="keranjang.php">KERANJANG</a></li>
		<!--Jika sudah login atau ada session pelanggan-->
		<?php if(isset($_SESSION["pelanggan"])): ?>
            <li><a href="riwayat.php">RIWAYAT BELANJA</a></li>
			<li><a href="logout.php">LOGOUT</a></li>
		<!--blm login atau blum ada session pelanggan-->
		<?php else: ?>
			<li><a href="login.php">LOGIN</a></li>	
			<li><a href="daftar.php">DAFTAR</a></li>	
		<?php endif ?>
		<li><a href="checkout.php">CHECKOUT</a></li>
	</ul>

	<form action="pencarian.php" method="get" class="navbar-form navbar-right">
		<input type="text" class="form-control" name="keyword">
		<button class="btn btn-primary">Cari</button>
	</form>
	</div>
</nav>
