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
         <h1>Keranjang Saya</h1>
         <br>
         <div class="row">
             <div class="col-12">
                 <center>
                    <button class="btn center btn-danger text-center" id="total_pembelian">Pembelian Pending : Rp. 00.000 </button>
                    <button class="btn center btn-success text-center" id="total_pembelian_berhasil">Pembelian Berhasil : Rp. 00.000 </button>
                 </center>
             </div>
         </div>
         <br>
         <br>
        
         <div class="row">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama Pembelian</th>
                                <th>Tanggal Pembelian</th>
                                <th>Produk Pembelian</th>
                                <th>Harga Pembelian</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $total = 0;
                            $total_berhasil = 0;
                            $ambil= $koneksi->query("SELECT * FROM pembelian");
                        ?>
                        <?php while ($perproduk = $ambil->fetch_assoc()){?>
                            
                            <?php
                               
                                if($perproduk['status'] == 'lunas'){
                                    $total_berhasil += $perproduk['harga_pembelian'];
                                }else{
                                    $total += $perproduk['harga_pembelian'];    
                                }
                            ?>

                            <tr>
                                <td><?php echo $perproduk['nama_pelanggan'] ?></td>
                                <td><?php echo date('d F Y',strtotime($perproduk['tanggal_pembelian'])) ?></td>
                                <td><?php echo $perproduk['produk_pembelian'] ?></td>
                                <td><?php echo "Rp " . number_format($perproduk['harga_pembelian'],2,',','.') ?></td>
                                <td><?php
                                   if($perproduk['status'] == 'order'):?>
                                    <button class="btn btn-danger btn-xs">Order</button>
                                    <?php else: ?>
                                        <button class="btn btn-success btn-xs">Success</button>
                                    <?php endif?>
                                </td>
                                <td class="text-center">
                                    <form method="post">
                                        <input type="text" hidden name="id_pembelian" value="<?php echo $perproduk['id_pembelian']?>">
                                        <button type="submit" name="hapus_produk" class="btn btn-danger btn-xs" <?php if($perproduk['status'] == 'lunas'):?> disabled <?php endif?>>Hapus</button>
                                    </form>
                                   
                                    <a <?php if($perproduk['status'] == 'lunas'):?> disabled <?php endif?> target="_blank" class="btn btn-warning btn-xs" href="https://wa.me/6282198467711?text=Saya ingin membeli sepatu <?php echo $perproduk['produk_pembelian'] ?> yang berharga Rp.<?php echo number_format($perproduk['harga_pembelian'],2,',','.') ?> dengan bukti transfer ini ">Cara Pembelian via WA</a>
                                </td>
                            </tr>
                            
                                
                      
                        <?php }?>

                        <?php
								if (isset($_POST['hapus_produk'])) 
								{
									$id_pembelian = $_POST['id_pembelian'];
									$ambil=$koneksi->query("DELETE from pembelian where id_pembelian = '$id_pembelian' ");
		
									echo "<div class='alert alert-info'>Data berhasil dihapus</div>";
                                    echo "<meta http-equiv='refresh' content='1;url=pesanan_saya.php'>";
                                    
								}
							?>

                        <input type="text" hidden id="total_brok" value="<?php echo "Rp " . number_format($total,2,',','.')?>">
                        <input type="text" hidden id="total_brok_berhasil" value="<?php echo "Rp " . number_format($total_berhasil,2,',','.')?>">
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
      </div>
   </section>

   <script src="admin/assets/js/jquery-1.10.2.js"></script>
   <script>
       $(document).ready(function(){
           $('#total_pembelian').text("Pembelian Pending " + $('#total_brok').val());
           $('#total_pembelian_berhasil').text("Pembelian Berhasil " + $('#total_brok_berhasil').val());
       });
   </script>
   
   </body>
</html>