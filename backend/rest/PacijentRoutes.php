<?php

require_once __DIR__ . '/../dao/PacijentDao.php';
require_once __DIR__ . '/../services/pacijentService.php';

use App\dao\PacijentDao;
use App\services\pacijentService;


Flight::route('GET /connection-check' ,function(){
    
    $projectService = Flight::projectService();
    
    echo $projectService -> connStatus;

});


Flight::route('GET /patient',function(){

    $dao = new PacijentDao();
    $patients = $dao -> getAllPatients();
    Flight::json($patients);

    //RADI 

});

Flight::route('GET /patient/@id' , function($id){

    $dao = new PacijentDao();
    $patient = $dao -> getPatientByID($id);
    Flight::json($patient);

    //RADI 
});

Flight::route('POST /patient/add',function(){
    $data = Flight::request()->data;

    $pacijent_id =$data -> pacijent_id;
    $JMBG = $data -> JMBG;
    $grad = $data -> grad;
    $tezina = $data -> tezina;
    $visina = $data -> visina;
    $datumRodenja = $data -> datumRodenja;
    $nazivOsiguranika = $data -> nazivOsiguranika;

    $service = new pacijentService();
    $new_patient = $service->addPatient($pacijent_id,$JMBG,$grad,$tezina,$visina,$datumRodenja,$nazivOsiguranika);
    Flight::json($new_patient);

    //RADI UREDNO 
});

Flight::route('PUT /patient/@id',function($id){

    $data = Flight::request()->data;

    $service = new pacijentService();
    $change_patient = $service -> updatePatient($id, $data);

    Flight::json($change_patient);

    //RADI UREDNO 

});

Flight::route('DELETE /patient/@id',function($id){

    $message = "";

    $service = new pacijentService();

    $remove_patient = $service -> deletePatient($id);
    Flight::json($remove_patient);

    if ($remove_patient) {
        $message =  "Pacijent je uspješno izbrisan iz baze podataka .";
    } else {
        $message = "Pacijent nije uspješno izbrisan iz baze podataka.";
    }
    print($message);

    //RADI 
});
