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
    header("location:hotel.php");
}
if (isset($_POST['Edit'])) {
    $kodehotel = $_REQUEST['inputkode'];
    $namahotel = $_POST['inputnama'];
    $alamat = $_POST['inputalamat'];
    $keterangan = $_POST['inputket'];
    $kodearea = $_POST['inputkodearea'];

    $nama = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];

    if (empty($nama)) {
        mysqli_query($connection, "update hotel set hotelnama='$namahotel', hotelalamat='$alamat', hotelketerangan='$keterangan', areaID='$kodearea'
            where hotelID = '$kodehotel'");
        header("location:hotel.php");
    } else
        $ekstensifile = pathinfo($nama, PATHINFO_EXTENSION);

    // PERIKSA EKTEN FILE HARUS JPG ATAU jpg
    if (($ekstensifile == "jpg") or ($ekstensifile == "JPG")) {
        move_uploaded_file($file_tmp, 'images-hotel/' . $nama); // unggah file ke folder images
        mysqli_query($connection, "update hotel set hotelnama='$namahotel', hotelalamat='$alamat', hotelketerangan='$keterangan', areaID='$kodearea', hotelfoto='$nama'
            where hotelID = '$kodehotel'");
        header("location:hotel.php");
    }
}

$dataarea = mysqli_query($connection, "select * from area, kabupaten where area.kabupatenKODE=kabupaten.kabupatenKODE");

$kodehotel = $_GET["edit"];
$edithotel = mysqli_query($connection, "select * from hotel, area, kabupaten
    where hotelID = '$kodehotel' and area.areaID = hotel.areaID and area.kabupatenKODE = kabupaten.kabupatenKODE");
$rowedit = mysqli_fetch_array($edithotel);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title>Daftar Hotel</title>
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
                            <label for="kodehotel" class="col-sm-2 col-form-label">Kode Hotel</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kodehotel" name="inputkode" placeholder="Kode Hotel" maxlength="4" value="<?php echo $rowedit["hotelID"] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="namahotel" class="col-sm-2 col-form-label">Nama Hotel</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="namahotel" name="inputnama" placeholder="Nama Hotel" value="<?php echo $rowedit["hotelnama"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamathotel" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="alamathotel" name="inputalamat" placeholder="Alamat Hotel" value="<?php echo $rowedit["hotelalamat"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kethotel" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kethotel" name="inputket" placeholder="Keterangan" value="<?php echo $rowedit["hotelketerangan"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Photo Hotel</label>
                            <div class="col-sm-10">
                                <input type="file" id="file" name="file">
                                <?php if (is_file("images-hotel/" . $rowedit['hotelfoto'])) { ?>
                                    <img src="images-hotel/<?php echo $rowedit['hotelfoto'] ?>" style="width:200px; height:100px;">
                                    <p class="help-block">Field ini digunakan untuk unggah file</p>
                                <?php } else
                                    echo "<img src='img/noimage.png' height='100px';>"
                                ?>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kodearea" class="col-sm-2 col-form-label">Kode Area</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="inputkodearea" id="kodearea">
                                    <option value="<?php echo $rowedit["areaID"] ?>">
                                        <?php echo $rowedit["kabupatenNAMA"] ?>
                                        <?php echo $rowedit["areaID"] ?>
                                        <?php echo $rowedit["areanama"] ?>
                                    </option>
                                    <?php while ($row = mysqli_fetch_array($dataarea)) { ?>
                                        <option value="<?php echo $row["areaID"] ?>">
                                            <?php echo $row["kabupatenNAMA"] ?>
                                            <?php echo $row["areaID"] ?>
                                            <?php echo $row["areanama"] ?>
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
                            <h1 class="display-4">Daftar Hotel</h1>
                        </div>
                    </div>

                    <!-- Search Bar -->
                    <form method="POST">
                        <div class="form-group row mb-4">
                            <label for="search" class="col-sm-3">Nama Destinasi</label>
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
                                <th>Alamat</th>
                                <th>Keterangan</th>
                                <th>Photo Hotel</th>
                                <th>Kode Area</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (isset($_POST["kirim"])) {
                                $search = $_POST['search'];
                                $query = mysqli_query($connection, "SELECT *
                                                            from hotel
                                                            where hotelnama like '%" . $search . "%' ");
                            } else {
                                $query = mysqli_query($connection, "SELECT * from hotel");
                            }
                            $nomor = 1;
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $row['hotelID']; ?></td>
                                    <td><?php echo $row['hotelnama']; ?></td>
                                    <td><?php echo $row['hotelalamat']; ?></td>
                                    <td><?php echo $row['hotelketerangan']; ?></td>
                                    <td>
                                        <?php if (is_file("images-hotel/" . $row['hotelfoto'])) { ?>
                                            <img src="images-hotel/<?php echo $row['hotelfoto'] ?>" width="80">
                                        <?php } else
                                            echo "<img src='img/noimage.png' width='80'>"
                                        ?>
                                    </td>
                                    <td><?php echo $row['areaID']; ?></td>
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