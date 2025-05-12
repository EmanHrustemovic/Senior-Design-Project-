<?php

namespace App\middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Flight;
 
class PatientMiddleware{


    public function checkPatient() {
        
        $user = Flight::get('user'); 
        
        if ($user->role !== 'patient') {
            Flight::halt(403, 'Pristup odbijen: Samo pacijenti imaju pristup ovoj ruti.');
        }
    }

    public function checkPatientPermission($permission) {
        $user = Flight::get('user'); 

        if (!in_array($permission, $user->permissions)) {
            Flight::halt(403, 'Pristup odbijen: Nemate odgovarajuću dozvolu.');
        }
    }

    public function authorizeRole($requiredRole){
        
        $patient = Flight::get('patient');

        if ($patient->role !== $requiredRole){

            Flight::halt(403,'Pristup odbijen : Samo doktori imaju ovakva ovlaštenja !');
        }
    }

    function authorizePermission($permission) {

        $patient = Flight::get('patient');
        
        if (!in_array($permission, $patient->permissions)) {
            
            Flight::halt(403, 'Pristup odbijen : Nemate profil kao pacijent na ovoj aplikaciji !');
        }
    }
    
    
}