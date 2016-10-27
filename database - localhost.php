<?php

	class database {

		public $isconn;
		protected $datab;
	
		// Connect to database
		public function __construct($host = "localhost", $username = "root", $password = "", $db = "movies") {
			
			$this->isconn = true;
			
			try{
				
				$this->datab = new PDO("mysql:host={$host};dbname={$db};",$username,$password);	
				$this->datab->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
				
			} catch(PDOException $e) {
				
				throw new exception($e->getMessage());
				
			}
			
		}
		
		// Disconnect from db
		public function disconnect(){
			$this->datab = null;
			$this->isconn = false;
		}
		
		// Get a single record
		public function getrow($query, $params = []) {
			try{
				$qry = $this->datab->prepare($query);
				$qry->execute($params); 
				return $qry->fetch();	
			} catch (PDOException $e) {
				throw new Exception ($e->getMessage());
			}
			
		}
		
		// Get a multiple record
		public function getrows($query, $params = []) {
		
			try{
				$qry = $this->datab->prepare($query);
				$qry->execute($params); 
				return $qry->fetchall();	
			} catch (PDOException $e) {
				throw new Exception ($e->getMessage());
			}
			
		}
		
		// Insert a record
		public function insertrows($query, $params = []) {
			
			try{
				$qry = $this->datab->prepare($query);
				$qry->execute($params); 
				return true;	
			} catch (PDOException $e) {
				throw new Exception ($e->getMessage());
			}
		}
		
		// Update a record
		public function updaterow($query, $params = []) {
			$this->insertrow($query,$param);
		}
		
		// Delete a record
		public function deleterow($query, $params = []) {
			$this->insertrows($query,$params);
			
		}
	}

?>