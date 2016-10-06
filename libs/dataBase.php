<?php
	class dataBase {
			
		private static $table;	
		private static $where = 1;	
			
		public function dataBase($table){
				
			 self::$table = $table;
		}
		public function find(){
			try {
				$sql = "SELECT * FROM ";
				$sql .= self::$table;
				$sql .= " where :d";
				$stmt = DB::conn()->prepare($sql);
				$stmt->execute([":d"=>self::$where]);
				return $stmt->fetchAll(PDO::FETCH_OBJ);
				$stmt->closeCursor();
			} catch (PDOException $e) {
				die($e->getMessage());
			}
		}
		public function where($where){
			
			self::$where = $where;
		}
		
		public function sanitize($validat){
			foreach($validat as $key =>$data):
			switch($data){
				case "string":
				$ret[$key] = FILTER_SANITIZE_STRING;
				break;
				case "int":
				$ret[$key] = FILTER_SANITIZE_NUMBER_INT;
				break;
				case "email":
				$ret[$key] = FILTER_SANITIZE_EMAIL;
				break;
				default:
				$ret[$key] = "";
				break;
			}
			endforeach;
			return filter_input_array(INPUT_POST, $ret);
			
		}
		/**
			*function insert
		 */
		public function insert($tbl,$validate) {
			$x = self::sanitize($validate);			
			$col		=	implode(",",array_map(function($a){ return "$a";},array_keys($x)));
			$place		=	implode(",",array_map(function($a){ return ":$a";},array_keys($x)));
			foreach($x as $k=>$v):
			$nk = ":".$k;
			$x[$nk] = $v;
			unset($x[$k]);
			endforeach;
			//try {
            //$this->pdo->beginTransaction(); 
			
			try {
				$sql = "INSERT INTO {$tbl} ({$col}) VALUES ({$place})";
				$stmt = DB::conn()->prepare($sql);
				$stmt->execute($x);
			}catch (PDOException $e) {
				DB::conn()->rollBack();
				die($e->getMessage());
			}
		}
		public function eraseId($tbl,$data){
			if(is_array($data)){
				$sql =  "IN (".implode(',',$data).")";
				}else{
				$sql = "=". $data;
			}
			$sqls = "DELETE FROM {$tbl} WHERE id ".$sql; 
			$stmt = DB::conn()->prepare($sqls);
            $stmt->execute();
		}
		
		
		public function update($tbl,$post,$cond) {
			$validate = array_map( function (){ return "string";}, $post);
			$x = self::sanitize($validate);		
			$str = implode(' , ', array_map(
			function ($v, $k) { return sprintf("%s = %s", $k, ":".$k); },
			$x,
			array_keys($validate)
			));
			foreach($x as $k=>$v):
			$nk = ":".$k;
			$x[$nk] = $v;
			unset($x[$k]);
			endforeach;
			$place = $cond. "= :".$cond;
			
			try {
				$sql = "UPDATE {$tbl} SET {$str} WHERE {$place}";
				$stmt = $this->pdo->prepare($sql);
				$stmt->execute($x);
			}catch (PDOException $e) {
				$this->pdo->rollBack();
				die($e->getMessage());
			} 
		}
		
		
		public function getRow($fld,$where,$limit=[0,0]){
			try {
				$sql = "SELECT " ;
				is_array($fld) ? $sql .= implode(", ",$fld) : $sql .= " * ";
				$sql .= " FROM ".self::$table;
				
					$str = implode(' , ', array_map(
					function ($v, $k) { return sprintf("%s = %s", $k, ":".$k); },
					$where,
					array_keys($where)
					));
					foreach($where as $k=>$v):
					$nk = ":".$k;
					$x[$nk] = $v;
					unset($x[$k]);
					endforeach;
					
				$sql .= " WHERE {$str} ";
				if($limit[1] > 0){
					$sql .= " LIMIT ".implode(",",$limit);
				}
				$stmt = DB::conn()->prepare($sql);
				$stmt->execute($x);
				return $stmt->fetchAll(PDO::FETCH_OBJ);
				$stmt->closeCursor();
				} catch (PDOException $e) {
				die($e->getMessage());
			}
		}
		
		
		public function insertBulk($tbl,$validate) {
			try {
				$this->pdo->beginTransaction(); 
				foreach($validateas as $d=>$x):	
					$col		=	implode(",",array_map(function($a){ return "$a";},array_keys($x)));
					$place		=	implode(",",array_map(function($a){ return ":$a";},array_keys($x)));
					foreach($x as $k=>$v):
					$nk = ":".$k;
					$x[$nk] = $v;
					unset($x[$k]);
					endforeach;
					$sql = "INSERT INTO {$tbl} ({$col}) VALUES ({$place})";
					$stmt = $this->pdo->prepare($sql);
					$stmt->execute($x);
				endforeach;
			}catch (PDOException $e) {
				$this->pdo->rollBack();
				die($e->getMessage());
			}
		}
		
		
		
		public function getRows($fld,$arr = array("where"=>array(1=>1))){
			try {
				$sql = "SELECT " ;
				is_array($fld) ? $sql .= implode(", ",$fld) : $sql .= " * ";
				$sql .= " FROM ".self::$table;
				
				if(isset($arr["where"])):
					$where = $arr["where"];
					$str = implode(' AND ', array_map(
						function ($v, $k) { return sprintf("%s = %s", $k, ":".$k); },
						$where,
						array_keys($where)
					));
					foreach($where as $k=>$v):
						$nk = ":".$k;
						$x[$nk] = $v;
						unset($x[$k]);
					endforeach;
					
					$sql .= " WHERE {$str} ";
				endif;
			if(isset($arr["order"])){
					$sql .= " ORDER BT ".$arr["order"];	
				}
				if(isset($arr["limit"])){
					$limit = $arr["limit"];
					if($limit[1] > 0){
						$sql .= " LIMIT :off :limit";
						$x[":off"]= $limit[0];
						$x[":limit"]= $limit[1];
					}
				}
				
				$stmt = DB::conn()->prepare($sql);
				$stmt->execute($x);
				return $stmt->fetchAll(PDO::FETCH_OBJ);
				$stmt->closeCursor();
				} catch (PDOException $e) {
				die($e->getMessage());
			}
		}
	}
	