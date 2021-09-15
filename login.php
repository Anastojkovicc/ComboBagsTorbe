<?php 

include 'init.php'; 

$poruka = "";
if(isset($_POST['login'])){
  $email = $mysqli->real_escape_string(trim($_POST['email']));
  $password = $mysqli->real_escape_string(trim($_POST['password']));

  $korisnik = new Korisnik();
  $korisnik->email = $email;
  $korisnik->sifra = $password;

  if($korisnik->login($mysqli)){
    $poruka ="Uspesno ste se ulogovali";
  }else{
    $poruka ="Neuspesno ste se ulogovali, proverite podatke";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Combo bags | Home</title>

    <link rel="icon" href="img/core-img/logo.png">

    <link rel="stylesheet" href="css/core-style.css">

</head>

<body>

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
                <ul class="site-menu main-menu js-clone-nav ml-auto ">

            <?php
                  if ($_SESSION['ulogovaniKorisnik'] != null) {
                      if ($_SESSION['ulogovaniKorisnik']->uloga == 'prodavac') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="porudzbine.php">Porudzbine</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="izvestaj.php">Izvestaj</a>
                        </li>
                      <?php 
                        } 
                        if ($_SESSION['ulogovaniKorisnik']->uloga == 'kupac') { ?>
                             <li class="nav-item">
                    <a class="nav-link" href="poruci.php">Prodavnica</a>
                </li>
                        <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Izloguj se</a>
                    </li>
                    <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="registracija.php">Sign in</a>
                    </li>

                    <?php } ?>
                </ul>
            </nav>
         
            <div class="social-info d-flex justify-content-between">
                <a href="https://www.instagram.com/combo.bags/?igshid=12a5mp93cknnb"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="https://www.facebook.com/combo.bags1"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                
            </div>
        </header>
        <!-- Header Area End -->

        <div class="products-catagories-area clearfix">
            <div class="amado-pro-catagory clearfix">

 <div class="main">
    <p class="sign" align="center">Login</p>
    <form class="form1" method= "POST" action="">
      <input class="un " type="text" align="center" placeholder="Email" id="email" name="email">
            <input class="pass" type="password" align="center" placeholder="Password" id="password" name="password">
           <input style="background-color: #aa256f; border-color: #aa256f; color: white;" lass="submit" align="center" type="submit" name="login" value="Login" class="form-control btn-primary" id="login">
          </form>      
    </div>
</div>
        <!-- Product Catagories Area End -->
    </div>
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

