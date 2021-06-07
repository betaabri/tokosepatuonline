<?php
//koneksi ke data base
$koneksi = new mysqli("localhost","root","","tokosepatu")
?>

<h2> Data pembelian </h2>

        <?php
            if (isset($_POST  ['acc_pembelian']))  //memeriksa inputan dari form
            {
               $id_pembelian = $_POST['id_pembelian'];

               $ambil=$koneksi->query("UPDATE pembelian set status = 'lunas' where id_pembelian = '$id_pembelian' ");
               
               echo "<div class='alert alert-success'>Pembelian berhasil divalidasi</div>";
            }
         ?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Pesanan</th>
            <Th>Total</Th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $total = 0;
            $ambil= $koneksi->query("SELECT * FROM pembelian");
        ?>
        <?php while ($perproduk = $ambil->fetch_assoc()){?> 
            
            <?php
                $total += $perproduk['harga_pembelian'];    
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

                <form method="post">
                    <input type="text" name="id_pembelian" hidden value="<?php echo $perproduk['id_pembelian']?>">
                    <td><button type="submit" name='acc_pembelian' class="btn btn-info btn-xs">Validasi Pembelian</button></td>
                </form>
            </tr>
        <?php }?>



    </tbody>
</table>