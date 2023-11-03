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
    header("location:provinsi.php");
}
if (isset($_POST['Ubah'])) {
    $kodeprovinsi = $_REQUEST['inputkode'];

    $namaprovinsi = $_POST['inputnama'];
    $keterangan = $_POST['inputket'];
    $ketfotoicon = $_POST['inputKetFoto'];

    $nama = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];

    if (empty($nama)) {
        mysqli_query($connection, "update provinsi set provinsiNAMA='$namaprovinsi', provinsiKODE = '$kodeprovinsi', provinsiKET='$keterangan', provinsiFOTOICONKET='$ketfotoicon'
            where provinsiKODE = '$kodeprovinsi'");
        header("location:provinsi.php");
    } else {
        $ekstensifile = pathinfo($nama, PATHINFO_EXTENSION);
    }

    // PERIKSA EKTEN FILE HARUS JPG ATAU jpg
    if (($ekstensifile == "jpg") or ($ekstensifile == "JPG")) {
        move_uploaded_file($file_tmp, 'images-provinsi/' . $nama); // unggah file ke folder images
        mysqli_query($connection, "update provinsi set provinsiNAMA='$namaprovinsi', provinsiKODE='$kodeprovinsi', provinsiKET='$keterangan',
                                                        provinsiFOTOICON='$nama'
                                    where provinsiKODE = '$kodeprovinsi'");
        header("location:provinsi.php");
    }
}


$kodeprovinsi = $_GET["ubahprovinsi"];
$editprovinsi = mysqli_query($connection, "select * from provinsi 
    where provinsiKODE = '$kodeprovinsi'");
$rowedit = mysqli_fetch_array($editprovinsi);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title>Daftar provinsi</title>
</head>

<body>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">Input provinsi</h1>
                        </div>
                    </div>

                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="kodeprovinsi" class="col-sm-2 col-form-label">Kode</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kodeprovinsi" name="inputkode" placeholder="Kode provinsi" maxlength="4" value="<?php echo $rowedit["provinsiKODE"] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="namaprovinsi" class="col-sm-2 col-form-label">Nama provinsi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="namaprovinsi" name="inputnama" placeholder="Nama provinsi" value="<?php echo $rowedit["provinsiNAMA"] ?>">
                            </div>
                        </div>

                        <div class=" form-group row">
                            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="keterangan" name="inputket" placeholder="Keterangan" value="<?php echo $rowedit["provinsiKET"] ?>">
                            </div>
                        </div>

                        <div class=" form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Photo provinsi</label>
                            <div class="col-sm-10">
                                <input type="file" id="file" name="file">
                                <?php if (is_file("images-provinsi/" . $rowedit['provinsiFOTOICON'])) { ?>
                                    <img src="images-provinsi/<?php echo $rowedit['provinsiFOTOICON'] ?>" style="height:100px;">
                                    <p class="help-block">Field ini digunakan untuk unggah file</p>
                                <?php } else
                                    echo "<img src='img/noimage.png' height='100px';>"
                                ?>
                            </div>
                        </div>

                        <div class=" form-group row">
                            <label for="ketfoto" class="col-sm-2 col-form-label">Keterangan Foto Icon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ketfoto" name="inputKetFoto" placeholder="Keterangan Foto Icon" value="<?php echo $rowedit["provinsiFOTOICONKET"] ?>">
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
                            <h1 class="display-4">Daftar provinsi</h1>
                        </div>
                    </div>

                    <!-- Search Bar -->
                    <form method="POST">
                        <div class="form-group row mb-4">
                            <label for="search" class="col-sm-3">Nama Destinasi</label>
                            <div class="col-sm-6">
                                <input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST['search'])) {
                                                                                                                echo $_POST['search'];
                                                                                                            } ?>" placeholder="Cari Nama provinsi">
                            </div>
                            <input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
                        </div>
                    </form>
                    <!-- Penutup Search Bar -->

                    <table class="table table-hover table-info">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Kode provinsi</th>
                                <th>Nama provinsi</th>
                                <th>Keterangan</th>
                                <th>Foto Icon</th>
                                <th>Keterangan Foto Icon</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (isset($_POST["kirim"])) {
                                $search = $_POST['search'];
                                $query = mysqli_query($connection, "SELECT *
                                                            from provinsi
                                                            where provinsiNAMA like '%" . $search . "%' ");
                            } else {
                                $query = mysqli_query($connection, "SELECT * from provinsi");
                            }
                            $nomor = 1;
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $row['provinsiKODE']; ?></td>
                                    <td><?php echo $row['provinsiNAMA']; ?></td>
                                    <td><?php echo $row['provinsiKET']; ?></td>
                                    <td>
                                        <?php if (is_file("images-provinsi/" . $row['provinsiFOTOICON'])) { ?>
                                            <img src="images-provinsi/<?php echo $row['provinsiFOTOICON'] ?>" width="80">
                                        <?php } else
                                            echo "<img src='img/noimage.png' width='80'>"
                                        ?>
                                    </td>
                                    <td><?php echo $row['provinsiFOTOICONKET']; ?></td>
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