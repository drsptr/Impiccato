<?php
// variabili utilizzate a livello globale
define("DEFAULT_LANG","IT");
$arrayLingue = array("IT","EN");
$arrayTooltip = array("IT" => "Italiano","EN" => "English");

// settaggio parametri
$lingua = DEFAULT_LANG;
$queryString = "";
if(isset($_GET["lang"]) && in_array($_GET["lang"],$arrayLingue))
{
	$lingua = $_GET["lang"];
	$queryString = "?" . $_SERVER["QUERY_STRING"];
}
// la query string viene modificata in
// modo da risultare corretta in HTML
$queryString = str_replace("&","&amp;",$queryString);

// inclusione del file php contenente tutte le 
// variabili per la determinata lingua selezionata
include "./lingue/$lingua.php";
?>