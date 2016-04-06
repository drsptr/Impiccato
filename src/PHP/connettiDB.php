<?php
// definizione costanti
define("DEFAULT_HOST","127.0.0.1");
define("DEFAULT_USER","root");
define("DEFAULT_PASS","");
define("DEFAULT_DB","tia");

// classe "MySqlClass"
// la struttura è ripresa da http://php.html.it/guide/lezione/4376/la-connessione-a-mysql/
class MySqlClass
{
	// campi dati
	private $hostname;
	private $username;
	private $password;
	private $database;
	private $connessione;
	private $stato;
	
	// funzioni membro
	public function MySqlClass($host,$user,$pass,$db)
	{
		$this->hostname = $host;
		$this->username = $user;
		$this->password = $pass;
		$this->database = $db;
		$this->stato = false;
	}

	public function connetti()
	{
		if(!($this->stato))
		{
			$this->connessione = mysql_connect($this->hostname,$this->username,$this->password) or die("Connection Error: " . mysql_error());
			mysql_select_db("tia") or die("Database Selection Error: " . mysql_error());
			$this->stato = true;
		}
		return $this->stato;
	}
	
	public function disconnetti()
	{
		if($this->stato)
		{
			mysql_close($this->connessione);
			$this->stato = false;
			return true;
		}
		return false;
	}
	
	public function inviaQuery($query)
	{
		if($this->stato)
		{
			$ris = mysql_query($query) or die("Query Error: " . mysql_error());
			return $ris;
		}
		return false;
	}
	
	// formato istruzione SQL: INSERT INTO Tabella[(attr1,...,attrN)] VALUES(val1,...,valN)
	// esempio uso: aggiungi("parole","'prova aggiungi','MULT','IT'")
	public function aggiungi($tabella,$value,$attributi="")
	{
		if($this->stato)
		{
			$istruzione = "INSERT INTO " . $tabella;
			if($attributi!="")
			{
				$istruzione .= "(" . $attributi . ")";
			}
			$istruzione .= " VALUES (" . $value . " )";
			$ris = mysql_query($istruzione) or die("Modify Error: " . mysql_error());
			return true;
		}
		return false;
	}
	
	// formato istruzione SQL: DELETE FROM Tabella [ WHERE Condizione ]
	// esempio uso: rimuovi("parole","idparole='prova aggiungi'")
	public function rimuovi($tabella,$cond="")
	{
		if($this->stato)
		{
			$istruzione = "DELETE FROM " . $tabella;
			if($cond!="")
				$istruzione .= " WHERE " . $cond;
			$ris = mysql_query($istruzione) or die("Modify Error: " . mysql_error());
			return true;
		}
		return false;
	}
}
?>