<!doctype html>
<html lang="en">
<?php
include "includes/config.php";
include "header.php";

$berita1 = mysqli_query($connection, "SELECT * FROM berita, destinasi, fotodestinasi 
            where destinasi.destinasiID=berita.destinasiID and berita.destinasiID = fotodestinasi.destinasiID
            order by tanggalterbit desc");
?>

<body>
    <!-- Image -->
    <div class="carousel-inner w-100" style="height: 480px;">
        <img style="filter: brightness(40%);" src="img/news.jpg" class="d-block w-100" alt="news">
    </div>
    <div class="space"></div>
    <!-- Akhir Image -->

    <!-- News -->
    <main class="container">
        <!-- breadcrumbs -->
        <p class="mb-2 text-black-50" style="letter-spacing: 0.025em; font-size: smaller;">
            <a href="index.php"><?php echo 'Home' ?></a>
            >
            <a style="color: var(--accent)" href="news.php"><?php echo 'News' ?></a>
        </p>
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

        <div class="row mb-2">
            <?php if (mysqli_num_rows($berita1) > 0) {
                while ($row = mysqli_fetch_array($berita1)) { ?>
                    <div class="col-md-6 py-4">
                        <div class=" row g-0 rounded overflow-hidden flex-md-row mb-4 shadow h-md-250 h-100 position-relative">
                            <!--tambah border kl mau -->
                            <div class="col p-4 d-flex flex-column position-static">
                                <strong class="d-inline-block mb-2 text-uppercase" style="color:var(--accent); font-size: 12px;"><?php echo $row["destinasinama"] ?></strong>
                                <h3 class="mb-1"><?php echo $row["beritajudul"] ?></h3>
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
    </main>

    <?php include "footer.php" ?>

</body>

</html>