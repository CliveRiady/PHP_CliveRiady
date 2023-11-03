<!doctype html>
<html lang="en">
<?php
include "includes/config.php";
include "header.php";

// kode kabupaten
$kodehotel = $_GET["get"];

$destinasi = mysqli_query($connection, "SELECT * from destinasi
            join area on destinasi.areaID = area.areaID
            join kabupaten on area.kabupatenKODE = kabupaten.kabupatenKODE
            join kategori on destinasi.kategoriID = kategori.kategoriID
            join detildestinasi on destinasi.destinasiID = detildestinasi.destinasiID
            join berita on berita.destinasiID = destinasi.destinasiID
            join fotodestinasi on destinasi.destinasiID = fotodestinasi.destinasiID
            join hotel on hotel.areaID = area.areaID
            where hotelID = '$kodehotel'
            order by destinasi.destinasiID desc");

$hotel = mysqli_query($connection, "SELECT * from hotel
            join area on hotel.areaID = area.areaID
            join kabupaten on area.kabupatenKODE = kabupaten.kabupatenKODE
            join detilhotel on hotel.hotelID = detilhotel.hotelID
            where hotel.hotelID = '$kodehotel'");
$hotellain = mysqli_query($connection, "SELECT * from hotel
            join area on hotel.areaID = area.areaID
            join kabupaten on area.kabupatenKODE = kabupaten.kabupatenKODE
            join detilhotel on hotel.hotelID = detilhotel.hotelID
            where hotel.hotelID != '$kodehotel'");
?>

<style>
    .card-body h5,
    p {
        font-size: smaller;
    }
</style>

<body>
    <!-- Image -->
    <?php if (mysqli_num_rows($hotel) > 0) {
        while ($row = mysqli_fetch_array($hotel)) { ?>
            <div class="carousel-inner w-100" style="height: 480px;">
                <img src="images-hotel/<?php echo $row["hotelfoto"] ?>" class="d-block w-100" alt="">
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
                                <a href="hotel.php"><?php echo 'Hotel' ?></a>
                                >
                                <a style="color: var(--accent)" href="#"><?php echo $row["hotelnama"] ?></a>
                            </p>
                            <h1 class="display-4 fst-italic fw-bold"><?php echo $row["hotelnama"] ?></h1>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <!-- left -->
                        <div class="col-md-8 pe-4">
                            <p class="lead my-3">Published at <?php echo $row["hotelharga"] ?></p>
                            <p style="font-size:1rem;">Location: <?php echo $row['hotelalamat'] ?></p>
                            <p style="font-size:1rem;">Breakfast: <?php echo $row['hotelsarapan'] ?></p>
                            <div class="space"></div>

                            <!-- Berita -->
                            <?php if (mysqli_num_rows($hotellain) > 0) { ?>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div class="space"></div>
                                        <h5 class="fw-bold" data-testid="page-heading">Stays suggested for you</h5>
                                        <hr>
                                    </div>
                                    <?php while ($row = mysqli_fetch_array($hotellain)) { ?>
                                        <div class="col-md-12">
                                            <div class=" row g-0 rounded overflow-hidden flex-md-row mb-4 h-md-250 h-100 position-relative">
                                                <!--tambah border kl mau -->
                                                <div class="col-auto d-lg-block">
                                                    <img style="object-fit:cover; padding-top: 0.5rem;" width="200" height="100%" src="images-hotel/<?php echo $row["hotelfoto"] ?>">
                                                </div>
                                                <div class="col p-4 d-flex flex-column position-static">
                                                    <strong class="d-inline-block mb-2 text-primary">Starts from Rp <?php echo $row["hotelharga"] ?></strong>
                                                    <h3 class="mb-1"><?php echo $row["hotelnama"] ?></h3>
                                                    <div class="mb-2 text-muted"><?php echo $row["hotelalamat"] ?></div>
                                                    <p class="card-text mb-auto"><?php echo $row["hotelketerangan"] ?></p>
                                                    <a href="hotel1.php?get=<?php echo $row["hotelID"] ?>" class="my-a">View more details</a>
                                                </div>
                                                <div class="space"></div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                                </div>
                        </div>
                <?php }
        } ?>
                <!-- Right -->
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <h5 class="fw-bold">Destinations</h5>
                    <hr>
                    <?php if (mysqli_num_rows($destinasi) > 0) {
                        while ($row = mysqli_fetch_array($destinasi)) { ?>
                            <div class="card mb-3 border-0 shadow-sm" style="max-width: 300px;">
                                <div class="row g-0">
                                    <div class="col-md-5">
                                        <a href="destinasi1.php?get=<?php echo $row["destinasiID"] ?>" class="stretched-link m-0">
                                            <img style=" height: 7.5vw; object-fit: cover;" class="img-fluid rounded-start" alt="..." src="images-destinasi/<?php echo $row["fotofile"] ?>">
                                        </a>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <p class="card-text mb-1" style="color: var(--accent);"><small>Destination</small></p>
                                            <h5 class="card-title mb-1"><?php echo $row["destinasinama"] ?></h5>
                                            <p class="card-text"><small class="text-muted">destinations to visit</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
                    </div>
                </div>


                <!-- Akhir Destination -->
            </main>
            <?php include "footer.php" ?>
</body>

</html>