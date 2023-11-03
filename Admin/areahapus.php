<?php
include "includes/config.php";
if (isset($_GET['hapusarea'])) {
    $kodearea = $_GET["hapusarea"];
    mysqli_query($connection, "delete from area
    where areaID = '$kodearea'");
    echo "<script>alert('DATA BERHASIL DIHAPUS');
        document.location='area.php'</script>";
}
