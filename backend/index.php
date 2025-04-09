<?php

require 'vendor/autoload.php'; 
require_once 'dao/DoctorDao.class.php';

// var_dump("{test:123}");


Flight::route('/test', function() {
    echo 'TEST';
});

Flight::route('/', function() {
    echo 'HOME';
});

Flight::route('/abc', [ 'Greeting','hello' ]);


Flight::route('/test1', function() {
    
    // $doctorDao = new DoctorDao();

    // $doctors = $doctorDao->getAllDoctors();

    
    // echo '<pre>';
    // // print_r($doctors);
    // echo '</pre>';
});


Flight::start();
?>
