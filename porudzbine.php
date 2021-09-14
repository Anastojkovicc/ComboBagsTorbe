<?php

include 'init.php';

if (!isset($_SESSION['ulogovaniKorisnik']) || empty($_SESSION['ulogovaniKorisnik'])) {
    header('location: login.php');
    exit;
}

$prodavac = $_SESSION['ulogovaniKorisnik'];

if ($prodavac->uloga == "kupac") {
    header('location: poruci.php');
    exit;
}

$kupac = new Korisnik();
$nizKupaca = $kupac->vratiSveKupce($mysqli);

$torba = new Torba();
$nizTorbi = $torba->vratiSve($mysqli);

$rezervacija = new Rezervacija();
$nizRezervacija = $rezervacija->vratiSve($mysqli);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Combo bags | Home</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/logo.png">

  
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
                <a href="index.php"><img src="img/core-img/logo.png" alt=""></a>
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
                <a href="index.php"><img src="img/core-img/logo.png" alt=""></a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li><a href="logout.php">Logout</a></li>
                    <li><a href="brisanjePorudzbina.php">Preview and delete orders</a></li>
                    
                </ul>
            </nav>
            <!-- Button Group -->
            <!-- Social Button -->
            <div class="social-info d-flex justify-content-between">
            <a href="https://www.instagram.com/combo.bags/?igshid=12a5mp93cknnb"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="https://www.facebook.com/combo.bags1"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            </div>
        </header>
        <!-- Product Catagories Area Start -->
        <div class="products-catagories-area clearfix">
            <div class="amado-pro-catagory clearfix">
            <h3 id="msg" class="text-center"><?php if (isset($_GET['msg'])) { echo $_GET['msg']; } ?></h3>                            
            <div class="main">
             <p class="sign" align="center">Izmeni porudzbinu</p>           
              <form class="form1" method="PUT" action="rest/rezervacije">
            <select class="un " type="text" align="center" name="idPorudzbine" class="form-control">
                <?php
                    foreach ($nizRezervacija as $rezervacije) {
                        ?>
                    <option value="<?= $rezervacije->id ?>"><?= $rezervacije->rezervacija  ?></option>

                    <?php
                    }
                ?>
            </select>
            <input class="un " type="text" align="center" type="text" placeholder="Unesi cenu" class="form-control" name="cena">
            <input style="background-color: #aa256f; border-color: #aa256f; color: white;" lass="submit" align="center" type="submit" class="form-control btn-primary" name="izmenaPorudzbine" value="Izmeni porudzbinu">
            </form>
            <h4 id="msgPut" class="text-center"></h4>
        </div>

            </div>
        </div>
        <!-- Product Catagories Area End -->
    </div>
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
            $(document).ready( function () {
                $('#tabelaRezervacija').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5 ]
                            }
                        }
                    ]
                });
            });
        </script>
        <script>
             $(':input[name=izmenaPorudzbine]').click(function() {
                // process the form
                $("form").submit(function(event) {
                    // get the form data
                    var formData = {
                        'idPorudzbine' : $(':input[name=idPorudzbine]').val(),
                        'cena'         : $(':input[name=cena]').val()

                    };
                    setUrl = 'rest/rezervacije/' + formData.idPorudzbine;
                    $.ajax({
                        type        : 'PUT', // define the type of HTTP verb we want to use (POST for our form)
                        url         : setUrl, // the url where we want to POST
                        data        : JSON.stringify(formData), // our data object
                        dataType    : 'json', // what type of data do we expect back from the server
                        encode      : true,
                        contentType: "application/json; charset=UTF-8"
                    }).done(function(data) {
                        $('#msgPut').html(data.poruka);  
                    });
                    
                    // stop the form from submitting the normal way and refreshing the page
                    event.preventDefault();
                });
            });

        </script>

        <style type="text/css">HTML CSSResult Skip Results Iframe
EDIT ON
        body {
        background-color: #F3EBF6;
        font-family: 'Ubuntu', sans-serif;
    }
    
    .main {
        background-color: #FFFFFF;
        width: 400px;
        height: 400px;
        margin: 7em auto;
        border-radius: 1.5em;
        box-shadow: 0px 11px 35px 2px rgba(0, 0, 0, 0.14);
    }
    
    .sign {
        padding-top: 40px;
        color: #d71c4b;
        font-family: 'Ubuntu', sans-serif;
        font-weight: bold;
        font-size: 23px;
    }
    
    .un {
    width: 76%;
    color: rgb(38, 50, 56);
    font-weight: 700;
    font-size: 14px;
    letter-spacing: 1px;
    background: rgba(136, 126, 126, 0.04);
    padding: 10px 20px;
    border: none;
    border-radius: 20px;
    outline: none;
    box-sizing: border-box;
    border: 2px solid rgba(0, 0, 0, 0.02);
    margin-bottom: 50px;
    margin-left: 46px;
    text-align: center;
    margin-bottom: 27px;
    font-family: 'Ubuntu', sans-serif;
    }
    
    form.form1 {
        padding-top: 40px;
    }
    
    .pass {
            width: 76%;
    color: rgb(38, 50, 56);
    font-weight: 700;
    font-size: 14px;
    letter-spacing: 1px;
    background: rgba(136, 126, 126, 0.04);
    padding: 10px 20px;
    border: none;
    border-radius: 20px;
    outline: none;
    box-sizing: border-box;
    border: 2px solid rgba(0, 0, 0, 0.02);
    margin-bottom: 50px;
    margin-left: 46px;
    text-align: center;
    margin-bottom: 27px;
    font-family: 'Ubuntu', sans-serif;
    }
    
   
    .un:focus, .pass:focus {
        border: 2px solid rgba(0, 0, 0, 0.18) !important;
        
    }
    
    .submit {
      cursor: pointer;
        border-radius: 5em;
        color: #fff;
        background: linear-gradient(to right, #9C27B0, #E040FB);
        border: 0;
        padding-left: 40px;
        padding-right: 40px;
        padding-bottom: 10px;
        padding-top: 10px;
        font-family: 'Ubuntu', sans-serif;
        margin-left: 35%;
        font-size: 13px;
        box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);
        text-shadow: 0px 0px 3px rgba(117, 117, 117, 0.12);
        color: #E1BEE7;
        text-decoration: none
    }
    
    .forgot {
        text-shadow: 0px 0px 3px rgba(117, 117, 117, 0.12);
        color: #E1BEE7;
        padding-top: 15px;
    }
    
    a {
        text-shadow: 0px 0px 3px rgba(117, 117, 117, 0.12);
        color: #E1BEE7;
        text-decoration: none
    }
    
    @media (max-width: 600px) {
        .main {
            border-radius: 0px;
        }
        
        




Resources1× 0.5× 0.25×Rerun</style>

</body>

</html>

