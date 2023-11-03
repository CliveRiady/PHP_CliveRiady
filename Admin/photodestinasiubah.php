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
    header("location:photodestinasi.php");
}
if (isset($_POST['Ubah'])) {
    $kodefoto = $_REQUEST['inputkode'];
    $namafoto = $_POST['inputnama'];
    $kodedestinasi = $_POST['kodedestinasi'];

    $nama = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];

    if (empty($nama)) {
        mysqli_query($connection, "update fotodestinasi set fotonama='$namafoto', destinasiID = '$kodedestinasi'
            where fotoID = '$kodefoto'");
        header("location:photodestinasi.php");
    } else
        $ekstensifile = pathinfo($nama, PATHINFO_EXTENSION);

    // PERIKSA EKTEN FILE HARUS JPG ATAU jpg
    if (($ekstensifile == "jpg") or ($ekstensifile == "JPG")) {
        move_uploaded_file($file_tmp, 'images-destinasi/' . $nama); // unggah file ke folder images
        mysqli_query($connection, "update fotodestinasi set fotonama='$namafoto', destinasiID='$kodedestinasi', fotofile='$nama'
            where fotoID = '$kodefoto'");
        header("location:photodestinasi.php");
    }
}

$datadestinasi = mysqli_query($connection, "select * from destinasi");

$kodefoto = $_GET["ubafoto"];
$editfoto = mysqli_query($connection, "select * from fotodestinasi 
    where fotoID = '$kodefoto'");
$rowedit = mysqli_fetch_array($editfoto);

$editdestinasi = mysqli_query($connection, "select * from destinasi, fotodestinasi
    where fotoID = '$kodefoto' and destinasi.destinasiID = fotodestinasi.destinasiID");
$rowedit2 = mysqli_fetch_array($editdestinasi);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title>Daftar Destinasi Wisata</title>
</head>

<body>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">Edit Photo Destinasi Wisata</h1>
                        </div>
                    </div>

                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="kodefoto" class="col-sm-2 col-form-label">Kode Photo</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kodefoto" name="inputkode" value="<?php echo $rowedit["fotoID"] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="namafoto" class="col-sm-2 col-form-label">Nama Photo</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="namafoto" name="inputnama" value="<?php echo $rowedit["fotonama"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="namadestinasi" class="col-sm-2 col-form-label">Nama Destinasi</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="kodedestinasi" id="namadestinasi">
                                    <option value="<?php echo $rowedit["destinasiID"] ?>">
                                        <?php echo $rowedit["destinasiID"] ?>
                                        <?php echo $rowedit2["destinasinama"] ?>
                                    </option>
                                    <?php while ($row = mysqli_fetch_array($datadestinasi)) { ?>
                                        <option value="<?php echo $row["destinasiID"] ?>">
                                            <?php echo $row["destinasiID"] ?>
                                            <?php echo $row["destinasinama"] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Photo Wisata</label>
                            <div class="col-sm-10">
                                <input type="file" id="file" name="file">
                                <?php if (is_file("images-destinasi/" . $rowedit['fotofile'])) { ?>
                                    <img src="images-destinasi/<?php echo $rowedit['fotofile'] ?>" style="height:100px;">
                                    <p class="help-block">Field ini digunakan untuk unggah file</p>
                                <?php } else
                                    echo "<img src='img/noimage.png' height='100px';>"
                                ?>
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
                            <h1 class="display-4">Daftar Photo Destinasi Wisata</h1>
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
                                <th>Kode Photo</th>
                                <th>Nama Photo Wisata</th>
                                <th>Kode Destinasi</th>
                                <th>Photo Destinasi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (isset($_POST["kirim"])) {
                                $search = $_POST['search'];
                                $query = mysqli_query($connection, "SELECT *
                                                            from fotodestinasi
                                                            where fotonama like '%" . $search . "%' ");
                            } else {
                                $query = mysqli_query($connection, "SELECT * from fotodestinasi");
                            }
                            $nomor = 1;
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $row['fotoID']; ?></td>
                                    <td><?php echo $row['fotonama']; ?></td>
                                    <td><?php echo $row['destinasiID']; ?></td>
                                    <td>
                                        <?php if (is_file("images-destinasi/" . $row['fotofile'])) { ?>
                                            <img src="images-destinasi/<?php echo $row['fotofile'] ?>" width="80">
                                        <?php } else
                                            echo "<img src='img/noimage.png' width='80'>"
                                        ?>
                                    </td>
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

<?php include "footer.php"; ?>
<?php
mysqli_close($connection);
ob_end_flush();
?>

</html>