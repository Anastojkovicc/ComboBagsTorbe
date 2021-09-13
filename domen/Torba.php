<?php

class Torba
{
    public $id;
    public $naziv;
    public $opis;

    //Vracamo iz baze sve torbe po nazivu koji je unesen i sortiramo po nazivu i opisu
    public function vratiSve($mysqli)
    {
        $sql = "SELECT * FROM torba WHERE naziv LIKE '%" . $this->naziv . "%' ORDER BY naziv, opis ASC";
        $rezultat = $mysqli->query($sql);
        $nizTorbi = [];
        while ($red = $rezultat->fetch_object()) {
            $torba = new Torba();
            $torba->id = $red->id;
            $torba->naziv = $red->naziv;
            $torba->opis = $red->opis;
            $nizTorbi[] = $torba;
        }
        return $nizTorbi;
    }
}
