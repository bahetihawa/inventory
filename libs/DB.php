<?php   
class DB
{
	
	const DB_HOST = 'localhost';
    const DB_NAME = 'maayafin_db';
    const DB_USER = 'maayafin_ejewels';
    const DB_PASSWORD = 'rIludpgyN6U6';
	
   private static $instance = null;
   public static function conn()
   {
       if(self::$instance == null)
       {
		   $conStr = sprintf("mysql:host=%s;dbname=%s", self::DB_HOST, self::DB_NAME);
           try
           {
               self::$instance = new PDO($conStr, self::DB_USER, self::DB_PASSWORD);
           } 
           catch(PDOException $e)
           {
               // Handle this properly
               throw $e;
           }
       }
       return self::$instance;
   }
}
?>