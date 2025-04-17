<?php
namespace App\services;

use App\dao\DoctorDao;

class DoctorService{

    private $dao;

    public function __construct(){

        $this->dao = new DoctorDao();

    }

    public function getAllDoctors(){
        
        $this->dao->getAllDoctors();
    }

    public function getByDocID($id){

        return $this->dao->getByDocID($id);
    }

    public function addDoctor($user_id,$titula,$odjeljenje){

        $this->dao->addDoctor($user_id,$titula,$odjeljenje);
    }

    public function updateDoctor($id,$data){

        return $this->dao->updateDoctor($id,$data);

    }

    public function deleteDoctor($id){
        
        return $this->dao->deleteDoctor($id);
    }

}