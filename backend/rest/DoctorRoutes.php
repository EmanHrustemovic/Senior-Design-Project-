<?php


Flight::route('GET /connection-check' ,function(){
    
    $projectService = Flight::projectService();
    
    echo $projectService -> connStatus;

});

Flight::route('GET /doctors' , function(){

    $dao = new ProjectDao();
    $all_doctors = $dao -> getAllDoctors();
    Flight::json($all_doctors);

});

Flight::route('GET /doctors/@id',function($id){
    
    $dao = new ProjectDao();
    $doctors_by_id = $dao -> getByDocID($id);
    Flight::json($doctors_by_id);
});

Flight::route('POST /doctors/add',function($data){

    $dao = new ProjectDao();
    $new_doctor = $dao -> addDoctor($data);
    Flight::json($new_doctor);

});

Flight::route('',function($id, $data){

    $dao = new ProjectDao();
    $updated_doctor = $dao -> updateDoctor($id, $data);
    Flight::json($updated_doctor);

});

Flight::route('DELETE /' , function($id){
    $dao = new ProjectDao();
    $delete_doctor = $dao -> deleteDoctor($id);
    Flight::json($delete_doctor);

});

?>