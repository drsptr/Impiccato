<?php
// variabili interne alle singole pagine
$istruzioni =  "The game of hangman consists in guessing a random word.
				The player has to select the following options: word type (simple or composed), time limit and language.
				The word is composed selecting letters from the alphabet: if the letter is present it will be highlight with a green 
				colour, otherwise with a red one. At most the player can make 6 attempts, after which the game is over.
				 The &quot;Administrator&quot; section, which is reserved to site's webmaster, permits to modify the database adding 
				 or removing words.";

$impostazioni = <<<MESSAGGIO
					Chose the settings you prefer and then press on the
					<span class="pImpostazioniPulsanti"> &quot;start&quot; </span> button for
					playing or on <span class="pImpostazioniPulsanti"> &quot;back&quot; </span>
					button for going back to the homepage.
MESSAGGIO;

$admin = "This section,reserved only for site's administrator, allows to update the database 
			adding or removing words.";

$errore = "Sorry, an error is occurred! You have to control your username and password.";

// variabili contenenti tutti i messaggi di ogni singola pagina
$intestazione	= 	array(	"content" => "hangman,game"	);
						
$paginaIndex 	= 	array(	"cmdIstr" => "Instructions",
							"cmdAltro" => "Administrator",
							"cmdGioca" => "Play"			);							
							
$paginaIstruzioni =	array(	"titolo" => "Instructions",
							"parIstr" => $istruzioni,
							"cmdIndietro" => "back"		);

$paginaImpostazioni = array(	"titolo" => "Settings",
								"parImposta" => $impostazioni,
								"cmdIndietro" => "back",
								"cmdInizia" => "start",
								"nomeOptTempo" => "Time Limit:",
								"optTempo1" => "none",
								"optTempo2" => "1 minute",
								"optTempo3" => "30 seconds",
								"nomeOptParola" => "Word type:",
								"optParola1" => "single",
								"optParola2" => "composed",
								"nomeOptLang" => "Language:",
								"optLang" => "English"			);
								
$paginaGioca = array(	"titolo" => "The Game",
						"titoloTempo" => "remaining time: ",
						"titoloTentativi" => "available attemps: ",
						"cmdIndietro" => "back",
						"msgVittoria" => "You win! :)",
						"msgSconfitta" => "You loose! :(",
						"msgRigioca" => "Play again?",
						"msgPos" => "Yes",
						"msgNeg" => "No"								);
						
$paginaAdmin = array(	"titolo" => "Administrator",
						"parAdmin" => $admin,
						"cmdAccedi" => "login",
						"cmdIndietro" => "back"		);
						
$paginaErrore = array(	"titolo" => "Error",
						"parErrore" => $errore,
						"cmdRiprova" => "try again",
						"cmdHome" => "homepage");
?>