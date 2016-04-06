<?php
// direttive include
include "selezioneLingua.php";

// funzioni di utilità
function paginaRichiedente()
{
	$pagina=explode("/",$_SERVER["REQUEST_URI"]);
	$pagina=$pagina[sizeof($pagina)-1];
	$pagina=explode(".php",$pagina);
	return $pagina[0];
}

// funzione creaIntestazione: viene utilizzata in ogni pagina.
// Crea la struttura generale della pagina in maniera dinamica,permettendo di eliminare le ridondanze dovute
// a codice condiviso ripetuto. Permette di settare la lingua mediante la variabile globale $lingua,impostare l'evento
// 'onLoad' e decidere se abilitare o meno la selezione delle altre lingue disponibili,tramite $switchLingua.
// Infine il parametro $livello stabilisce se trattasi di pagina utente o amministratore; solo nel caso in cui
// sia $livello=="U", viene incluso un ulteriore file CSS per la presentazione delle pagine all'utente.
function creaIntestazione($switchLingua,$onLoad,$livello = "")
{	
	global $arrayLingue,$arrayTooltip,$intestazione,$queryString,$lingua;
	$url = paginaRichiedente();
	echo <<<CODICE
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<html lang="$lingua">
	<head>
		<title>Impiccato</title>
		<link rel="shortcut icon" href= "./img/favicon.ico">
		<link rel="stylesheet" href="./CSS/base.css" type="text/css">
		<link rel="stylesheet" href="./CSS/$url.css" type="text/css">
CODICE;
	if($livello == "U")
		echo <<<CODICE
		
		<link rel="stylesheet" href="./CSS/user.css" type="text/css">	
CODICE;
	if($url=="index")
		echo <<<CODICE
		
		<meta name="keywords" lang="$lingua" content="{$intestazione["content"]}">
CODICE;
	echo <<<CODICE
	
		<meta name="author" content="Pietro De Rosa">
		<meta http-equiv="Content-Type" content ="text/html; charset=iso-8859-1">
		<meta http-equiv="Content-Script-Type" content="text/JavaScript">
		<script type="text/javascript" src="./JS/base.js"></script>
CODICE;
	if($url!="gioca")
		echo <<<CODICE
		
		<script type="text/javascript" src="./JS/$url.js"></script>
CODICE;
	else
		echo <<<CODICE
		
		<script type="text/javascript" src="./JS/giocaJS.php$queryString"></script>
CODICE;
	echo <<<CODICE
	
	</head>
				
	<body onload="$onLoad">
		<div id="divIntestazione">
CODICE;

// eventuale generazione dello span contenente le img di tutte le altre lingue selezionabili
	if($switchLingua)
	{
		echo <<<CODICE
		
			<span id="spanLang">
CODICE;
		for($j=0;$j<sizeof($arrayLingue);$j++)
			if($arrayLingue[$j] != $lingua)
			{
				echo <<<CODICE
		
				<a href="?lang=$arrayLingue[$j]" title="{$arrayTooltip[$arrayLingue[$j]]}"><img class="imgLang" src="./img/$arrayLingue[$j].png" alt="$arrayLingue[$j].png"></a>
CODICE;
			}
		echo <<<CODICE
		
			</span>
CODICE;
	}
// fine generazione span

		echo <<<CODICE
		
			<img id="imgLogo" src="./img/logoA.png" alt="Logo.png">
		</div>
		
		<div id="divLavagna">
CODICE;

/*	Va aggiunto in fondo ad ogni pagina:
		</div>
	</body>
</html> */
}

// funzione visualizzaSchermataErrore:
// 	stampa un messaggio di errore e viene utilizzata  
//	nel caso in cui la sessione non sia settata.
function visualizzaSchermataErrore()
{
	global $paginaErrore,$lingua;
	echo <<<CODICE
	
			<h1>{$paginaErrore['titolo']}</h1>
			<p id="pErrore">{$paginaErrore['parErrore']}</p>
			<p class="pBottone"><a href="./admin.php?lang=$lingua">{$paginaErrore['cmdRiprova']}</a></p>
			<p class="pBottone"><a href="./index.php?lang=$lingua">{$paginaErrore['cmdHome']}</a></p>
CODICE;
}
?>