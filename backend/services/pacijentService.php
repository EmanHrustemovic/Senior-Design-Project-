<?php
namespace App\services;

use App\dao\PacijentDao;


class pacijentService {

    private $dao;
    
    public function __construct(){

        $this->dao = new PacijentDao();

    }

    public function getAllPatients(){

        return $this->dao->getAllPatients();
    }

    public function getPatientByID($id){

        return $this->dao->getPatientByID($id);
    }

    public function addPatient($pacijent_id,$JMBG,$grad,$tezina,$visina,$datumRodenja,$nazivOsiguranika){

        $this->dao->addPatient($pacijent_id,$JMBG,$grad,$tezina,$visina,$datumRodenja,$nazivOsiguranika);
    }

    public function updatePatient($id, $data){

        return $this->dao->updatePatient($id, $data);
    }

    public function deletePatient($id){

        return $this->dao->deletePatient($id);
    }
}
