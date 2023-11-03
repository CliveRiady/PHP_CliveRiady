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
    header("location:area.php");
}
if (isset($_POST['Edit'])) {
    $areaID = $_REQUEST['inputkode'];
    $namaarea = $_POST['inputnama'];
    $wilayah = $_POST['inputwilayah'];
    $keterangan = $_POST['inputket'];
    $kodekabupaten = $_POST['inputkodekabupaten'];

    mysqli_query($connection, "update area set areanama='$namaarea', areawilayah='$wilayah', areaketerangan='$keterangan', kabupatenKODE='$kodekabupaten'
    where areaID = '$areaID'");
    header("location:area.php");
}

$areaID = $_GET["editarea"];
$editarea = mysqli_query($connection, "select * from area where areaID ='$areaID'");
$rowedit = mysqli_fetch_array($editarea);

$datakabupaten = mysqli_query($connection, "select * from kabupaten");
$rowedit2 = mysqli_fetch_array($datakabupaten);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title>Daftar Area</title>
</head>

<body>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">Input Area</h1>
                        </div>
                    </div>

                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="kodearea" class="col-sm-2 col-form-label">Kode</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kodearea" name="inputkode" placeholder="Kode Area" maxlength="4" value="<?php echo $rowedit["areaID"] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="namaarea" class="col-sm-2 col-form-label">Nama Area</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="namaarea" name="inputnama" placeholder="Nama Area" value="<?php echo $rowedit["areanama"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="wilayah" class="col-sm-2 col-form-label">Wilayah</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="wilayah" name="inputwilayah" placeholder="Wilayah Area" value="<?php echo $rowedit["areawilayah"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="keterangan" name="inputket" placeholder="Keterangan" value="<?php echo $rowedit["areaketerangan"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kodekabupaten" class="col-sm-2 col-form-label">Kode Kabupaten</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="inputkodekabupaten" id="kodekabupaten">
                                    <option value="<?php echo $rowedit["kabupatenKODE"] ?>">
                                        <?php echo $rowedit["kabupatenKODE"] ?>
                                        <?php echo $rowedit2["kabupatenNAMA"] ?>
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
                            <h1 class="display-4">Daftar Area</h1>
                        </div>
                    </div>

                    <!-- Search Bar -->
                    <form method="POST">
                        <div class="form-group row mb-4">
                            <label for="search" class="col-sm-3">Nama Destinasi</label>
                            <div class="col-sm-6">
                                <input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST['search'])) {
                                                                                                                echo $_POST['search'];
                                                                                                            } ?>" placeholder="Cari Nama Area">
                            </div>
                            <input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
                        </div>
                    </form>
                    <!-- Penutup Search Bar -->

                    <table class="table table-hover table-info">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Area ID</th>
                                <th>Nama Area</th>
                                <th>Wilayah</th>
                                <th>Keterangan</th>
                                <th>Kabupaten ID</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (isset($_POST["kirim"])) {
                                $search = $_POST['search'];
                                $query = mysqli_query($connection, "SELECT *
                                                            from area
                                                            where areanama like '%" . $search . "%' ");
                            } else {
                                $query = mysqli_query($connection, "SELECT * from area");
                            }
                            $nomor = 1;
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $row['areaID']; ?></td>
                                    <td><?php echo $row['areanama']; ?></td>
                                    <td><?php echo $row['areawilayah']; ?></td>
                                    <td><?php echo $row['areaketerangan']; ?></td>
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