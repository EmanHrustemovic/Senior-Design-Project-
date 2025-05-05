<?php


// Set the reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));


class Config
{
   public static function DB_NAME()
   {
       return 'moje_zdravlje_a'; 
   }
   public static function DB_PORT()
   {
       return  3306;
   }
   public static function DB_USER()
   {
       return 'root';
   }
   public static function DB_PASSWORD()
   {
       return 'g3c9h.,1?0';
   }
   public static function DB_HOST()
   {
       return '127.0.0.1';
   }


   public static function JWT_SECRET() {
       return 'aa68644b6dde3f13b99ef790ba7388956a70a24efdd07ea2161612b8a49db7fe';
   }
}
 