<?php   
class DB
{
	
	const DB_HOST = 'partsguru.in';
    const DB_NAME = 'entry';
    const DB_USER = 'entry';
    const DB_PASSWORD = 'entry@123';
	
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