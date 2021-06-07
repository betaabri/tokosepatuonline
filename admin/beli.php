<?php
$id_produk = $_GET ['íd'];


if (isset($_SESSION['keranjang'][$id_produk])) 
{
    $_SESSION ['keranjang'][$id_produk]=1; # code...
}
elseif
{   
     $_SESSION ['keranjang'][$id_produk]=2; # code...
} 
    # code...
 echo "<pre>"
print_r($)
echo "</pre>";