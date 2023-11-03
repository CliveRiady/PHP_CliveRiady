<!doctype html>
<html lang="en">

<?php
include "includes/config.php";

$kabupaten = mysqli_query($connection, "SELECT * FROM kabupaten");
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
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
                <div class="logo-text d-inline-block align-text-top" style="font-family:Playfair Display, Georgia, Times New Roman , serif;font-weight: 900">Travel ID</div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="mx-auto"></div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="stretched-link" href="destination.php"></a>
                        <a class="nav-link dropdown-toggle" href="destination.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Destination</a>
                        <ul class="dropdown-menu" aria-labelledby=" navbarDropdown">
                            <?php if (mysqli_num_rows($kabupaten) > 0) {
                                while ($row = mysqli_fetch_array($kabupaten)) { ?>
                                    <a class="dropdown-item hover:bg-blue-100" href="kabupaten1.php?get=<?php echo $row["kabupatenKODE"] ?>"><?php echo $row["kabupatenNAMA"] ?></a>
                            <?php }
                            } ?>
                        </ul>
                    </li>
                    <li class="nav-item text-white">
                        <a class="nav-link" href="hotel.php">Hotel</a>
                    </li>
                    <li class="nav-item text-white">
                        <a class="nav-link" href="news.php">News</a>
                    </li>
                    <li class="nav-item text-white">
                        <a class="nav-link" href="makanan.php">Culinary</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
        const navEL = document.querySelector('.navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY >= 150) {
                navEL.classList.add('navbar-scrolled');
            } else if (window.scrollY < 150) {
                navEL.classList.remove('navbar-scrolled');
            }
        })
    </script>
</body>

</html>