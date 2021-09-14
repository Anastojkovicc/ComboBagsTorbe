<?php
require 'flight/Flight.php';
require 'jsonindent.php';
Flight::register('db', 'Database', array('torba'));
$json_podaci = file_get_contents("php://input");
Flight::set('json_podaci', $json_podaci);

Flight::route('/', function () {
    echo 'hello world!';
});


//Prikaz svih rezervacija
Flight::route('GET /rezervacije.json', function () {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $db->selectRezervacije();
    $niz = array();
    $i=0;
    while ($red=$db->getResult()->fetch_object()) {
        $niz[$i]["id"] = $red->id;
        $niz[$i]["rezervacija"] = $red->rezervacija;
        $niz[$i]["datum"] = $red->datum;
        $niz[$i]["cena"] = $red->cena;
        $niz[$i]["prodavac"] = $red->prodavac;
        $niz[$i]["kupac"] = $red->kupac;
        $niz[$i]["naziv"] = $red->naziv;
        $niz[$i]["opis"] = $red->opis;
        $i++;
    }

    $json_niz = json_encode($niz, JSON_UNESCAPED_UNICODE);
    echo indent($json_niz);
    return false;
});

//Vracamo odredjenu rezervaciju
Flight::route('GET /rezervacije/@id.json', function ($id) {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $db->selectRezervacije($id);
    $red = $db->getResult()->fetch_object();
    $json_niz = json_encode($red, JSON_UNESCAPED_UNICODE);
    echo indent($json_niz);
    return false;
});

//Kreiramo novu rezervaciju 
Flight::route('POST /rezervacije', function () {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $podaci_json = Flight::get("json_podaci");
    $podaci = json_decode($podaci_json);
    if ($podaci == null) {
        $odgovor["poruka"] = "Niste prosledili podatke";
        $json_odgovor = json_encode($odgovor);
        echo $json_odgovor;
        return false;
    } else {
        if (!property_exists($podaci, 'idProdavac')||
            !property_exists($podaci, 'idKupac')||
            !property_exists($podaci, 'idTorba')||
            !property_exists($podaci, 'cena')||
            !property_exists($podaci, 'rezervacija')) {
            $odgovor["poruka"] = "Niste prosledili korektne podatke";
            $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
            echo $json_odgovor;
            return false;
        } else {
            if ($db->insertRezervacije($podaci->idProdavac, $podaci->idKupac, $podaci->idTorba, $podaci->rezervacija, $podaci->cena)) {
                $odgovor["poruka"] = "Torba jeste uspesno porucena";
                $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
                echo $json_odgovor;
                return false;
            } else {
                $odgovor["poruka"] = "Došlo je do greške pri porudzbini";
                $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
                echo $json_odgovor;
                return false;
            }
        }
    }
});


//Izmena rezervacije
Flight::route('PUT /rezervacije/@id', function ($id) {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $podaci_json = Flight::get("json_podaci");
    $podaci = json_decode($podaci_json);
    if ($podaci == null) {
        $odgovor["poruka"] = "Niste prosledili podatke";
        $json_odgovor = json_encode($odgovor);
        echo $json_odgovor;
    } else {
        if (!property_exists($podaci, 'cena')) {
            $odgovor["poruka"] = "Niste prosledili korektne podatke";
            $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
            echo $json_odgovor;
            return false;
        } else {
            if ($db->updateRezervacije($id, $podaci->cena)) {
                $odgovor["poruka"] = "Porudzbina je uspesno izmenjena";
                $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
                echo $json_odgovor;
                return false;
            } else {
                $odgovor["poruka"] = "Došlo je do greške pri izmeni porudzbine";
                $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
                echo $json_odgovor;
                return false;
            }
        }
    }
});


//Brisanje odabrane rezervacije
Flight::route('DELETE /rezervacije/@id', function ($id) {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    if ($db->deleteRezervacije($id)) {
        $odgovor["poruka"] = "Porudzbina je uspesno izbrisana";
        $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
        echo $json_odgovor;
        return false;
    } else {
        $odgovor["poruka"] = "Došlo je do greške prilikom brisanja porudzbine";
        $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
        echo $json_odgovor;
        return false;
    }
});


Flight::start();
