<?php
session_start();
unset($_SESSION['id']);
// direttive include
include "./PHP/crea.php";

// generazione codice
creaIntestazione(true,"setLogo();","U");
echo <<<CODICE

			<h1>{$paginaAdmin["titolo"]}</h1>
			<p id="pDescrizione">{$paginaAdmin["parAdmin"]}</p>
			<div id="divForm">
				<form action="./modifica.php" method="post" id="formAdmin">
					<p>
						<label for="inputUser">username:</label>
						<input type="text" name="user" value="admin" maxlength="15" id="inputUser">
					</p>
					<p>
						<label for="inputPass">password:</label>
						<input type="password" name="pass" value="admin" maxlength="15" id="inputPass">
					</p>
					<p class="hiddenP"><input type="hidden" name="lang" value="$lingua"></p>
					<p class="pBottone"><a href="#" onclick="controllaSubmit('formAdmin');">{$paginaAdmin["cmdAccedi"]}</a></p>
					<p class="pBottone"><a href="./index.php$queryString">{$paginaAdmin["cmdIndietro"]}</a></p>
				</form>
			</div>
CODICE;
?>

		</div>
	</body>
</html>