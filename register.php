<?php
//koneksi ke data base
session_start();
$koneksi = new mysqli("localhost","root","","tokosepatu")
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Login 04</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="assets/login/css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">TOKO SEPATU KETINTANG</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(assets/login/images/sepatu8.jpg);">
			      </div>
						<div class="login-wrap p-4 p-md-5">
							<?php
								if (isset($_POST['login'])) 
								{
									$email = $_POST['email'];
									$pass = $_POST['pass'];
									$nama = $_POST['nama'];
									$telepon = $_POST['telepon'];
									$ambil=$koneksi->query("INSERT into pelanggan (email_pelanggan,password_pelanggan,nama_pelanggan, telepon_pelanggan) values ('$email','$pass','$nama','$telepon')");
									echo "<div class='alert alert-info'>Register sukses</div>";
									echo "<meta http-equiv='refresh' content='1;url=login.php'>";
								}
							?>
							<div class="d-flex">
								<div class="w-100">
									<h3 class="mb-4">Register</h3>
								</div>
								<div class="w-100"></div>
							</div>
							<form action="register.php" method="post">
								<div class="form-group mb-3">
									<label class="label" for="email">Email</label>
									<input type="text" class="form-control" name="email" required>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="password">Password</label>
									<input type="password" class="form-control" name="pass" required>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="nama">Nama</label>
									<input type="text" class="form-control" name="nama" required>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="telepon">Telepon</label>
									<input type="text" class="form-control" name="telepon" required>
								</div>
								<div class="form-group">
									<button type="submit" name="login" class="form-control btn btn-success rounded submit px-3">Register</button>
								</div>
							</form>
						</div>
					</div>
		      </div>
			</div>
		</div>
	</section>

	<script src="assets/login/js/jquery.min.js"></script>
  <script src="assets/login/js/popper.js"></script>
  <script src="assets/login/js/bootstrap.min.js"></script>
  <script src="assets/login/js/main.js"></script>

	</body>
</html>

