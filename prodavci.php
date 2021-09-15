<?php

include 'init.php';

if (!isset($_SESSION['ulogovaniKorisnik']) || empty($_SESSION['ulogovaniKorisnik'])) {
    header('location: login.php');
    exit;
}

$kupac = $_SESSION['ulogovaniKorisnik'];

if ($kupac->uloga == "prodavac") {
    header('location: porudzbine.php');
    exit;
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Combo bags | Home</title>

    <link rel="icon" href="img/core-img/logo.png">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">


</head>

<body>
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type your keyword...">
                            <button type="submit"><img src="img/core-img/search.png" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Wrapper Area End -->

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="index.html"><img src="img/core-img/logo.png" alt=""></a>
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <a href="index.html"><img src="img/core-img/logo.png" alt=""></a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="registracija.php">Sign in</a></li>
                </ul>
            </nav>
            <!-- Button Group -->
            <!-- Social Button -->
            <div class="social-info d-flex justify-content-between">
            <a href="https://www.instagram.com/combo.bags/?igshid=12a5mp93cknnb"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="https://www.facebook.com/combo.bags1"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            </div>
        </header>
        <!-- Header Area End -->

        <section class="section-2" data-aos="fade-left" data-aos-delay="300">
        <div class="container">
            <h3 id="msg" class="text-center"><?php if (isset($_GET['msg'])) { echo $_GET['msg']; } ?></h3>                            
        </div>
        </section>

        <section class="section-2" data-aos="fade-left" data-aos-delay="300">
        <div class="container">
            <h3 class="text-center">Poruči torbu</h3>
            <form method="POST" action="rest/porudzbina">
                <hr>
                <select name="torbu" class="form-control">
                    <?php
                        foreach ($nizTorbi as $torbe) {
                            ?>
                        <option value="<?= $torbe->id ?>"><?= $torbe->naziv . ' ' . $torbe->opis ?></option>

                        <?php
                        }
                    ?>
                </select>
                <hr>
                <input type="text" placeholder="Unesi porudzbinu" class="form-control" name="porudzbina">
                <hr>
                <select name="cenaTorbe" class="form-control"></select>
                <hr>            
                <input type="submit" class="form-control btn-primary" name="unosPorudzbine" value="Unesi porudzbinu">
            </form>
            <hr>
            <h4 id="msgPost" class="text-center"></h4>
        </div>
        </section>
               
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row align-items-center">
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-4">
                    <div class="single_widget_area">
                        <!-- Logo -->
                       
                        <!-- Copywrite Text -->
                        <p class="copywrite"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> & Re-distributed by <a href="https://themewagon.com/" target="_blank">Combo bags</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-8">
                    <div class="single_widget_area">
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <nav class="navbar navbar-expand-lg justify-content-end">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#footerNavContent" aria-controls="footerNavContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>

     <script>
            $(':input[name=unosPorudzbine]').click(function() {
                // process the form
                $("form").submit(function(event) {

                    // get the form data
                    // there are many ways to get this data using jQuery (you can use the class or id also)
                    var idTipPorudzbine = $(':input[name=tipPorudzbina]').val();
                    var formData = {
                        'idKupac'  : $(':input[name=kupac]').val(),
                        'idProdavac': <?php echo json_encode($prodavac->id); ?>,
                        'idTorba'   : $(':input[name=torba]').val(),
                        'porudzbina'    : $(':input[name=porudzbina]').val(),
                        'cena'       : cenovnik[idTipPorudzbine]
                    };
                    
                    $.ajax({
                        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                        url         : 'rest/porudzbine', // the url where we want to POST
                        data        : JSON.stringify(formData), // our data object
                        dataType    : 'json', // what type of data do we expect back from the server
                        encode      : true,
                        contentType: "application/json; charset=UTF-8"
                    }).done(function(data) {
                        $('#msgPost').html(data.poruka); 
                    });
                    
                    // stop the form from submitting the normal way and refreshing the page
                    event.preventDefault();
                });
            });

            // Get tip reg porudzbine
            let dropdown = $(':input[name=cenaTorbe]');
            dropdown.empty();

            dropdown.append('<option selected="true" disabled>Izaberi materijal i cenu</option>');
            dropdown.prop('selectedIndex', 0);

            const url = 'https://my-json-server.typicode.com/kristinacvetinovic/torba/cenovnik';

            var cenovnik = new Array();
            // Populate dropdown with list of porudzbina
            $.getJSON(url, function (data) {
                $.each(data, function (key, entry) {
                        dropdown.append($('<option></option>').attr('value', entry.id).text(entry.cena + " EUR" + entry.tip));
                        cenovnik[entry.id] = entry.cena;                   
                })
            });
        </script>

</body>

</html>
