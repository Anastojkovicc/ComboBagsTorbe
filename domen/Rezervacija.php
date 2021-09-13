<?php


class Rezervacija
{
    //Atributi rezervacije
    public $id;
    public $prodavac;
    public $kupac;
    public $torba;
    public $rezervacija;
    public $datum;
    public $cena;

    //Vracamo iz baze sve rezervacije
    public function vratiSve($mysqli)
    {
        $sql = "SELECT r.*, a.ime_prezime AS prodavac, p.ime_prezime AS kupac, pu.naziv, pu.opis 
                FROM rezervacija r 
                LEFT JOIN korisnik a ON r.id_prodavac=a.id 
                LEFT JOIN korisnik p ON r.id_kupac=p.id
                LEFT JOIN torba pu ON r.id_torba=pu.id";
            //Izdvajamo prema id-u prodavca
        if (isset($this->prodavac->id)) {
            $sql .= " WHERE r.id_prodavac=" . $this->prodavac->id;
        }
        //Sortiramo po rezervacijama
        $sql .= " ORDER BY r.rezervacija ASC";
        $rezultat = $mysqli->query($sql);
        $nizRezervacija = [];
        while ($red = $rezultat->fetch_object()) {
            $prodavac = new Korisnik();
            $prodavac->id = $red->id_prodavac;
            $prodavac->ime_prezime = $red->prodavac;
            
            $kupac = new Korisnik();
            $kupac->id = $red->id_kupac;
            $kupac->ime_prezime = $red->kupac;            
            
            $torba = new Torba();
            $torba->naziv = $red->naziv;
            $torba->opis = $red->opis;

            $rezervacija = new Rezervacija();
            $rezervacija->id = $red->id;
            $rezervacija->prodavac = $prodavac;
            $rezervacija->kupac = $kupac;
            $rezervacija->torba = $torba;
            $rezervacija->rezervacija = $red->rezervacija;
            $rezervacija->datum = $red->datum;
            $rezervacija->cena = $red->cena;
            
            $nizRezervacija[] = $rezervacija;
        }
        return $nizRezervacija;
    }
}
