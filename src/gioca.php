<?php
session_start();
unset($_SESSION['id']);
// direttive include
include "./PHP/crea.php";

creaIntestazione(false,"start();","U");
echo <<<CODICE

			<h1>{$paginaGioca["titolo"]}</h1>
			<div>
				<p id="pContenutoParola">&nbsp;</p>
				<p><img id="imgMovimenti" src="./img/move0.png" alt="Move.png"></p>
				<p id="pContenutoOpt">
						<span class="spanContenutoEsterno">{$paginaGioca["titoloTempo"]}<span id="spanTempo">&nbsp;</span></span>
						<span class="spanContenutoEsterno">{$paginaGioca["titoloTentativi"]}<span id="spanTentativi">&nbsp;</span></span>
				</p>
				<p id="pLettere">
CODICE;
				for($i=0,$lettera="A" ; $i<26 ; $i++,$lettera++)
					echo <<<CODICE
						
						<span><a id="id$lettera" href="#" onclick="">$lettera</a></span>
CODICE;
echo <<<CODICE
				
				</p>
				<p  id="cmdIndietro" class="pBottone"><a href="./impostazioni.php?lang=$lingua">{$paginaGioca["cmdIndietro"]}</a></p>
				<p id="msgFinale">
					<span id="msgFinaleRisultato">&nbsp;</span>
					<span>{$paginaGioca["msgRigioca"]}</span>
					<span>
						<a href="#" onclick="start();">{$paginaGioca["msgPos"]}</a>
						<a href="./index.php?lang=$lingua">{$paginaGioca["msgNeg"]}</a>
					</span>
				</p>
			</div>
CODICE;
?>

		</div>
	</body>
</html>