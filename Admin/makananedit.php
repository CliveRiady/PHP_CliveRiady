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
    header("location:makanan.php");
}
if (isset($_POST['Ubah'])) {
    $makanankode = $_REQUEST['inputkode'];

    $namamakanan = $_POST['inputnama'];
    $deskripsi = $_POST['inputdesc'];
    $harga = $_POST['inputharga'];
    $kodekabupaten = $_POST['inputkode2'];

    $nama = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];

    if (empty($nama)) {
        mysqli_query($connection, "UPDATE makanan set makanannama='$namamakanan', kabupatenKODE = '$kodekabupaten', makanandesc ='$deskripsi', makananharga='$harga'
            where makananID = '$makanankode'");
        echo "<script>alert('DATA BERHASIL DIUBAH');
            document.location='makanan.php'</script>";
    } else {
        $ekstensifile = pathinfo($nama, PATHINFO_EXTENSION);
    }

    // PERIKSA EKTEN FILE HARUS JPG ATAU jpg
    if (($ekstensifile == "jpg") or ($ekstensifile == "JPG")) {
        move_uploaded_file($file_tmp, 'images-makanan/' . $nama); // unggah file ke folder images
        mysqli_query($connection, "UPDATE makanan set makanannama='$namamakanan', kabupatenKODE = '$kodekabupaten', makanandesc ='$deskripsi', makananharga='$harga', makananfoto='$nama'
        where makananID = '$makanankode'");
        echo "<script>alert('DATA BERHASIL DIUBAH');
        document.location='makanan.php'</script>";
    } else {
        echo "<script>alert('DATA GAGAL DIUPDATE');
        document.location='makanan.php'</script>";
    }
}
$makanankode = $_GET["ubah"];
$editmakanan = mysqli_query($connection, "SELECT * from makanan, kabupaten
    where makananID = '$makanankode' and makanan.kabupatenKODE = kabupaten.kabupatenKODE");
$rowedit = mysqli_fetch_array($editmakanan);
$datakabupaten = mysqli_query($connection, "SELECT * from kabupaten");
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
                            <h1 class="display-4">Input Makanan</h1>
                        </div>
                    </div>

                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="kodemakanan" class="col-sm-2 col-form-label">Kode</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kodemakanan" name="inputkode" placeholder="Kode Makanan" maxlength="4" value="<?php echo $rowedit["makananID"] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="namamakanan" class="col-sm-2 col-form-label">Nama Makanan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="namamakanan" name="inputnama" placeholder="Nama Makanan" value="<?php echo $rowedit["makanannama"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi Makanan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="deskripsi" name="inputdesc" placeholder="Deskripsi Makanan" value="<?php echo $rowedit["makanandesc"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="harga" name="inputharga" placeholder="Harga Makanan" value="<?php echo $rowedit["makananharga"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Photo Makanan</label>
                            <div class="col-sm-10">
                                <input type="file" id="file" name="file">
                                <?php if (is_file("images-makanan/" . $rowedit['makananfoto'])) { ?>
                                    <img src="images-makanan/<?php echo $rowedit['makananfoto'] ?>" style="height:100px;">
                                    <p class="help-block">Field ini digunakan untuk unggah file</p>
                                <?php } else
                                    echo "<img src='img/noimage.png' height='100px';>"
                                ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kodekabupaten" class="col-sm-2 col-form-label">Kode Kabupaten</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="inputkode2" id="kodekabupaten">
                                    <option value="<?php echo $rowedit["kabupatenKODE"] ?>">
                                        <?php echo $rowedit["kabupatenKODE"] ?>
                                        <?php echo $rowedit["kabupatenNAMA"] ?>
                                    </option>
                                    <?php while ($row = mysqli_fetch_array($datakabupaten)) { ?>
                                        <option value="<?php echo $row["kabupatenKODE"] ?>">
                                            <?php echo $row["kabupatenKODE"] ?>
                                            <?php echo $row["kabupatenNAMA"] ?>
                                        </option>
                                    <?php } ?>
                                </select>
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
                            <h1 class="display-4">Daftar Makanan</h1>
                        </div>
                    </div>

                    <!-- Search Bar -->
                    <form method="POST">
                        <div class="form-group row mb-4">
                            <label for="search" class="col-sm-3">Nama Makanan</label>
                            <div class="col-sm-6">
                                <input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST['search'])) {
                                                                                                                echo $_POST['search'];
                                                                                                            } ?>" placeholder="Cari Nama Makanan">
                            </div>
                            <input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
                        </div>
                    </form>
                    <!-- Penutup Search Bar -->

                    <table class="table table-hover table-info">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Kode Makanan</th>
                                <th>Nama Makanan</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Foto</th>
                                <th>Kode Kabupaten</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (isset($_POST["kirim"])) {
                                $search = $_POST['search'];
                                $query = mysqli_query($connection, "SELECT *
                                                            from makanan
                                                            where makanannama like '%" . $search . "%' ");
                            } else {
                                $query = mysqli_query($connection, "SELECT * from makanan");
                            }
                            $nomor = 1;
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $row['makananID']; ?></td>
                                    <td><?php echo $row['makanannama']; ?></td>
                                    <td><?php echo $row['makanandesc']; ?></td>
                                    <td><?php echo $row['makananharga']; ?></td>

                                    <td>
                                        <?php if (is_file("images-makanan/" . $row['makananfoto'])) { ?>
                                            <img src="images-makanan/<?php echo $row['makananfoto'] ?>" width="80">
                                        <?php } else
                                            echo "<img src='img/noimage.png' width='80'>"
                                        ?>
                                    </td>
                                    <td><?php echo $row['kabupatenKODE']; ?></td>
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