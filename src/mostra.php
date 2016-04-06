<?php
session_start();
// direttive include
include "./PHP/crea.php";
include "./PHP/connettiDB.php";

// login corretto
if(isset($_SESSION['id']))
{
	unset($_GET['lang']);
	creaIntestazione(false,"setLogo();");
// apertura connessione
	$mySqlObj = new MySqlClass(DEFAULT_HOST,DEFAULT_USER,DEFAULT_PASS,DEFAULT_DB);
	$mySqlObj->connetti();
	$query = "SELECT idparole,lingua,tipo FROM parole ORDER BY idparole";
	$result = $mySqlObj->inviaQuery($query);
	echo <<<CODICE
				
				<p id="pMostra">Questa pagina visualizza l'intero set di parole contenuto nel DataBase.</p>
				
				<table>
					<tr>
						<th>parola</th>
						<th>lingua</th>
						<th>tipo</th>
					</tr>
CODICE;
	while($row = mysql_fetch_row($result))
		echo<<<CODICE
					
					<tr>
						<td>$row[0]</td>
						<td>$row[1]</td>
						<td>$row[2]</td>
					</tr>
CODICE;
		echo<<<CODICE
		
				</table>
				
				<div id="divComandi">
					<a class="buttons" href="./modifica.php">modifica</a>
					<a class="buttons" href="./index.php">esci</a>
				</div>
CODICE;
// chiusura connessione
	$mySqlObj->disconnetti();
}

// login scorretto
else
{
	creaIntestazione(false,"setLogo();","U");
	visualizzaSchermataErrore();
}
?>
		
		</div>
	</body>
</html>