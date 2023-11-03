<!doctype html>
<html lang="en">
<?php
include "includes/config.php";
include "header.php";

$makanan1 = mysqli_query($connection, "SELECT * FROM makanan, kabupaten
            where makanan.kabupatenKODE = kabupaten.kabupatenKODE
            order by makananID desc");
?>

<body>
    <!-- Image -->
    <div class="carousel-inner w-100" style="height: 480px;">
        <img style="filter: brightness(70%);" src="img/makanan1.jpg" class="d-block w-100" alt="news">
    </div>
    <div class="space"></div>
    <!-- Akhir Image -->

    <!-- Culiner -->
    <main class="container">
        <!-- breadcrumbs -->
        <p class="mb-2 text-black-50" style="letter-spacing: 0.025em; font-size: smaller;">
            <a href="index.php"><?php echo 'Home' ?></a>
            >
            <a style="color: var(--accent)" href="makanan.php"><?php echo 'Cuisines' ?></a>
        </p>
        <div class="pt-5 pb-2 px-0 rounded text-dark">
            <div class="row mb-2 px-3">
                <div class="col-md-2 px-0"></div>
                <div class="col-md-8 px-0 text-center">
                    <h1 class="display-4 fst-italic fw-bold">Cuisines</h1>
                    <p class="lead my-3">Indonesian cuisine often demonstrates complex flavour, acquired from certain ingredients and bumbu spices mixture.</p>
                </div>
                <div class="col-md-2 px-0"></div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-end my-4">
            <div>
                <p class="mb-2 text-black-400" style="letter-spacing: 0.025em; font-weight: 700; font-size: smaller; color: gray;">INDONESIAN LOCAL FOOD</p>
                <h2 class="font-bold text-black" data-testid="page-heading">Indonesian cuisines you must try</h2>
            </div>
        </div>
        <div class="row row-cols-md-3 g-4 mb-4">
            <?php if (mysqli_num_rows($makanan1) > 0) {
                while ($row = mysqli_fetch_array($makanan1)) { ?>
                    <div class="col">
                        <div class=" shadow border-0 card h-100">
                            <img height="200" style="object-fit:cover;" src="images-makanan/<?php echo $row["makananfoto"] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="card-title"><?php echo $row["makanannama"] ?></h5>
                                        <p class="text-muted" style="font-size: .9rem;"><?php echo $row["kabupatenNAMA"] ?></p>
                                    </div>
                                    <div class="col-2"></div>
                                    <div class="col-4" style="text-align:right;">
                                        <p style="font-size:.8rem;">± Rp <?php echo $row["makananharga"] ?></p>
                                    </div>
                                </div>
                                <p style="font-size:.8rem;"><?php echo $row["makanandesc"] ?></p>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </main>
    <!-- akhir Culiner -->
    </main>

    <?php include "footer.php" ?>

</body>

</html>