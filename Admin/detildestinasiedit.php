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
    header("location:detildestinasi.php");
}
if (isset($_POST['Ubah'])) {
    $kodedestinasi = $_REQUEST['inputkode'];

    $deskripsi = $_POST['inputdesc'];
    $isi = $_POST['inputisi'];
    $tanggal = $_POST['inputtanggal'];

    mysqli_query($connection, "update detildestinasi set detildestinasidesc='$deskripsi', detildestinasiteks='$isi', detildestinasitanggal='$tanggal'
    where destinasiID = '$kodedestinasi'");
    echo "<script>alert('DATA BERHASIL DIUBAH');
    document.location='detildestinasi.php'</script>";
}
$kodedestinasi = $_GET["ubah"];
$editdetildestinasi = mysqli_query($connection, "select * from detildestinasi 
    where destinasiID = '$kodedestinasi'");
$rowedit = mysqli_fetch_array($editdetildestinasi);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title>Daftar Detil Tambahan Destinasi</title>
</head>

<body>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">Input Detil Tambahan Destinasi</h1>
                        </div>
                    </div>

                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="kodedestinasi" class="col-sm-2 col-form-label">Kode Destinasi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kodedestinasi" name="inputkode" value="<?php echo $rowedit["destinasiID"] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="descdestinasi" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="descdestinasi" name="inputdesc" placeholder="Deskripsi Destinasi" value="<?php echo $rowedit["detildestinasidesc"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="isi" class="col-sm-2 col-form-label">Isi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="isi" name="inputisi" placeholder="Isi Teks Detil Destinasi" value="<?php echo $rowedit["detildestinasiteks"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Terbit</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggal" name="inputtanggal" placeholder="" value="<?php echo $rowedit["detildestinasitanggal"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
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
                            <h1 class="display-4">Daftar Data Tambahan Destinasi</h1>
                        </div>
                    </div>

                    <!-- Search Bar -->
                    <form method="POST">
                        <div class="form-group row mb-4">
                            <label for="search" class="col-sm-3">Nama Destinasi</label>
                            <div class="col-sm-6">
                                <input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST['search'])) {
                                                                                                                echo $_POST['search'];
                                                                                                            } ?>" placeholder="Cari Nama Destinasi">
                            </div>
                            <input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
                        </div>
                    </form>
                    <!-- Penutup Search Bar -->

                    <table class="table table-hover table-info">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Kode Destinasi</th>
                                <th>Nama Destinasi</th>
                                <th>Deskripsi</th>
                                <th>Isi</th>
                                <th>Tanggal Pembuatan Teks</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (isset($_POST["kirim"])) {
                                $search = $_POST['search'];
                                $query = mysqli_query($connection, "SELECT *
                                                            from destinasi, detildestinasi
                                                            where destinasi.destinasiID = detildestinasi.destinasiID and
                                                            destinasinama like '%" . $search . "%' ");
                            } else {
                                $query = mysqli_query($connection, "SELECT * from destinasi, detildestinasi where destinasi.destinasiID = detildestinasi.destinasiID");
                            }
                            $nomor = 1;
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $row['destinasiID']; ?></td>
                                    <td><?php echo $row['destinasinama']; ?></td>
                                    <td><?php echo $row['detildestinasidesc']; ?></td>
                                    <td><?php echo $row['detildestinasiteks']; ?></td>
                                    <td><?php echo $row['detildestinasitanggal']; ?></td>
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