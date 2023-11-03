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
    header("location:kabupaten.php");
}
if (isset($_POST['Ubah'])) {
    $kodekabupaten = $_REQUEST['inputkode'];

    $namakabupaten = $_POST['inputnama'];
    $alamat = $_POST['inputalamat'];
    $keterangan = $_POST['inputket'];
    $ketfotoicon = $_POST['inputKetFoto'];

    $nama = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];

    if (empty($nama)) {
        mysqli_query($connection, "update kabupaten set kabupatenNAMA='$namakabupaten', kabupatenKODE = '$kodekabupaten', kabupatenALAMAT ='$alamat', kabupatenKET='$keterangan', kabupatenFOTOICONKET='$ketfotoicon'
            where kabupatenKODE = '$kodekabupaten'");
        header("location:kabupaten.php");
    } else {
        $ekstensifile = pathinfo($nama, PATHINFO_EXTENSION);
    }

    // PERIKSA EKTEN FILE HARUS JPG ATAU jpg
    if (($ekstensifile == "jpg") or ($ekstensifile == "JPG")) {
        move_uploaded_file($file_tmp, 'images-kabupaten/' . $nama); // unggah file ke folder images
        mysqli_query($connection, "update kabupaten set kabupatenNAMA='$namakabupaten', kabupatenKODE='$kodekabupaten', kabupatenALAMAT='$alamat', kabupatenKET='$keterangan',
                                                        kabupatenFOTOICON='$nama'
                                    where kabupatenKODE = '$kodekabupaten'");
        header("location:kabupaten.php");
    }
}


$kodekabupaten = $_GET["ubahkabupaten"];
$editkabupaten = mysqli_query($connection, "select * from kabupaten 
    where kabupatenKODE = '$kodekabupaten'");
$rowedit = mysqli_fetch_array($editkabupaten);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title>Daftar Kabupaten</title>
</head>

<body>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">Input Kabupaten</h1>
                        </div>
                    </div>

                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="kodekabupaten" class="col-sm-2 col-form-label">Kode</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kodekabupaten" name="inputkode" placeholder="Kode Kabupaten" maxlength="4" value="<?php echo $rowedit["kabupatenKODE"] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="namakabupaten" class="col-sm-2 col-form-label">Nama Kabupaten</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="namakabupaten" name="inputnama" placeholder="Nama Kabupaten" value="<?php echo $rowedit["kabupatenNAMA"] ?>">
                            </div>
                        </div>

                        <div class=" form-group row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="alamat" name="inputalamat" placeholder="Alamat Kabupaten" value="<?php echo $rowedit["kabupatenALAMAT"] ?>">
                            </div>
                        </div>

                        <div class=" form-group row">
                            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="keterangan" name="inputket" placeholder="Keterangan" value="<?php echo $rowedit["kabupatenKET"] ?>">
                            </div>
                        </div>

                        <div class=" form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Photo Kabupaten</label>
                            <div class="col-sm-10">
                                <input type="file" id="file" name="file">
                                <?php if (is_file("images-kabupaten/" . $rowedit['kabupatenFOTOICON'])) { ?>
                                    <img src="images-kabupaten/<?php echo $rowedit['kabupatenFOTOICON'] ?>" style="height:100px;">
                                    <p class="help-block">Field ini digunakan untuk unggah file</p>
                                <?php } else
                                    echo "<img src='img/noimage.png' height='100px';>"
                                ?>
                            </div>
                        </div>

                        <div class=" form-group row">
                            <label for="ketfoto" class="col-sm-2 col-form-label">Keterangan Foto Icon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ketfoto" name="inputKetFoto" placeholder="Keterangan Foto Icon" value="<?php echo $rowedit["kabupatenFOTOICONKET"] ?>">
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
                            <h1 class="display-4">Daftar Kabupaten</h1>
                        </div>
                    </div>

                    <!-- Search Bar -->
                    <form method="POST">
                        <div class="form-group row mb-4">
                            <label for="search" class="col-sm-3">Nama Destinasi</label>
                            <div class="col-sm-6">
                                <input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST['search'])) {
                                                                                                                echo $_POST['search'];
                                                                                                            } ?>" placeholder="Cari Nama Kabupaten">
                            </div>
                            <input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
                        </div>
                    </form>
                    <!-- Penutup Search Bar -->

                    <table class="table table-hover table-info">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Kode Kabupaten</th>
                                <th>Nama Kabupaten</th>
                                <th>Alamat</th>
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
                                                            from kabupaten
                                                            where kabupatenNAMA like '%" . $search . "%' ");
                            } else {
                                $query = mysqli_query($connection, "SELECT * from kabupaten");
                            }
                            $nomor = 1;
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $row['kabupatenKODE']; ?></td>
                                    <td><?php echo $row['kabupatenNAMA']; ?></td>
                                    <td><?php echo $row['kabupatenALAMAT']; ?></td>
                                    <td><?php echo $row['kabupatenKET']; ?></td>
                                    <td>
                                        <?php if (is_file("images-kabupaten/" . $row['kabupatenFOTOICON'])) { ?>
                                            <img src="images-kabupaten/<?php echo $row['kabupatenFOTOICON'] ?>" width="80">
                                        <?php } else
                                            echo "<img src='img/noimage.png' width='80'>"
                                        ?>
                                    </td>
                                    <td><?php echo $row['kabupatenFOTOICONKET']; ?></td>
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