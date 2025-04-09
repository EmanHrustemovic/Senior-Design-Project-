<?php


Flight::route('GET /connection-check' ,function(){
    
    $projectService = Flight::projectService();
    
    echo $projectService -> connStatus;

});


Flight::route('GET /user',function(){

    $dao = new ProjectDao();
    $svi_korisnici = $dao -> getAllUsers();
    Flight::json($svi_korisnici);

});

Flight::route('GET /user/@id' , function($id){

    $dao = new ProjectDao();
    $korisnici_po_id = $dao -> getUserByID($id);
    Flight::json($korisnici_po_id);

});

Flight::route('POST /user/',function($id,$data){

    $dao = new ProjectDao();
    $izmjeni_korisnika = $dao -> updateUser($id, $data);
    Flight::json($izmjeni_korisnika);

});

Flight::route('',function($id,$data){

    $dao = new ProjectDao();
    $ukloni_korisnika = $dao -> deleteUser($id);
    Flight::json($ukloni_korisnika);

});

?>