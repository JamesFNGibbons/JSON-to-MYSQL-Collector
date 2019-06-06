<?php
	
	require_once "./config.php";

	class Database {

		/**
		  * This function is used to check that the
		  * database has been setup, before we attempt
		  * to create a new instance of the db class.
		*/
		public static function do_startup(){
			if(defined('DB_USERNAME') && defined('DB_PASSWORD') && defined('DB_HOSTNAME') && defined('DB_DATABASE')){
				$db = new PDO(
					'mysql:host='.DB_HOSTNAME.';dbname='.DB_DATABASE,
    				DB_USERNAME,
    				DB_PASSWORD
    			);

    			foreach(scandir('../sql') as $file){
    				$sql = fopen($file, 'R');

    				/** 
    				  * Execute the SQL file.
    				*/
    				try {
						$query = $db->prepare($sql);
    					$query->execute();
    				}
    				catch(PDOException $e){
    					die($e);
    				}
    			}
			}
			else{
				die('Bad database config.');
			}
		}

	}