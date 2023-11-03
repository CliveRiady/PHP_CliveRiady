<!doctype html>
<html lang="en">
<?php
include "includes/config.php";
include "header.php";

// kode kabupaten
$kodekabupaten = $_GET["get"];

$kotaquery = mysqli_query($connection, "SELECT kabupatenNAMA FROM kabupaten
             where kabupatenKODE = '$kodekabupaten'");
$row1 = mysqli_fetch_array($kotaquery);
$kota = $row1['kabupatenNAMA'];

$kabupaten = mysqli_query($connection, "SELECT * FROM kabupaten
             where kabupatenKODE = '$kodekabupaten'");
$kabupatenlain = mysqli_query($connection, "SELECT * FROM kabupaten
             where kabupatenKODE != '$kodekabupaten'
             order by kabupatenKODE asc");
$destinasi = mysqli_query($connection, "SELECT * from destinasi
            join area on destinasi.areaID = area.areaID
            join kategori on destinasi.kategoriID = kategori.kategoriID
            join detildestinasi on destinasi.destinasiID = detildestinasi.destinasiID
            join fotodestinasi on destinasi.destinasiID = fotodestinasi.destinasiID
            where kabupatenKODE = '$kodekabupaten'
            order by destinasi.destinasiID desc");
$berita = mysqli_query($connection, "SELECT * from destinasi
            join area on destinasi.areaID = area.areaID
            join kategori on destinasi.kategoriID = kategori.kategoriID
            join detildestinasi on destinasi.destinasiID = detildestinasi.destinasiID
            join berita on berita.destinasiID = destinasi.destinasiID
            join fotodestinasi on destinasi.destinasiID = fotodestinasi.destinasiID
            where kabupatenKODE = '$kodekabupaten'");
?>

<style>
    .card-body h5,
    p {
        font-size: smaller;
    }
</style>

<body>
    <!-- Image -->
    <?php if (mysqli_num_rows($kabupaten) > 0) {
        while ($row = mysqli_fetch_array($kabupaten)) { ?>
            <div class="carousel-inner w-100" style="height: 480px;">
                <img src="images-kabupaten/<?php echo $row["kabupatenFOTOICON"] ?>" class="d-block w-100" alt="Jakarta">
            </div>

            <div class="space"></div>
            <!-- Akhir Image -->
            <main class="container">
                <div class="pt-5 pb-2 px-0 rounded text-dark">
                    <div class="row mb-2">
                        <div class="col-md-9 pe-4">
                            <p class="mb-2 text-black-50" style="letter-spacing: 0.025em; font-size: smaller;">
                                <a href="index.php"><?php echo 'Home' ?></a>
                                >
                                <a href="destination.php"><?php echo 'Destination' ?></a>
                                >
                                <a style="color: var(--accent)" href="<?php echo $row["kabupatenNAMA"] ?>.php"><?php echo $row["kabupatenNAMA"] ?></a>
                            </p>
                            <h1 class="display-4 fst-italic fw-bold"><?php echo $row["kabupatenNAMA"] ?></h1>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <!-- left -->
                        <div class="col-md-8 pe-4">
                            <p class="lead my-3"><?php echo $row["kabupatenKET"] ?></p>
                            <div class="space"></div>
                            <h5 class="fw-bold">Explore Destinations in <?php echo $row["kabupatenNAMA"] ?></h5>
                            <div class="space"></div>
                            <!-- start -->
                            <div class="row mb-2">
                                <?php if (mysqli_num_rows($destinasi) > 0) {
                                    while ($row = mysqli_fetch_array($destinasi)) { ?>
                                        <div class="col-md-12 shadow px-0">
                                            <div class=" row g-0 rounded overflow-hidden flex-md-row mb-4 h-md-250 position-relative">
                                                <img style="object-fit:cover;" height="300" src="images-destinasi/<?php echo $row["fotofile"] ?>">
                                            </div>
                                            <div class="col px-4 pb-4  d-flex flex-column position-static">
                                                <strong class="d-inline-block mb-2" style="color: var(--accent);"><?php echo $row["areanama"] ?>, <?php echo $row["areawilayah"] ?></strong>
                                                <h3 class="mb-1"><?php echo $row["destinasinama"] ?></h3>
                                                <div class="mb-2 text-muted"><?php echo $row["kategorinama"] ?></div>
                                                <p class="card-text mb-auto"><?php echo $row["detildestinasidesc"] ?>...</p>
                                                <div class="space"></div>
                                                <a href="destinasi1.php?get=<?php echo $row["destinasiID"] ?>" class="my-a">View more details</a>
                                            </div>
                                        </div>
                                        <div class="space"></div>
                                <?php }
                                } ?>
                            </div>
                            <!-- start -->
                        </div>
                <?php }
        } ?>
                <!-- Right -->
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <h5 class="fw-bold">Other Destinations</h5>
                    <hr>
                    <?php if (mysqli_num_rows($kabupatenlain) > 0) {
                        while ($row = mysqli_fetch_array($kabupatenlain)) { ?>
                            <div class="card mb-3 border-0 shadow-sm" style="max-width: 300px;">
                                <div class="row g-0">
                                    <div class="col-md-5">
                                        <a href="kabupaten1.php?get=<?php echo $row["kabupatenKODE"] ?>" class=" stretched-link m-0"><img src="images-kabupaten/<?php echo $row["kabupatenFOTOICON"] ?>" style="height: 7.5vw; object-fit: cover" class="img-fluid rounded-start" alt="..."></a>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <p class="card-text mb-1" style="color: var(--accent);"><small>Destination</small></p>
                                            <h5 class="card-title mb-1"><?php echo $row["kabupatenNAMA"] ?></h5>
                                            <?php
                                            $var = $row["kabupatenKODE"];
                                            $result = mysqli_query($connection, "SELECT count(*) as total FROM kabupaten 
                                            join area on kabupaten.kabupatenKODE = area.kabupatenKODE
                                            join destinasi on destinasi.areaID = area.areaID
                                            where area.kabupatenKODE = '$var'
                                            ");
                                            $count = mysqli_fetch_assoc($result)
                                            ?>
                                            <p class="card-text"><small class="text-muted"><?php echo $count['total'] ?> destinations to visit</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
                    </div>
                </div>

                <!-- Berita -->
                <div class="row mb-2">
                    <div class="col-md-8">
                        <div class="space"></div>
                        <h5 class="fw-bold" data-testid="page-heading">Explore our latest stories related to <?php echo $kota ?></h5>
                        <hr>
                    </div>
                    <?php if (mysqli_num_rows($berita) > 0) {
                        while ($row = mysqli_fetch_array($berita)) { ?>
                            <div class="col-md-8">
                                <div class=" row g-0 rounded overflow-hidden flex-md-row mb-4 h-md-250 h-100 position-relative">
                                    <!--tambah border kl mau -->
                                    <div class="col-auto d-lg-block">
                                        <img style="object-fit:cover; padding-top: 0.5rem;" width="200" height="100%" src="images-berita/<?php echo $row["beritaID"] ?>.jpg">
                                    </div>
                                    <div class="col p-4 d-flex flex-column position-static">
                                        <strong class="d-inline-block mb-2 text-primary"><?php echo $row["penerbit"] ?>, <?php echo $row["penulis"] ?></strong>
                                        <h3 class="mb-1"><?php echo $row["beritajudul"] ?></h3>
                                        <div class="mb-2 text-muted"><?php echo $row["kategorinama"] ?></div>
                                        <p class="card-text mb-auto"><?php echo $row["beritainti"] ?></p>
                                        <a href="berita1.php?get=<?php echo $row["beritaID"] ?>" class=" my-a">View more details</a>
                                    </div>
                                    <div class="space"></div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
                <!-- Akhir Destination -->
            </main>
            <?php include "footer.php" ?>
</body>

</html>