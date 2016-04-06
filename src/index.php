<?php
session_start();
unset($_SESSION['id']);
// direttive include
include "./PHP/crea.php";

// generazione codice
creaIntestazione(true,"setLogo();","U");
echo <<<CODICE

			<ul>
				<li>
					<p class="pBottone"><a href="./istruzioni.php$queryString">{$paginaIndex["cmdIstr"]}</a></p>
				</li>
				<li>
					<p class="pBottone"><a href="./admin.php$queryString">{$paginaIndex["cmdAltro"]}</a></p>
				</li>
				<li>
					<p class="pBottone"><a href="./impostazioni.php$queryString">{$paginaIndex["cmdGioca"]}</a></p>
				</li>
			</ul>
CODICE;
?>

		</div>
	</body>
</html>