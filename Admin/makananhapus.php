<?php
include "includes/config.php";
if (isset($_GET['hapus'])) {
    $kodemakanan = $_GET['hapus'];
    $hapusmakanan = mysqli_query($connection, "select * from makanan
        where makananID = '$kodemakanan'");
    $hapus = mysqli_fetch_array($hapusmakanan);
    $namafile = $hapus['makananfoto'];

    mysqli_query($connection, "delete from makanan
        where makananID = '$kodemakanan'");
    unlink('images-makanan/' . $namafile);

    echo "<script>alert('DATA BERHASIL DIHAPUS');
    document.location='makanan.php'</script>";
}
