<?php
session_start();
// direttive include
include "./PHP/crea.php";
include "./PHP/connettiDB.php";

if(isset($_SESSION['id']) && isset($_POST['actions']) && isset($_POST['words']) && isset($_POST['langs']) && isset($_POST['types']))
{
	creaIntestazione(false,"setLogo();");
// apertura connessione
	$mySqlObj = new MySqlClass(DEFAULT_HOST,DEFAULT_USER,DEFAULT_PASS,DEFAULT_DB);
	$mySqlObj->connetti();
// suddivisione in array
	$actions = explode(";",$_POST['actions']);
	$words = explode(";",$_POST['words']);
	$langs = explode(";",$_POST['langs']);
	$types = explode(";",$_POST['types']);
	$numParole = sizeof($actions)-1;
// inizializzazione variabili utili per il risultato
	$paroleAggiunte = "";
	$paroleRimosse = "";
	$paroleNonAggiunte = "";
	$paroleNonRimosse = "";
	for($i=0; $i<$numParole; $i++)
	{
		$words[$i] = strtolower($words[$i]);
		$query = "SELECT count(*) FROM parole WHERE idparole='{$words[$i]}' AND lingua='{$langs[$i]}' AND tipo='{$types[$i]}'";
		$result = $mySqlObj->inviaQuery($query);
		$row = (mysql_fetch_row($result));
		$presente = ($row[0] > 0)? true : false;
		switch($actions[$i])
		{
			case "add":
				if($presente)
					$paroleNonAggiunte .= ($paroleNonAggiunte != "")? "," . $words[$i] : $words[$i];
				else
				{
					$mySqlObj->aggiungi("parole","'{$words[$i]}','{$types[$i]}','{$langs[$i]}'");
					$paroleAggiunte .= ($paroleAggiunte != "")? "," . $words[$i] : $words[$i];
				}
				break;
			
			case "rem":
				if($presente)
				{	
					$mySqlObj->rimuovi("parole","idparole='{$words[$i]}' AND tipo='{$types[$i]}' AND lingua='{$langs[$i]}'");
					$paroleRimosse .= ($paroleRimosse != "")? "," . $words[$i] : $words[$i];
				}
				else
					$paroleNonRimosse .= ($paroleNonRimosse != "")? "," . $words[$i] : $words[$i];
		}
	}
	$mySqlObj->disconnetti();

// visualizzazione risultato modifiche
	if($paroleAggiunte != "")
		echo <<<CODICE
		
			<p class="pMessaggio">Parole aggiunte al Database: <span class="spanRisultato">$paroleAggiunte</span></p>
CODICE;
	if($paroleRimosse != "")
		echo <<<CODICE
		
			<p class="pMessaggio">Parole rimosse dal Database: <span class="spanRisultato">$paroleRimosse</span></p>
CODICE;
	if($paroleNonAggiunte != "")
		echo <<<CODICE
		
			<p class="pMessaggio">Le seguenti parole erano già presenti nel Database: <span class="spanRisultato">$paroleNonAggiunte</span></p>
CODICE;
	if($paroleNonRimosse != "")
		echo <<<CODICE
		
			<p class="pMessaggio">Non è stato possibile rimuovere le seguenti parole dal Database: <span class="spanRisultato">$paroleNonRimosse</span></p>
CODICE;

echo <<<CODICE
			<div id="divComandi">
				<a class="buttons" href="./modifica.php">modifica</a>
				<a class="buttons" href="./mostra.php">mostra</a>
				<a class="buttons" href="./index.php">esci</a>
			</div>
CODICE;
}

else
{
	creaIntestazione(false,"setLogo();","U");
	visualizzaSchermataErrore();
}
?>
		
		</div>
	</body>
</html>