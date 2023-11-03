<!doctype html>
<html lang="en">
<?php
include "includes/config.php";
include "header.php";

$kabupaten1 = mysqli_query($connection, "SELECT * FROM kabupaten
            order by kabupatenKODE asc ");
?>

<body>
    <!-- Image -->
    <div class="carousel-inner w-100" style="height: 480px;">
        <img style="filter: brightness(75%);" src="img/destination1.jpg" class="d-block w-100" alt="news">
    </div>
    <div class="space"></div>
    <!-- Akhir Image -->

    <!-- destination -->
    <main class="container">
        <!-- breadcrumbs -->
        <p class="mb-2 text-black-50" style="letter-spacing: 0.025em; font-size: smaller;">
            <a href="index.php"><?php echo 'Home' ?></a>
            >
            <a style="color: var(--accent)" href="destination.php"><?php echo 'Destination' ?></a>
        </p>
        <div class="pt-5 pb-2 px-0 rounded text-dark">
            <div class="row mb-2 px-3">
                <div class="col-md-2 px-0"></div>
                <div class="col-md-8 px-0 text-center">
                    <h1 class="display-4 fst-italic fw-bold">Destinations</h1>
                    <p class="lead my-3">Find everything you need to know about how to get here, what regulations that should be noted, and many other things vital in arranging your travel plan to Indonesia.</p>
                </div>
                <div class="col-md-2 px-0"></div>
            </div>
        </div>
        <div class="row justify-content-center mb-2 px-4 py-3">
            <iframe width="960" height="540" src="https://www.youtube.com/embed/BFS9n4B_2xA" title="Bali in 8k ULTRA HD HDR -  Paradise of Asia (60 FPS)" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="space2"></div>
        <div class="d-flex justify-content-between align-items-end my-4">
            <div>
                <p class="mb-2 text-black-400" style="letter-spacing: 0.025em; font-weight: 700; font-size: smaller; color: gray;">PLAN YOUR TRIP</p>
                <h2 class="text-2xl md:text-4xl font-bold text-black md:max-w-lg" data-testid="page-heading">Where to next?</h2>
            </div>
        </div>
        <div class="row row-cols-md-4 g-4 mb-4">
            <?php if (mysqli_num_rows($kabupaten1) > 0) {
                while ($row = mysqli_fetch_array($kabupaten1)) { ?>
                    <div class="col">
                        <div class=" shadow border-0 card h-100">
                            <img height="200" style="object-fit:cover;" src="images-kabupaten/<?php echo $row["kabupatenFOTOICON"] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row["kabupatenNAMA"] ?></h5>
                                <a href="kabupaten1.php?get=<?php echo $row["kabupatenKODE"] ?>">
                                    <p class="text-muted" style="font-size: 10.5px;"><?php echo $row["kabupatenALAMAT"] ?></p>
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
                                    <p class="card-text my-a stretched-link"><?php echo "View more" ?></p>
                                </a>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
        </div>
    </main>
    <!-- akhir destination -->

    </main>

    <?php include "footer.php" ?>

</body>

</html>