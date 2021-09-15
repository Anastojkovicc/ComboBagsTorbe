<?php

class Korisnik
{
    //Definisemo atribute korisnika
    public $id;
    public $ime_prezime;
    public $email;
    public $sifra;
    public $uloga;

    public function login($mysqli)
    {
        //Spajamo iz baze korisnika sa ulogom po id-u
        // Potrebno je da se poklapaju email i sifra kako bi se korisnik ulogovao
        $sql = "SELECT k.*, u.naziv FROM korisnik k JOIN uloga u ON k.id_uloga=u.id WHERE email='$this->email' and sifra='$this->sifra'";
        $rezultat = $mysqli->query($sql);
        while ($red = $rezultat->fetch_object()) {
            
            $korisnik = new Korisnik();
            $korisnik->id = $red->id;
            $korisnik->ime_prezime = $red->ime_prezime;
            $korisnik->email = $red->email;
            $korisnik->sifra = $red->sifra;
            $korisnik->uloga = $red->naziv;
            //Ukoliko je pronadjen korisnik u bazi, dodeljujemo ga sesiji
            $_SESSION['ulogovaniKorisnik'] = $korisnik;

            return true;
        }
        return false;
    }

    //Registracija korisnika pri kojoj se dodeljuje uloga kupca
    public function save($mysqli)
    {
        $sql = "INSERT INTO korisnik(ime_prezime,email,sifra,id_uloga) VALUES ('$this->ime_prezime','$this->email','$this->sifra', 2)";
        if ($mysqli->query($sql)) {
            return true;
        }
        return false;
    }

    //Vracamo sve prodavce iz baze po unesenom filteru
    public function vratiSveProdavce($mysqli)
    {
        $sql = "SELECT * FROM korisnik WHERE ime_prezime LIKE '%" . $this->ime_prezime . "%' AND id_uloga=1 ORDER BY ime_prezime ASC";
        $rezultat = $mysqli->query($sql);
        $nizKupaca = [];
        while ($red = $rezultat->fetch_object()) {
            $kupac = new Korisnik();
            $kupac->id = $red->id;
            $kupac->ime_prezime = $red->ime_prezime;
            $kupac->uloga = "kupac";
            
            $nizKupaca[] = $kupac;
        }
        return $nizKupaca;
    }

    //Vracamo iz baze sve kupce po unesenom filteru
    public function vratiSveKupce($mysqli)
    {
        $sql = "SELECT * FROM korisnik WHERE ime_prezime LIKE '%" . $this->ime_prezime . "%' AND id_uloga=2 ORDER BY ime_prezime ASC";
        $rezultat = $mysqli->query($sql);
        $nizKupaca = [];
        while ($red = $rezultat->fetch_object()) {
            $kupac = new Korisnik();
            $kupac->id = $red->id;
            $kupac->ime_prezime = $red->ime_prezime;
            $kupac->uloga = "kupac";
            
            $nizKupaca[] = $kupac;
        }
        return $nizKupaca;
    }
    
}
