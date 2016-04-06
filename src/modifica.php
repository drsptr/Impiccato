<?php
session_start();
// direttive include
include "./PHP/connettiDB.php";

// settaggio parametri
$_user = "";
$_pass = "";
if(isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['lang']))
{
	$_user = filtra($_POST['user']);
	$_pass = filtra($_POST['pass']);
	$_GET['lang']  = $_POST['lang'];
}

// funzioni di utilità
function filtra($stringa)
{
	$pattern = "/[^a-z0-9]/i";
	return preg_replace($pattern,"",$stringa);
}



// controllo di username e password
$mySqlObj = new MySqlClass(DEFAULT_HOST,DEFAULT_USER,DEFAULT_PASS,DEFAULT_DB);
$mySqlObj->connetti();
$query = "select count(*),idadmin from admins where username='" . $_user . "' and password='" . $_pass . "'";
$result = $mySqlObj->inviaQuery($query);
$row = mysql_fetch_row($result);
if($row[0]>0)
	$_SESSION['id'] = $row[1];
$mySqlObj->disconnetti();
	
// generazione del codice in base alle credenziali inserite
// username e password corrette
if(isset($_SESSION['id']))
{
	unset($_GET['lang']);
	include "./PHP/crea.php";
	creaIntestazione(false,"setLogo();");
	echo <<<CODICE
	
			<p id="pDB">
				Clicca sul pulsante <input class="buttons" type="button" value="+" onclick="aggiungiRiga();"> per aggiungere una riga 
				o sul pulsante <input class="buttons" type="button" value="-" onclick="eliminaRiga();"> per rimuovere una riga.
			</p>
				<table id="tabella">
					<tr> 
						<th>azione</th>
						<th>parola</th>
						<th>lingua</th>
						<th>tipo</th>
					</tr>
					
					<tr>
						<td>
							<select name="azione">
								<option value="add" selected>aggiungi</option>
								<option value="rem">rimuovi</option>
							</select>
						</td>
						<td>
							<input type="text" name="parola" maxlength="30">
						</td>
						<td>
							<select name="lingua">
CODICE;
	for($i=0; $i<sizeof($arrayLingue) ; $i++)
		if($arrayLingue[$i] != DEFAULT_LANG)
			echo <<<CODICE
							
								<option value="$arrayLingue[$i]">{$arrayTooltip[$arrayLingue[$i]]}</option>
CODICE;
		else
			echo <<<CODICE
							
								<option value="$arrayLingue[$i]" selected>{$arrayTooltip[$arrayLingue[$i]]}</option>
CODICE;
echo <<<CODICE
							
							</select>
						</td>
						<td>
							<select name="tipo">
								<option value="SING" selected>singola</option>
								<option value="MULT">composta</option>
							</select>
						</td>
					</tr>
				</table>
			<form action="./esitoModifiche.php" method="post" id="formDB">
					<p class="hiddenP"><input type="hidden" name="actions" value=""></p>
					<p class="hiddenP"><input type="hidden" name="words" value=""></p>
					<p class="hiddenP"><input type="hidden" name="langs" value=""></p>
					<p class="hiddenP"><input type="hidden" name="types" value=""></p>
				<div id="divComandi">
					<a class="buttons" href="#" onclick="controllaSubmit();">invia</a>
					<a class="buttons" href="./mostra.php">mostra</a>
					<a class="buttons" href="./index.php">esci</a>
				</div>
			</form>
CODICE;
}

// username o password errate
else
{
	include "./PHP/crea.php";
	creaIntestazione(false,"setLogo();","U");
	visualizzaSchermataErrore();
}
?>

		</div>
	</body>
</html>