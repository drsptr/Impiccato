<?php
session_start();
unset($_SESSION['id']);
// direttive include
include "./PHP/crea.php";

// generazione codice
creaIntestazione(true,"setLogo();","U");
echo <<<CODICE

			<h1>{$paginaImpostazioni["titolo"]}</h1>
			<p id="pImpostazioni">{$paginaImpostazioni["parImposta"]}
			</p>
			<form action="./gioca.php" method="get" id="formImpostazioni">
				<p id="pInputTempo">	
					<label class="spanNomeOpt" for="time">{$paginaImpostazioni["nomeOptTempo"]}</label>
					<span class="spanOpt"><input type="radio" name="time" value="0" id="time" checked>{$paginaImpostazioni["optTempo1"]}</span>
					<span class="spanOpt"><input type="radio" name="time" value="60">{$paginaImpostazioni["optTempo2"]}</span>
					<span class="spanOpt"><input type="radio" name="time" value="30">{$paginaImpostazioni["optTempo3"]}</span>
				</p>
				<p id="pInputParola">
					<label class="spanNomeOpt" for="word">{$paginaImpostazioni["nomeOptParola"]}</label>
					<span class="spanOpt"><input type="radio" name="word" value="SING" id="word" checked>{$paginaImpostazioni["optParola1"]}</span>
					<span class="spanOpt"><input type="radio" name="word" value="MULT">{$paginaImpostazioni["optParola2"]}</span>
				</p>
				<p><input type="hidden" name="lang" value="$lingua"></p>
				<p id="pLingua">
					<span class="spanNomeOpt">{$paginaImpostazioni["nomeOptLang"]}</span>
					<span class="spanOpt">{$paginaImpostazioni["optLang"]}</span>
				</p>

					<p class="pBottone"><a href="#" onclick="document.getElementById('formImpostazioni').submit();">{$paginaImpostazioni["cmdInizia"]}</a></p>
					<p class="pBottone"><a href="./index.php$queryString">{$paginaImpostazioni["cmdIndietro"]}</a></p>
			</form>
					
CODICE;
?>

		</div>
	</body>
</html>