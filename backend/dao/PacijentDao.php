<?php

namespace App\dao;
use App\dao\ProjectDao;

use PDO;

class PacijentDao extends ProjectDao {

    private $pdo;
    private $conn;

    public function __construct() {
        parent::__construct('pacijent_info');
    }

    public function getAllPatients() {
        $stmt = $this->connection->prepare("SELECT * FROM pacijent_info");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPatientByID($id) {
        $stmt = $this->connection->prepare("SELECT * FROM pacijent_info WHERE pacijent_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function addPatient($pacijent_id,$JMBG,$grad,$tezina,$visina,$datumRodenja,$nazivOsiguranika) {
        $sql = 'INSERT INTO pacijent_info (pacijent_id,JMBG,grad,tezina,visina,datumRodenja,nazivOsiguranika) 
            VALUES (:pacijent_id,:JMBG,:grad,:tezina,:visina,:datumRodenja,:nazivOsiguranika)';

        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':pacijent_id', $pacijent_id);
        $stmt->bindParam(':JMBG', $JMBG);
        $stmt->bindParam(':grad', $grad);
        $stmt->bindParam(':tezina', $tezina);
        $stmt->bindParam(':visina', $visina);
        $stmt->bindParam(':datumRodenja', $datumRodenja);
        $stmt->bindParam(':nazivOsiguranika', $nazivOsiguranika);

        $stmt->execute();
    }

    public function updatePatient($id, $data) {
        $sql = 'UPDATE pacijent_info SET pacijent_id = :pacijent_id, JMBG = :JMBG, grad = :grad, 
                tezina = :tezina, visina = :visina, datumRodenja = :datumRodenja, nazivOsiguranika = :nazivOsiguranika 
                WHERE pacijent_id= :pacijent_id';

        $stmt = $this->connection->prepare($sql);

        $pacijent_id = $data->pacijent_id;
        $JMBG = $data->JMBG;
        $grad = $data->grad;
        $tezina = $data -> tezina;
        $visina = $data -> visina;
        $datumRodenja = $data -> datumRodenja;
        $nazivOsiguranika = $data -> nazivOsiguranika;

        $stmt->bindParam(':pacijent_id', $pacijent_id);
        $stmt->bindParam(':JMBG', $JMBG);
        $stmt->bindParam(':grad', $grad);
        $stmt->bindParam(':visina', $visina);
        $stmt->bindParam(':tezina', $tezina);
        $stmt->bindParam(':datumRodenja', $datumRodenja);
        $stmt->bindParam(':nazivOsiguranika',$nazivOsiguranika);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function deletePatient($id) {
        $sql = "DELETE FROM pacijent_info WHERE pacijent_id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        return $stmt->execute();
    }
}

