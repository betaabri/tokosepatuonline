<h2> Ubah Produk</h2>

<?php
$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah=$ambil->fetch_assoc();
$id = $_GET['id'];


?>

<form method="post" enctype="multipart/form-data">
<input type="hidden" name="id_produk" id="id_produk" value="<?php echo $pecah ['id_produk'];?>">

<div class="form-group">
<label>Nama Produk</label>
<input type="text" name="nama" class="form-control" value="<?php echo $pecah ['nama_produk'];?>">
</div>


<div class="form-group">
<label>Harga Rp</label>
<input type="number" class="form-control" name="harga" value="<?php echo $pecah ['harga_produk'];?>">
</div>


<div class="form-group">
<label>Berat(Gr)</label>
<input type="number" class="form-control" name="berat" value="<?php echo $pecah ['berat_produk'];?>">
</div>


<div class="form-group">
<img src="../foto_produk/<?php echo $pecah ['foto_produk']?>" width="200">
</div>

<div class="form-group">
<label>Ganti Foto</label>
<input type="file" name="foto" class="form-control" >
</div>

<div class="form-group">
<label>Deskripsi</label>
<textarea name="deskripsi" class="form-control" rows="10"> <?php echo $pecah['deskripsi_produk'];?> 
</textarea>
</div>

<button class="btn btn-primary" name="ubah">Ubah</button>
</form>
<?php
if (isset($_POST['ubah']))
{
    $namafoto=$_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];
    //jika foto dirubah
    if (!empty($lokasifoto))
    {
        move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");

        $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',harga_produk='$_POST[harga]',berat_produk='$_POST[berat]',foto_produk='$namafoto',deskripsi_produk='$_POST[deskripsi]' WHERE id_produk='$id'");       
    }
    else
    {
        $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',harga_produk='$_POST[harga]', berat_produk='$_POST[berat]',deskripsi_produk='$_POST[deskripsi]' WHERE id_produk='$_GET(id)'");
    }
        echo "<div class='alert alert-info'>Data produk telah diubah</div>";
        echo " <script>location='index.php?halaman=produk';</script>";
}
?>