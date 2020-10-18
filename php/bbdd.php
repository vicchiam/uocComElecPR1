<?php 

	include("config.php");

	class BD{


		private static function connectDB(){
			$pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME.";charset=utf8",DBUSER,DBPASS);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        	return $pdo;
		}

		public static function query($sql){
			$db=self::connectDB();
			$sth=$db->prepare($sql);            
            $sth->execute();
            return $sth->fetchAll();  
		}

		public static function insert($sql){
			$db=self::connectDB();
			$sth=$db->prepare($sql);
			$inserted=$sth->execute();
            if($inserted)
                return $db->lastInsertId();
            return 0;
		}

		public static function update($sql){
			$db=self::connectDB();
			$sth=$db->prepare($sql);
			$update=$sth->execute();
			if($update)
				return $sth->rowCount();
			return 0;
		}

		public static function delete($sql){
			$db=self::connectDB();
			$sth=$db->prepare($sql);
			$delete = $sth->execute();
			if($delete)
				return $sth->rowCount();
			return 0;
		}

	}

?>