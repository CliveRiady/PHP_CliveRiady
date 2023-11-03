<!DOCTYPE html>
<html lang="en">

<?php
ob_start();
session_start();
if (!isset($_SESSION['emailuser']))
    header("location:login.php");

include "header.php";
include "includes/config.php";

if (isset($_POST['Simpan'])) {
    if (isset($_REQUEST['inputkode'])) {
        $kodeberita = $_REQUEST['inputkode'];
    }
    if (!empty($kodeberita)) {
        $kodeberita = $_REQUEST['inputkode'];
    } else {
        die("Anda harus memasukkan kodenya");
    }

    $judulberita = $_POST['inputjudul'];
    $intiberita = $_POST['inputinti'];
    $penulis = $_POST['inputpenulis'];
    $penerbit = $_POST['inputpenerbit'];
    $tanggal = $_POST['inputtanggal'];
    $kodedestinasi = $_POST['inputkodedestinasi'];

    mysqli_query($connection, "insert into berita values ('$kodeberita', '$judulberita', '$intiberita', '$penulis','$penerbit','$tanggal','$kodedestinasi')");
    header("location:berita.php");
}
$datadestinasi = mysqli_query($connection, "select * from destinasi");
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
                                <input type="text" class="form-control" id="kodeberita" name="inputkode" placeholder="Kode berita" maxlength="4">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="judulberita" class="col-sm-2 col-form-label">Judul Berita</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="judulberita" name="inputjudul" placeholder="Judul Berita">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="intiberita" class="col-sm-2 col-form-label">Inti Berita</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="intiberita" name="inputinti" placeholder="Inti Berita">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="penerbit" class="col-sm-2 col-form-label">Penulis</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="penerbit" name="inputpenerbit" placeholder="Penerbit">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="penulis" class="col-sm-2 col-form-label">Penerbit</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="penulis" name="inputpenulis" placeholder="Penulis">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Terbit</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggal" name="inputtanggal" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kodedestinasi" class="col-sm-2 col-form-label">Kode Destinasi</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="inputkodedestinasi" id="kodedestinasi">
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
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <input type="submit" name="Simpan" class="btn btn-primary" value="Simpan">
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
                                <th colspan="2" style="text-align: center">Action</th>
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
                                    <td>
                                        <a href="beritaedit.php?edit=<?php echo $row['beritaID'] ?>" class="btn btn-success btn-sm" title="EDIT">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </a>
                                        <a href="beritahapus.php?hapus=<?php echo $row['beritaID'] ?>" class="btn btn-danger btn-sm" title="DELETE">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                            </svg>
                                        </a>
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

<?php
include "footer.php";
mysqli_close($connection);
ob_end_flush();
?>

</html>