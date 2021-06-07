<?php
//koneksi ke data base
session_start();
$koneksi = new mysqli("localhost","root","","tokosepatu")
?>

<!DOCTYPE html>
<html>
   <head>
      <title> Toko Sepatu Ketintang </title>
      <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
   </head>
   <body>
      

   <!--Navbar-->
   <Nav class="navbar navbar-deafult">
      <div class="container">

      <ul class="nav navbar-nav">
         <li> <a href="beranda_user.php">Daftar Produk</a></li>
         <li><a href="pesanan_saya.php">Pesanan Saya</a></li>
      </ul>
      </div>
   </Nav>

   <!--konten-->
   <section class="konten">
      <div class="container">
         <h1>Produk Terbaru</h1>
         <div class="row">

         <?php
            if (isset($_POST['btn_beli'])) 
            {
               $harga_produk = $_POST['harga_produk'];
               $nama_produk = $_POST['nama_produk'];
               $nama_pelanggan = $_SESSION["nama"];
               $tanggal_pelanggan = date('Y-m-d');
               $ambil=$koneksi->query(" INSERT into pembelian (nama_pelanggan, tanggal_pembelian, harga_pembelian, produk_pembelian) values ('$nama_pelanggan', '$tanggal_pelanggan', '$harga_produk', '$nama_produk') ");
               
               echo "<div class='alert alert-success'>Pembelian sukses</div>";
					echo "<meta http-equiv='refresh' content='1;url=pesanan_saya.php'>";
            }
         ?>

            <?php $ambil= $koneksi->query("SELECT * FROM produk");?>
            <?php while ($perproduk = $ambil->fetch_assoc()){?>
            <form method="post">
            <input type="text" name="harga_produk" hidden value="<?php echo $perproduk['harga_produk']?>">
            <input type="text" name="nama_produk" hidden value="<?php echo $perproduk['nama_produk']?>">
            <div class="col-md-3">
               <div class="thumbnail"> <img src="foto_produk/<?php echo $perproduk['foto_produk']?>" alt="">
                  <div class="caption">
                     <h3><?php echo $perproduk['nama_produk'] ?></h3>
                     <h5><?php echo "Rp " . number_format($perproduk['harga_produk'],2,',','.') ?></h5>
                     <button type="submit" name="btn_beli" class="btn btn-primary">Beli</button>
                  </div>
               </div>
            </div>
            </form>
            <?php } ?>
         </div>
      </div>
      
   </section>
   
   </body>
</html>