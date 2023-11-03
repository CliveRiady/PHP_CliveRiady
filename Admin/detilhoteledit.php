<!DOCTYPE html>
<html lang="en">

<?php
ob_start();
session_start();
if (!isset($_SESSION['emailuser']))
    header("location:login.php");

include "header.php";
include "includes/config.php";

if (isset($_POST['Batal'])) {
    header("location:detilhotel.php");
}
if (isset($_POST['Ubah'])) {
    $kodekabupaten = $_REQUEST['inputkode'];

    $harga = $_POST['inputharga'];
    $breakfast = $_POST['inputsarapan'];
    $map = $_POST['inputpeta'];

    mysqli_query($connection, "update detilhotel set hotelharga='$harga', hotelsarapan='$breakfast', hotelpeta='$map'
                                    where hotelID = '$kodekabupaten'");
    echo "<script>alert('DATA BERHASIL DIUBAH');
    document.location='detilhotel.php'</script>";
}

$kodedetilhotel = $_GET["ubahdetilhotel"];
$editdetilhotel = mysqli_query($connection, "select * from detilhotel 
    where hotelID = '$kodedetilhotel'");
$rowedit = mysqli_fetch_array($editdetilhotel);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title>Daftar Detil Tambahan Hotel</title>
</head>

<body>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">Input Hotel</h1>
                        </div>
                    </div>

                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="kodehotel" class="col-sm-2 col-form-label">Kode</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kodehotel" name="inputkode" placeholder="Kode Hotel" maxlength="4" value="<?php echo $rowedit["hotelID"] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hargahotel" class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="hargahotel" name="inputharga" placeholder="Harga Terendah" value="<?php echo $rowedit["hotelharga"] ?>">
                            </div>
                        </div>

                        <div class=" form-group row">
                            <label for="sarapanhotel" class="col-sm-2 col-form-label">Jenis Sarapan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="sarapanhotel" name="inputsarapan" placeholder="Jenis Sarapan" value="<?php echo $rowedit["hotelsarapan"] ?>">
                            </div>
                        </div>

                        <div class=" form-group row">
                            <label for="peta" class="col-sm-2 col-form-label">Peta</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="peta" name="inputpeta" placeholder="Peta Hotel" value="<?php echo $rowedit["hotelpeta"] ?>">
                            </div>
                        </div>

                        <div class=" form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <input type="submit" name="Ubah" class="btn btn-primary" value="Ubah">
                                <input type="submit" name="Batal" class="btn btn-secondary" value="Batal">
                            </div>
                        </div>

                    </form>
                </div>

                <div class="col-sm-1"></div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">Daftar Data Tambahan Hotel</h1>
                        </div>
                    </div>

                    <!-- Search Bar -->
                    <form method="POST">
                        <div class="form-group row mb-4">
                            <label for="search" class="col-sm-3">Nama Hotel</label>
                            <div class="col-sm-6">
                                <input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST['search'])) {
                                                                                                                echo $_POST['search'];
                                                                                                            } ?>" placeholder="Cari Nama Hotel">
                            </div>
                            <input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
                        </div>
                    </form>
                    <!-- Penutup Search Bar -->

                    <table class="table table-hover table-info">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Kode Hotel</th>
                                <th>Nama Hotel</th>
                                <th>Jenis Sarapan</th>
                                <th>Harga</th>
                                <th>Alamat Peta</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (isset($_POST["kirim"])) {
                                $search = $_POST['search'];
                                $query = mysqli_query($connection, "SELECT *
                                                            from hotel, detilhotel
                                                            where hotel.hotelID = detilhotel.hotelID and
                                                            hotelnama like '%" . $search . "%' ");
                            } else {
                                $query = mysqli_query($connection, "SELECT * from hotel, detilhotel where hotel.hotelID = detilhotel.hotelID");
                            }
                            $nomor = 1;
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $row['hotelID']; ?></td>
                                    <td><?php echo $row['hotelnama']; ?></td>
                                    <td><?php echo $row['hotelharga']; ?></td>
                                    <td><?php echo $row['hotelsarapan']; ?></td>
                                    <td><?php echo $row['hotelpeta']; ?></td>
                                </tr>
                                <?php $nomor = $nomor + 1; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
    </div> <!-- penutup container fluid -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
</body>

<?php
include "footer.php";
mysqli_close($connection);
ob_end_flush();
?>

</html>