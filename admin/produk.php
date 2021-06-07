<h3> Data Produk </h3>
<a href="index.php?halaman=tambahproduk" class="btn btn-primary" style="margin-bottom:10px;">Tambah Data</a>

<table class="table table-bordered mt-1">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Berat</th>
            <th>Foto</th>
            <th>Deskripsi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1;?>
        <?php $ambil=$koneksi->query("SELECT * FROM produk");?>
        <?php while($pecah = $ambil->fetch_assoc()){?>
    
    
           <tr>
            <td><?php echo $nomor;?></td>
            <td><?php echo $pecah ['nama_produk']; ?></td>
            <td><?php echo $pecah ['harga_produk'];?></td>
            <td><?php echo $pecah ['berat_produk'];?></td>
            <td>
                     <img src="../foto_produk/<?php echo $pecah ['foto_produk'];?>" width="100">   
            </td>
            <td>
                <a href="index.php?halaman=hapusproduk&id=<?php echo$pecah['id_produk'];?>"class="btn-danger btn">Hapus</a>
                <a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_produk'];?>"class="btn btn warning">Ubah</a>
            
            </td>
        </tr>
        <?php $nomor++;?>
        <?php }?>
    </tbody>
</table>
