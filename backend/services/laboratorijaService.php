<?php
namespace App\services;

use App\dao\LaboratorijaDao;

class laboratorijaService {

    private $dao;

    public function __construct(){

        $this->dao = new LaboratorijaDao();
    }

    public function pregledLaboratorije(){
        
         $this->dao->pregledLaboratorije();
    } 

    public function laboratorijaPoId($id){

        return $this->dao->laboratorijaPoId($id);
    }

    public function addLaboratory($sifraNalaza, $tipNalaza, $vrsta_uzorka, $datum_obrade, $status, $pregledi_id) {

        $this->dao->addLaboratory($sifraNalaza, $tipNalaza, $vrsta_uzorka, $datum_obrade, $status, $pregledi_id);
    }


    public function updateLaboratory($id, $data){

        return $this->dao->updateLaboratory($id, $data);
    }

    public function deleteLaboratory($id){
        
        return $this->dao->deleteLaboratory($id);
    }

}