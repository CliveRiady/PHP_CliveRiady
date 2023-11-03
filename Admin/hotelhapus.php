<?php
include "includes/config.php";
if (isset($_GET['hapus'])) {
    $kodehotel = $_GET["hapus"];
    mysqli_query($connection, "delete from hotel
    where hotelID = '$kodehotel'");
    echo "<script>alert('DATA BERHASIL DIHAPUS');
        document.location='hotel.php'</script>";
}
