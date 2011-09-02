<?php 
	class DbMySQL {
		private $host  		= DB_HOST;
		private $user 		= DB_USER;
		private $password 	= DB_PASSWORD;
		private $database   = DB_DATABASE;
		private $linkId 	= null;
	
	 	function connect () {
			if ($this->linkId == 0)
			{
				$this->linkId = mysql_connect($this->host, $this->user, $this->password);
				$selectResult = mysql_select_db($this->database, $this->linkId);
			}
		}
		function close() {
			if($this->linkId != 0)
			{
				$this->cleanResults();
				@mysql_close();
				$this->linkId = 0;
			}
		}
		
		function cleanResults() {
			if($this->queryId != 0){
				@mysql_free_result($this->queryId);
			}
		}
		
		function query($queryString) {
			$this->connect();
			$this->queryId = mysql_query($queryString, $this->linkId);
			$this->row = 0;
			$this->errno = mysql_errno();
			$this->error = mysql_error();
			if (!$this->queryId)
			{
				//$this->writeLog($this->error);
				echo $queryString;
				$this->error = mysql_error();
				echo $this->error;
				return false;
			}
			return $this->queryId;
		}
		
		function getRecords($flag = MYSQL_ASSOC) {
			if ($this->queryId == 0) {
				return false;
			}
			while($row = $this->nextRecord($flag))
				$records[] = $row;
			return $records;
		}
		
		function nextRecord ($flag = MYSQL_ASSOC) {
			$this->record = mysql_fetch_array($this->queryId, $flag);
			$this->row += 1;
			$this->errno = mysql_errno();
			$this->error = mysql_error();
			$status = is_array($this->record);
			
			if (!$status)
			{
				mysql_free_result($this->queryId);
				$this->queryId = 0;
			}
			return $this->record;
		}
		
		function lastInsertId() {
			return mysql_insert_id($this->linkId);
		}
	}
?>