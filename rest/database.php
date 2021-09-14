<?php
class Database
{
    //Unos parametara za povezivanje sa bazom
    private $hostname="localhost";
    private $username="root";
    private $password="";
    private $dbname="torba";
    private $dblink; 
    private $result; 
    private $records; 
    private $affected; 

    public function __construct($dbname)
    {
        $this->dbname = $dbname;
        $this->Connect();
    }

    public function getResult()
    {
        return $this->result;
    }

    //Konektovanje na bazu
    public function Connect()
    {
        $this->dblink = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
        if ($this->dblink ->connect_errno) {
            printf("Konekcija neuspešna: %s\n", $mysqli->connect_error);
            exit();
        }
        $this->dblink->set_charset("utf8");
    }

    //Vracamo rezervacije iz baze 
    public function selectRezervacije($id = null)
    {
        $sql = "SELECT r.*, a.ime_prezime AS prodavac, p.ime_prezime AS kupac, pu.naziv, pu.opis 
                FROM rezervacija t 
                LEFT JOIN korisnik a ON r.id_prodavac=a.id 
                LEFT JOIN korisnik k ON r.id_kupac=k.id
                LEFT JOIN torba pu ON r.torba=pu.id";
    //Ukoliko je unesen id torbice vracamo samo njene rezervacije
        if ($id != null) {
            $sql .= " WHERE t.id=" . $id;
        }
    //Sortiramo rezervacije torbica po id-u
        $sql .= " ORDER BY t.id";
        $this->ExecuteQuery($sql);
    }
    
    //Ubacivanje rezervacije u bazu
    public function insertRezervacije($idProdavac, $idKupac, $idTorba, $rezervacija, $cena)
    {
        //Dodeljujemo trenutno vreme
        $datum = date("Y-m-d");
        $insert = "INSERT INTO rezervacija(id, id_prodavac, id_kupac, id_torba, rezervacija, datum, cena) VALUES (null,$idProdavac,$idKupac,$idTorba,'$rezervacija','$datum',$cena)";

        if ($this->ExecuteQuery($insert)) {
            return true;
        } else {
            return false;
        }
    }
    
    //Menjamo cenu rezervisane torbice prosledjivanjem njenog id-a
    public function updateRezervacije($id, $cena)
    {
        $datum = date("Y-m-d");
        $update = "UPDATE rezervacija SET cena = '$cena', datum = '$datum' WHERE id = $id";
        if (($this->ExecuteQuery($update)) && ($this->affected >0)) {
            return true;
        } else {
            return false;
        }
    }
    
    //Brisanje rezervacije
    public function deleteRezervacije($id)
    {
        $delete = "DELETE FROM rezervacija WHERE id = $id";
        if ($this->ExecuteQuery($delete)) {
            return true;
        } else {
            return false;
        }
    }

    //Izvrsavanje upita
    public function ExecuteQuery($query)
    {
        if ($this->result = $this->dblink->query($query)) {
            if (isset($this->result->num_rows)) {
                $this->records         = $this->result->num_rows;
            }
            if (isset($this->dblink->affected_rows)) {
                $this->affected        = $this->dblink->affected_rows;
            }
            //  "Uspesno izvrsen upit";
            return true;
        } else {
            return false;
        }
    }
}
