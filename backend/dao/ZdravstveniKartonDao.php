<?php

namespace App\dao;
use App\dao\ProjectDao;

use PDO;

class ZdravstveniKartonDao extends ProjectDao {

    private $conn;
    private $pdo;

    public function __construct() {
        parent::__construct('zdravstvenikarton');

    }

    public function izlistajKarton() {
        $stmt = $this->connection->prepare("SELECT * FROM zdravstvenikarton");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function kartoniPoID($id) {

        $stmt = $this->connection->prepare("SELECT * FROM zdravstvenikarton WHERE id = :id");
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $stmt->fetch();
    }

    public function dodajKarton($id,$sifraBolesti,$nazivBolesti,$dijagnoza,$terapija,$pacijent_id,$pregledi_id,$doktor_id){
        $sql = 'INSERT INTO zdravstvenikarton(id,sifraBolesti,nazivBolesti,dijagnoza,terapija,pacijent_id,pregledi_id,doktor_id)
                VALUES(:id,:sifraBolesti,:nazivBolesti,:dijagnoza,:terapija,:pacijent_id,:pregledi_id,:doktor_id)';


        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':sifraBolesti', $sifraBolesti);
        $stmt->bindParam(':nazivBolesti', $nazivBolesti);
        $stmt->bindParam(':dijagnoza', $dijagnoza);
        $stmt->bindParam(':terapija', $terapija);
        $stmt->bindParam(':pacijent_id', $pacijent_id);
        $stmt->bindParam(':pregledi_id', $pregledi_id);
        $stmt->bindParam(':doktor_id', $doktor_id_id);

        $stmt->execute();
    }

    public function izmjeniKarton($id, $data) {
        $sql = 'UPDATE zdravstvenikarton SET id = :id,sifraBolesti = :sifraBolesti,nazivBolesti = :nazivBolesti,
                             dijagnoza = :dijagnoza, terapija = :terapija, pacijent_id = :pacijent_id, pregledi_id = :pregledi_id, doktor_id = :doktor_id
                WHERE id = :id';
        
        $stmt = $this->connection->prepare($sql);

        $id = $data->id;
        $sifraBolesti = $data ->sifraBolesti;
        $nazivBolesti = $data -> nazivBolesti;
        $dijagnoza = $data -> dijagnoza;
        $terapija = $data -> terapija;
        $pacijent_id = $data -> pacijent_id;
        $pregledi_id = $data -> pregledi_id;
        $doktor_id = $data -> doktor_id;

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':sifraBolesti', $sifraBolesti);
        $stmt->bindParam(':nazivBolesti', $nazivBolesti);
        $stmt->bindParam(':dijagnoza', $dijagnoza);
        $stmt->bindParam(':terapija', $terapija);
        $stmt->bindParam(':pacijent_id', $pacijent_id);
        $stmt->bindParam(':pregledi_id', $pregledi_id);
        $stmt->bindParam(':doktor_id', $doktor_id_id);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function obrisiKarton($id) {
        $sql = "DELETE FROM zdravstvenikarton WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id,PDO::PARAM_INT);

        return $stmt->execute();
    }
    public function getConn() {
        return $this->conn;
    }
}

