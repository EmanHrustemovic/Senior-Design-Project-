<?php

namespace App\middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Flight;
 

class DoctorMiddleware{

    public function checkDoctor(){
        $user = Flight::get('user');

        if ($user->role !== 'doctor'){
            Flight::halt(403, 'Pristup odbijen: Samo doktori imaju pristup ovoj ruti.');
        }
    }

    public function checkDoctorPermission($permission) {
        $user = Flight::get('user'); 
        
        if (!in_array($permission, $user->permissions)) {
            Flight::halt(403, 'Pristup odbijen: Nemate odgovarajuću dozvolu.');
        }
    }

    public function authorizeRole($requiredRole){
        
        $doctor = Flight::get('doctor');

        if ($doctor->role !== $requiredRole){

            Flight::halt(403,'Pristup odbijen : Samo doktori imaju ovakva ovlaštenja !');
        }
    }

    function authorizePermission($permission) {

        $doctor = Flight::get('doctor');
        
        if (!in_array($permission, $doctor->permissions)) {
            
            Flight::halt(403, 'Pristup odbijen : Nedostaje dozvola !');
        }
    }   

}