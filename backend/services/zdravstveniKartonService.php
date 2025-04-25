<?php

namespace App\services;

use App\dao\ZdravstveniKartonDao;

class zdravstveniKartonService {

    private $dao;

    public function __construct(){

        $this -> dao = new ZdravstveniKartonDao();

    }

    public function izlistajKarton(){

         $this->dao->izlistajKarton();
    }

    public function kartoniPoID($id){

        return $this->dao->kartoniPoID($id);
    }

    public function izmjeniKarton($id, $data){

        return $this->dao->izmjeniKarton($id,$data);
    }

    public function dodajKarton($id,$sifraBolesti,$nazivBolesti,$dijagnoza,$terapija,$pacijent_id,$pregledi_id,$doktor_id){

       return $this->dao->dodajKarton($id,$sifraBolesti,$nazivBolesti,$dijagnoza,$terapija,$pacijent_id,$pregledi_id,$doktor_id);
    }

    public function obrisiKarton($id){

        return $this->dao->obrisiKarton($id);
    }
}