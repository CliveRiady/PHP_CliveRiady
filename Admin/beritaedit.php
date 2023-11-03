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
    header("location:berita.php");
}
if (isset($_POST['Edit'])) {
    $kodeberita = $_REQUEST['inputkode'];
    $judulberita = $_POST['inputjudul'];
    $intiberita = $_POST['inputinti'];
    $penulis = $_POST['inputpenulis'];
    $penerbit = $_POST['inputpenerbit'];
    $tanggal = $_POST['inputtanggal'];
    $kodedestinasi = $_POST['inputkodedestinasi'];

    mysqli_query($connection, "update berita set  beritajudul='$judulberita', beritainti='$intiberita', penulis='$penulis', penerbit='$penerbit',tanggalterbit='$tanggal',destinasiID='$kodedestinasi'
    where beritaID = '$kodeberita'");
    header("location:berita.php");
}

$datadestinasi = mysqli_query($connection, "select * from destinasi");

$kodeberita = $_GET['edit'];
$editberita = mysqli_query($connection, "select * from berita, destinasi where beritaID='$kodeberita' and berita.destinasiID=destinasi.destinasiID");
$rowedit = mysqli_fetch_array($editberita);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title>Daftar Berita</title>
</head>

<body>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">Input Berita</h1>
                        </div>
                    </div>

                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="kodeberita" class="col-sm-2 col-form-label">Kode</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kodeberita" name="inputkode" placeholder="Kode berita" maxlength="4" readonly value="<?php echo $rowedit["beritaID"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="judulberita" class="col-sm-2 col-form-label">Judul Berita</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="judulberita" name="inputjudul" placeholder="Judul Berita" value="<?php echo $rowedit["beritajudul"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="intiberita" class="col-sm-2 col-form-label">Inti Berita</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="intiberita" name="inputinti" placeholder="Inti Berita" value="<?php echo $rowedit["beritainti"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="penerbit" class="col-sm-2 col-form-label">Penulis</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="penerbit" name="inputpenerbit" placeholder="Penerbit" value="<?php echo $rowedit["penerbit"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="penulis" class="col-sm-2 col-form-label">Penerbit</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="penulis" name="inputpenulis" placeholder="Penulis" value="<?php echo $rowedit["penulis"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Terbit</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggal" name="inputtanggal" value="<?php echo date('Y-m-d'); ?>" value="<?php echo $rowedit["tanggalterbit"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kodedestinasi" class="col-sm-2 col-form-label">Kode Destinasi</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="inputkodedestinasi" id="kodedestinasi">
                                    <?php while ($row = mysqli_fetch_array($datadestinasi)) { ?>
                                        <option value="<?php echo $rowedit["destinasiID"] ?>">
                                            <?php echo $rowedit["destinasiID"] ?>
                                            <?php echo $rowedit["destinasinama"] ?>
                                        </option>
                                        <option value="<?php echo $row["destinasiID"] ?>">
                                            <?php echo $row["destinasiID"] ?>
                                            <?php echo $row["destinasinama"] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <input type="submit" name="Edit" class="btn btn-primary" value="Edit">
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
                            <h1 class="display-4">Daftar Berita</h1>
                        </div>
                    </div>

                    <!-- Search Bar -->
                    <form method="POST">
                        <div class="form-group row mb-4">
                            <label for="search" class="col-sm-3">Nama Destinasi</label>
                            <div class="col-sm-6">
                                <input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST['search'])) {
                                                                                                                echo $_POST['search'];
                                                                                                            } ?>" placeholder="Cari Judul Berita">
                            </div>
                            <input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
                        </div>
                    </form>
                    <!-- Penutup Search Bar -->

                    <table class="table table-hover table-info">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Berita ID</th>
                                <th>Judul Berita</th>
                                <th>Inti Berita</th>
                                <th>Penerbit</th>
                                <th>Penulis</th>
                                <th>Tanggal Terbit</th>
                                <th>Destinasi ID</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (isset($_POST["kirim"])) {
                                $search = $_POST['search'];
                                $query = mysqli_query($connection, "SELECT *
                                                            from berita
                                                            where beritajudul like '%" . $search . "%' ");
                            } else {
                                $query = mysqli_query($connection, "SELECT * from berita");
                            }
                            $nomor = 1;
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $row['beritaID']; ?></td>
                                    <td><?php echo $row['beritajudul']; ?></td>
                                    <td><?php echo $row['beritainti']; ?></td>
                                    <td><?php echo $row['penerbit']; ?></td>
                                    <td><?php echo $row['penulis']; ?></td>
                                    <td><?php echo $row['tanggalterbit']; ?></td>
                                    <td><?php echo $row['destinasiID']; ?></td>
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