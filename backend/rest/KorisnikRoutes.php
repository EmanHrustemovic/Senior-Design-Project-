<?php

use App\dao\KorisnikDao;
use App\services\korisnikService;


Flight::route('GET /connection-check' ,function(){
    
    $projectService = Flight::projectService();
    
    echo $projectService -> connStatus;

});


Flight::route('GET /user',function(){

    $dao = new KorisnikDao();
    $svi_korisnici = $dao->getAllUsers();

    Flight::json($svi_korisnici);

    //RADI
});

Flight::route('GET /user/@id' , function($id){

    $dao = new KorisnikDao();
    $korisnici_po_id = $dao -> getUserByID($id);
    Flight::json($korisnici_po_id);

    //RADI
});

Flight::route('POST /user/add',function (){

    $data = Flight::request()->data;

    $id = $data -> id;
    $ime = $data -> ime;
    $prezime = $data -> prezime;
    $email = $data -> email;
    $telefon = $data -> telefon;
    $password = $data -> password;
    $uloga = $data -> uloga;

    $service = new KorisnikService();
    $service->addUser($id,$ime,$prezime,$email,$telefon,$password,$uloga);

    Flight::json(['message' => 'Korisnik uspješno dodat.']);
    //RADI
});

Flight::route('PUT /user/@id',function($id){

    $data = Flight::request()->data;

    $service = new KorisnikService();

    $izmjeni_korisnika = $service -> updateUser($id,$data);


    Flight::json($izmjeni_korisnika);
    //NE RADI
});

Flight::route('DELETE /user/@id',function($id){

    $data = Flight::request()->data;

    $service = new KorisnikService();

    $ukloni_korisnika = $service -> deleteUser($id);
    Flight::json($ukloni_korisnika);

    //RADI

});