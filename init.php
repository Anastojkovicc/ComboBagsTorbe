<?php

include 'db/konekcija.php';
include 'domen/Rezervacija.php';
include 'domen/Korisnik.php';
include 'domen/Torba.php';

session_start();

if (!isset($_SESSION['ulogovaniKorisnik'])) {
    $_SESSION['ulogovaniKorisnik'] = null;
}
