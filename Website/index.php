<!doctype html>
<html lang="en">

<?php
include "includes/config.php";

$berita1 = mysqli_query($connection, "SELECT * FROM berita, destinasi, fotodestinasi 
            where destinasi.destinasiID=berita.destinasiID and berita.destinasiID = fotodestinasi.destinasiID
            order by tanggalterbit desc limit 4");
$kabupaten1 = mysqli_query($connection, "SELECT * FROM kabupaten
            order by kabupatenKODE asc limit 6 ");
$hotel1 = mysqli_query($connection, "SELECT * FROM hotel, kabupaten, area
            where kabupaten.kabupatenKODE = area.kabupatenKODE and area.areaID = hotel.areaID
            order by hotelID desc limit 4 ");
$makanan1 = mysqli_query($connection, "SELECT * FROM makanan, kabupaten
            where makanan.kabupatenKODE = kabupaten.kabupatenKODE
            order by makananID desc limit 5 ");

?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Playfair Display' rel='stylesheet'>
    <title>Wisata</title>
    <link rel="shortcut icon" href="img/logo.png">
</head>

<body>
    <?php include "header.php" ?>

    <!-- Slider Carousel -->
    <div id="carouselExampleCaptions" class="carousel slide  w-100" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item w-100 active">
                <img src="https://images.unsplash.com/photo-1591613757258-ece6bbf1b8b6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1746&q=80" class="d-block w-100" alt="Bali">
                <div class="carousel-text">
                    <h1 class="display-3">Bali</h1>
                    <p class="lead my-3">One of the most famous island in the Indonesian archipelago. The island's home to an ancient culture that's known for its warm hospitality.</p>
                    <a href="kabupaten1.php?get=K002" class="btn my-btn">
                        Explore Now
                    </a>
                </div>
            </div>
            <div class="carousel-item w-100">
                <img src="img/carousel-jakarta2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-text">
                    <h1 class="display-3">Jakarta</h1>
                    <p class="lead my-3">One of the most famous island in the Indonesian archipelago. The island's home to an ancient culture that's known for its warm hospitality.</p>
                    <a href="kabupaten1.php?get=K001" class="btn my-btn">
                        Explore Now
                    </a>
                </div>
            </div>
            <div class="carousel-item w-100">
                <img src="https://images.unsplash.com/photo-1589754457851-afdc14114119?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1742&q=80" class="d-block w-100" alt="...">
                <div class="carousel-text">
                    <h1 class="display-3">Semarang</h1>
                    <p class="lead my-3">One of the most famous island in the Indonesian archipelago. The island's home to an ancient culture that's known for its warm hospitality.</p>
                    <a href="#" class="btn my-btn">
                        Explore Now
                    </a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="space"></div>
    <!-- Akhir Carousel -->

    <!-- destination -->
    <main class="container">
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
        <div class="d-flex justify-content-between align-items-end my-4">
            <div>
                <p class="mb-2 text-black-400" style="letter-spacing: 0.025em; font-weight: 700; font-size: smaller; color: gray;">PLAN YOUR TRIP</p>
                <h2 class="font-bold text-black" data-testid="page-heading">Where to next?</h2>
            </div>
            <div class="space"></div>
            <div>
                <a href="destination.php" class="btn my-btn" aria-hidden="true" data-testid="a">View all destinations</a>
            </div>
        </div>
        <div class="space2"></div>
        <div class="row g-4 mb-4">
            <?php if (mysqli_num_rows($kabupaten1) > 0) {
                while ($row = mysqli_fetch_array($kabupaten1)) { ?>
                    <div class="col">
                        <div class=" shadow border-0 card h-100">
                            <img height="200" style="object-fit:cover;" src="images-kabupaten/<?php echo $row["kabupatenFOTOICON"] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row["kabupatenNAMA"] ?></h5>
                                <a href="kabupaten1.php?get=<?php echo $row["kabupatenKODE"] ?>">
                                    <p class="text-muted" style="font-size: 10.5px;"><?php echo $row["kabupatenALAMAT"] ?></p>
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
    <div class="space"></div>
    <!-- Hotel -->
    <main class="container">
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
        <div class="d-flex justify-content-between align-items-end my-4">
            <div>
                <p class="mb-2 text-black-400" style="letter-spacing: 0.025em; font-weight: 700; font-size: smaller; color: gray;">HOTELS AND RESORTS</p>
                <h2 class="font-bold text-black" data-testid="page-heading">Relax and have a great stay</h2>
            </div>
            <div>
                <a href="hotel.php" class="btn my-btn" aria-hidden="true" data-testid="a">View all hotels</a>
            </div>
        </div>
        <div class="row g-4 mb-4">
            <?php if (mysqli_num_rows($hotel1) > 0) {
                while ($row = mysqli_fetch_array($hotel1)) { ?>
                    <div class="col">
                        <div class="border-0 card h-100">
                            <img height="200" style="object-fit:cover;" src="images-hotel/<?php echo $row["hotelfoto"] ?>" class="rounded card-img-top" alt="...">
                            <div class="px-0 pe-4 card-body">
                                <h5 style="font-size:1.2rem" class="card-title"><?php echo $row["hotelnama"] ?></h5>
                                <a href="hotel1.php?get=<?php echo $row["hotelID"] ?>">
                                    <p class="text-muted" style="font-size: .8rem;"><?php echo $row["hotelalamat"] ?></p>
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

    <!-- News -->
    <main class="container">
        <div class="pt-5 pb-2 px-0 rounded text-dark">
            <div class="row mb-2 px-3">
                <div class="col-md-2 px-0"></div>
                <div class="col-md-8 px-0 text-center">
                    <h1 class="display-4 fst-italic fw-bold">News</h1>
                    <p class="lead my-3">Find everything you need to know about how to get here, what regulations that should be noted, and many other things vital in arranging your travel plan to Indonesia.</p>
                </div>
                <div class="col-md-2 px-0"></div>
            </div>
        </div>
        <div class="row mb-2 px-3">
        </div>
        <div class="d-flex justify-content-between align-items-end my-4">
            <div>
                <p class="mb-2 text-black-400" style="letter-spacing: 0.025em; font-weight: 700; font-size: smaller; color: gray;">TRAVEL NEWS AND STORIES</p>
                <h2 class="font-bold text-black" data-testid="page-heading">Explore our latest stories</h2>
            </div>
            <div>
                <a href="news.php" class="btn my-btn" aria-hidden="true" data-testid="a">View all news</a>
            </div>
        </div>

        <div class="row mb-2">
            <?php if (mysqli_num_rows($berita1) > 0) {
                while ($row = mysqli_fetch_array($berita1)) { ?>
                    <div class="col-md-6 py-4">
                        <div class=" row g-0 rounded overflow-hidden flex-md-row mb-4 shadow h-md-250 h-100 position-relative">
                            <!--tambah border kl mau -->
                            <div class="col p-4 d-flex flex-column position-static">
                                <strong class="d-inline-block mb-2 text-uppercase" style="color:var(--accent); font-size: 12px;"><?php echo $row["destinasinama"] ?></strong>
                                <h3 class="mb-1" style="font-size:1.4rem;"><?php echo $row["beritajudul"] ?></h3>
                                <div class="mb-2 text-muted"><?php echo $row["tanggalterbit"] ?></div>
                                <p class="card-text mb-auto"><?php echo $row["beritainti"] ?></p>
                                <a href="berita1.php?get=<?php echo $row["beritaID"] ?>" class="stretched-link my-a">Continue reading</a>
                            </div>
                            <div class="col-auto d-lg-block">
                                <img style="object-fit:cover;" width="200" height="100%" src="images-destinasi/<?php echo $row["fotofile"] ?>">
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
        <!-- Akhir News -->

        <!-- Culiner -->
        <main class="container">
            <div class="pt-5 pb-2 px-0 rounded text-dark">
                <div class="row mb-2 px-3">
                    <div class="col-md-2 px-0"></div>
                    <div class="col-md-8 px-0 text-center">
                        <h1 class="display-4 fst-italic fw-bold">Cuisines</h1>
                        <p class="lead my-3">Find hotels, resorts, guesthouses, or even homestays that suites you best for your travel plan to Indonesia.</p>
                    </div>
                    <div class="col-md-2 px-0"></div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-end my-4">
                <div>
                    <p class="mb-2 text-black-400" style="letter-spacing: 0.025em; font-weight: 700; font-size: smaller; color: gray;">INDONESIAN LOCAL FOOD</p>
                    <h2 class="font-bold text-black" data-testid="page-heading">Indonesian cuisines you must try</h2>
                </div>
                <div>
                    <a href="makanan.php" class="btn my-btn" aria-hidden="true" data-testid="a">View all cuisines</a>
                </div>
            </div>
            <div class="row row-cols-md-5 g-4 mb-4">
                <?php if (mysqli_num_rows($makanan1) > 0) {
                    while ($row = mysqli_fetch_array($makanan1)) { ?>
                        <div class="col">
                            <div class=" shadow border-0 card h-100">
                                <img height="200" style="object-fit:cover;" src="images-makanan/<?php echo $row["makananfoto"] ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row["makanannama"] ?></h5>
                                    <a href="makanan1.php?get=<?php echo $row["kabupatenKODE"] ?>">
                                        <p class="text-muted" style="font-size: 10.5px;"><?php echo $row["kabupatenNAMA"] ?></p>
                                    </a>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </main>
        <!-- akhir Culiner -->

    </main>
    <div class="space"></div>
    <!-- Footer -->
    <?php include "footer.php" ?>

</body>

</html>