<?php


Flight::route('GET /connection-check' ,function(){
    
    $projectService = Flight::projectService();
    
    echo $projectService -> connStatus;

});


Flight::route('GET /pacijent',function(){

    $dao = new ProjectDao();
    $patients = $dao -> getAllPatients();
    Flight::json($patients);

});

Flight::route('GET /pacijent/@id' , function($id){

    $dao = new ProjectDao();
    $patient = $dao -> getPatientByID($id);
    Flight::json($patient);

});

Flight::route('POST /pacijent',function($data){

    $dao = new ProjectDao();
    $new_patient = $dao -> addPatient($data);
    Flight::json($new_patient);

});

Flight::route('PUT /pacijent',function(){

    $dao = new ProjectDao();
    $change_patient = $dao -> updatePatient($id, $data);
    Flight::json($change_patient);

});

Flight::route('DELETE /pacijent/@id',function($id){

    $dao = new ProjectDao();
    $remove_patient = $dao -> deletePatient($id);
    Flight::json($remove_patient);

});


?>