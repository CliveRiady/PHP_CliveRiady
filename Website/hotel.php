<!doctype html>
<html lang="en">
<?php
include "includes/config.php";
include "header.php";

$hotel1 = mysqli_query($connection, "SELECT * FROM hotel, kabupaten, area, detilhotel
where kabupaten.kabupatenKODE = area.kabupatenKODE and area.areaID = hotel.areaID and hotel.hotelID = detilhotel.hotelID
order by hotel.hotelID desc");
?>

<body>
    <!-- Image -->
    <div class="carousel-inner w-100" style="height: 480px;">
        <img style="filter: brightness(70%);" src="img/hotel.jpg" class="d-block w-100" alt="news">
    </div>
    <div class="space"></div>
    <!-- Akhir Image -->

    <!-- Hotel -->
    <main class="container">
        <!-- breadcrumbs -->
        <p class="mb-2 text-black-50" style="letter-spacing: 0.025em; font-size: smaller;">
            <a href="index.php"><?php echo 'Home' ?></a>
            >
            <a style="color: var(--accent)" href="hotel.php"><?php echo 'Hotel' ?></a>
        </p>
        <div class="pt-5 pb-2 px-0 rounded text-dark">
            <div class="row mb-2 px-3">
                <div class="col-md-2 px-0"></div>
                <div class="col-md-8 px-0 text-center">
                    <h1 class="display-4 fst-italic fw-bold">Stays</h1>
                    <p class="lead my-3">Find hotels, resorts, guesthouses, or even homestays that suites you best for your travel plan to Indonesia.</p>
                </div>
                <div class="col-md-2 px-0"></div>
            </div>
        </div>
        <div class="row g-4 mb-4">
            <?php if (mysqli_num_rows($hotel1) > 0) {
                while ($row = mysqli_fetch_array($hotel1)) { ?>
                    <div class="col">
                        <div class="border-0 card h-100 ">
                            <img height="200" style="object-fit:cover;" src="images-hotel/<?php echo $row["hotelfoto"] ?>" class="rounded card-img-top" alt="...">
                            <div class="px-0 pe-4 card-body">
                                <h5 style="font-size:1.2rem" class="card-title"><?php echo $row["hotelnama"] ?></h5>
                                <a href="hotel1.php?get=<?php echo $row["hotelID"] ?>">
                                    <p class="text-muted" style="font-size: .8rem;"><?php echo $row["hotelalamat"] ?></p>
                                    <strong>
                                        <p class="" style="font-size:.8rem;color:var(--accent);">Rp <?php echo $row["hotelharga"] ?></p>
                                    </strong>
                                    <p class="card-text my-a stretched-link"></p>
                                </a>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
        </div>
    </main>
    <!-- akhir Hotel -->
    </main>

    <?php include "footer.php" ?>

</body>

</html>