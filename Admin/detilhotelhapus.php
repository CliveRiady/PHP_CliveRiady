<?php
include "includes/config.php";
if (isset($_GET['hapusdetilhotel'])) {
    $kodehotel = $_GET["hapusdetilhotel"];
    mysqli_query($connection, "delete from detilhotel
    where hotelID = '$kodehotel'");
    echo "<script>alert('DATA BERHASIL DIHAPUS');
        document.location='detilhotel.php'</script>";
}
