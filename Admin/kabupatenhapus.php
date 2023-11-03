<?php
include "includes/config.php";
if (isset($_GET['hapuskabupaten'])) {
    $kabupatenkode = $_GET['hapuskabupaten'];
    $hapuskabupaten = mysqli_query($connection, "select * from kabupaten
        where kabupatenKODE = '$kabupatenkode'");
    $hapus = mysqli_fetch_array($hapuskabupaten);
    $namafile = $hapus['kabupatenFOTOICON'];

    mysqli_query($connection, "delete from kabupaten
        where kabupatenKODE = '$kabupatenkode'");
    unlink('images-kabupaten/' . $namafile);

    echo "<script>alert('DATA BERHASIL DIHAPUS');
    document.location='kabupaten.php'</script>";
}
