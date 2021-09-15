<?php 

include 'init.php';

if (!isset($_SESSION['ulogovaniKorisnik']) || empty($_SESSION['ulogovaniKorisnik'])) {
    header('location: login.php');
    exit;
}

$prodavac = $_SESSION['ulogovaniKorisnik'];

if ($prodavac->uloga == "kupac") {
    header('location: index.php');
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

    <link rel="icon" href="img/core-img/favicon.ico">

    <link rel="stylesheet" href="css/core-style.css">

</head>

<body>

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
   
    <div class="main-content-wrapper d-flex clearfix">

        
        <div class="mobile-nav">
            <div class="amado-navbar-brand">
                <a href="index.php"><img src="img/core-img/logo.png" alt=""></a>
            </div>
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>


        <header class="header-area clearfix">
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <div class="logo">
                <a href="index.php"><img src="img/core-img/logo.png" alt=""></a>
            </div>
            <nav class="amado-nav">
                <ul>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>

            <div class="social-info d-flex justify-content-between">
                 <a href="https://www.instagram.com/combo.bags/?igshid=12a5mp93cknnb"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="https://www.facebook.com/combo.bags1"><i class="fa fa-facebook" aria-hidden="true"></i></a>

            </div>
        </header>
        
        <div class="products-catagories-area clearfix">
            <div class="amado-pro-catagory clearfix">

               <div class="container">
         <div id="grafik"></div>
      </div>
        
    </div>
</div>
</div>

<br>
<br>
<br>
<br>
    <!-- ##### Footer Area Start ##### -->
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
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    </script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(crtajGrafik2);

        function crtajGrafik2() {
          var niz = [];
          var kolone = [];
          kolone.push("Ukupno");
          kolone.push("Datum");
          niz.push(kolone);
          $.ajax({
            url: 'db/grafik2.php',
            success: function(data){
              $.each(JSON.parse(data),function(i,podatak){
                var ukupno = parseInt(podatak.ukupno);
                var datum = new Date(parseInt(podatak.godina), parseInt(podatak.mesec), 1);
                var red = [];
                red.push(datum);
                red.push(ukupno);
                niz.push(red);
              })
              var podaci = google.visualization.arrayToDataTable(niz);

              var options = {
                title: 'Zarada po mesecu',
                height: 600
              };

              var chart = new google.visualization.ColumnChart(document.getElementById('grafik'));

              chart.draw(podaci, options);
            }
          })
        } 
      </script>

</body>

</html>