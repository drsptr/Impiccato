<?php
// variabili interne alle singole pagine
$istruzioni = "Il gioco dell'impiccato consiste nell'indovinare una parola scelta in maniera casuale.
				Il giocatore deve selezionare i seguenti parametri: tipologia della parola (semplice o composta), limite di tempo e lingua.
				La parola viene composta selezionando le lettere dall'alfabeto: se la lettera &egrave; presente viene evidenziata in verde,in caso
				contrario in rosso.	Si ha a disposizione un massimo di 6 tentativi, superati i quali il gioco ha termine. La sezione
				 &quot;Amministratore&quot;, ad uso esclusivo del gestore del sito, permette invece di modificare il database aggiungendo o rimuovendo 
				 le parole.";
				 
$impostazioni = <<<MESSAGGIO
					Scegli le impostazioni che preferisci e poi premi sul pulsante
					<span class="pImpostazioniPulsanti"> &quot;inizia&quot; </span>per giocare o su 
					<span class="pImpostazioniPulsanti"> &quot;indietro&quot; </span>per tornare alla 
					pagina iniziale.
MESSAGGIO;

$admin = "Questa sezione,riservata all'amministratore del sito, permette di apportare modifiche al database 
			aggiungendo o rimuovendo parole.";

$errore = "Spiacente, si &egrave; verificato un errore! Controlla di aver inserito correttamente username e password.";
			
// variabili contenenti tutti i messaggi di ogni singola pagina
$intestazione	= 	array(	"content" => "impiccato,gioco"	);
						
$paginaIndex 	= 	array(	"cmdIstr" => "Istruzioni",
							"cmdAltro" => "Amministratore",
							"cmdGioca" => "Gioca"			);							
							
$paginaIstruzioni =	array(	"titolo" => "Istruzioni",
							"parIstr" => $istruzioni,
							"cmdIndietro" => "indietro"	);

$paginaImpostazioni = array(	"titolo" => "Impostazioni",
								"parImposta" => $impostazioni,
								"cmdIndietro" => "indietro",
								"cmdInizia" => "inizia",
								"nomeOptTempo" => "Limite di Tempo:",
								"optTempo1" => "nessuno",
								"optTempo2" => "1 minuto",
								"optTempo3" => "30 secondi",
								"nomeOptParola" => "Tipo Parola:",
								"optParola1" => "singola",
								"optParola2" => "composta",
								"nomeOptLang" => "Lingua:",
								"optLang" => "Italiano"					);
								
$paginaGioca = array(	"titolo" => "Il Gioco",
						"titoloTempo" => "tempo rimanente: ",
						"titoloTentativi" => "tentativi disponibili: ",
						"cmdIndietro" => "indietro",						
						"msgVittoria" => "Hai vinto! :)",
						"msgSconfitta" => "Hai perso! :(",
						"msgRigioca" => "Un'altra partita?",
						"msgPos" => "Si",
						"msgNeg" => "No"								);
					
$paginaAdmin = array(	"titolo" => "Amministratore",
						"parAdmin" => $admin,
						"cmdAccedi" => "accedi",
						"cmdIndietro" => "indietro"		);
						
$paginaErrore = array(	"titolo" => "Errore",
						"parErrore" => $errore,
						"cmdRiprova" => "riprova",
						"cmdHome" => "pagina iniziale");
?>