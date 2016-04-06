<?php
session_start();
unset($_SESSION['id']);
// direttive include
include "./PHP/crea.php";

// generazione codice
creaIntestazione(true,"setLogo();","U");
echo <<<CODICE
							
			<h1>{$paginaIstruzioni["titolo"]}</h1>
			<p id="pIstruzioni">{$paginaIstruzioni["parIstr"]}</p>
			<p  class="pBottone"><a href="./index.php$queryString">{$paginaIstruzioni["cmdIndietro"]}</a></p>
CODICE;
?>

		</div>
	</body>
</html>