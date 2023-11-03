<?php
include "includes/config.php";
if (isset($_GET['hapus'])) {
    $kodedestinasi = $_GET["hapus"];
    mysqli_query($connection, "delete from detildestinasi
    where destinasiID = '$kodedestinasi'");
    echo "<script>alert('DATA BERHASIL DIHAPUS');
        document.location='detildestinasi.php'</script>";
}
