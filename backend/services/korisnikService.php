<?php

namespace App\services;
//require_once '../dao/KorisnikDao.php';

use App\dao\KorisnikDao;

class KorisnikService {

    private $dao;

    public function __construct(){

        $this -> dao = new KorisnikDao();
        //parent::__construct($dao);
    }

    public function getAllUsers(){

        return $this->dao->getAllUsers();
    }

    public function getUserByID($id){

        return $this->dao->getUserByID($id);
    }

    public function addUser($id,$ime,$prezime,$email,$telefon,$password,$uloga){

        return $this->dao->addUser($id,$ime,$prezime,$email,$telefon,$password,$uloga);;
    }

    public function updateUser($id, $data){

        return $this->dao->updateUser($id, $data);
    }

    public function deleteUser($id){

        return $this->dao->deleteUser($id);
    }
}
