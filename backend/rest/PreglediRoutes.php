<?php

use App\dao\PreglediDao;
use App\services\preglediService;


Flight::route('GET /connection-check' ,function(){
    
    $projectService = Flight::projectService();
    
    echo $projectService -> connStatus;

});

Flight::route('GET /checks',function(){

    $dao = new PreglediDao();

    $checks = $dao->getAllChecks();
    Flight::json($checks);
    //RADI , VRACA H1
});

Flight::route('GET /checks/@id',function($id){

    $dao = new PreglediDao();
    $checks_per_id = $dao ->preglediPoID($id);
    Flight::json($checks_per_id);

    //RADI , VRACA H1
});

Flight::route('POST /checks/add',function(){

    $data = Flight::request()->data;

    $id = $data -> id;
    $nazivPregleda = $data->nazivPregleda;
    $datum_vrijeme = $data->datum_vrijeme;
    $status = $data->status;
    $opis = $data->opis;
    $rezultati = $data->rezultati;
    $odjeljenje_id = $data ->odjeljenje_id;
    $doktor_id = $data ->doktor_id;
    $preporuka = $data ->preporuka;

    $service = new preglediService();
    $add_check = $service ->dodajPregled($id,$nazivPregleda,$datum_vrijeme,$status,$opis,$rezultati,$odjeljenje_id,$doktor_id,$preporuka);

    Flight::json($add_check);

    //RADI
});

Flight::route('POST /checks/@id',function($id,$data){
    $data = Flight::request()->data;

    $service = new preglediService();
    $update_check = $service ->izmjeniPregled($id, $data);

    Flight::json(["message" => "Pregled uspješno ažuriran"]);

    //NE RADI
});


Flight::route('DELETE /checks/@id',function($id){

    $service = new preglediService();
    $delete_check = $service ->obrisiPregled($id);
    Flight::json($delete_check);

    //RADI

});

