<?php
include "includes/config.php";
if (isset($_GET['hapusprovinsi'])) {
    $provinsikode = $_GET['hapusprovinsi'];
    $hapusprovinsi = mysqli_query($connection, "select * from provinsi
        where provinsiKODE = '$provinsikode'");
    $hapus = mysqli_fetch_array($hapusprovinsi);
    $namafile = $hapus['provinsiFOTOICON'];

    mysqli_query($connection, "delete from provinsi
        where provinsiKODE = '$provinsikode'");
    unlink('images-provinsi/' . $namafile);

    echo "<script>alert('DATA BERHASIL DIHAPUS');
    document.location='provinsi.php'</script>";
}
