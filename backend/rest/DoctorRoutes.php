<?php

use App\dao\DoctorDao;
use App\services\DoctorService;



Flight::route('GET /connection-check' ,function(){
    /*
    $projectService = Flight::projectService();
    
    echo $projectService -> connStatus;
    */
});

Flight::route('GET /doctors' , function(){

    $dao = new DoctorDao();
    $all_doctors = $dao->getAllDoctors();

    Flight::json($all_doctors);

    //RADI
});

Flight::route('GET /doctors/@id',function($id){
    
    $dao = new DoctorDao();
    $doctors_by_id = $dao->getByDocID($id);

    Flight::json($doctors_by_id);

    //RADI
});

Flight::route('POST /doctors/add', function () {
    $data = Flight::request()->data;

    $user_id = $data->user_id;
    $titula = $data->titula;
    $odjeljenje = $data->odjeljenje;

    $service = new DoctorService();
    $service->addDoctor($user_id, $titula, $odjeljenje);

    Flight::json(['message' => 'Doktor uspješno dodat.']);

    //Radi
});


Flight::route('PUT /doctors/@id',function($id){
    $data = Flight::request()->data;

    $service = new DoctorService();
    $updated_doctor = $service-> updateDoctor($id,$data);

    Flight::json($updated_doctor);
//RADI
});

Flight::route('DELETE /doctors/@id' , function($id){

    $message = "";

    $service = new DoctorService();

    $delete_doctor = $service-> deleteDoctor($id);

    if ($delete_doctor) {
        $message =  "Doktor je uspješno izbrisan iz baze podataka .";
    } else {
        $message = "Doktor nije uspješno izbrisan iz baze podataka.";
    }
    print($message);
//RADI
});
