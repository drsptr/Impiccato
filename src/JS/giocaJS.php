/* Funzioni di utilita */
function random(maxIndex)
{
	return Math.floor((Math.random() * (maxIndex + 1)));
}

// funzione repeat ripresa dal manuale JavaScript,js_refer1.3.pdf
function repeat(n)
{
	var result = "",str = this.toString();
	while((n--) > 0)
		result += str;
	return result;
}

function replace(position,character)
{
	var temp_str;
	if( position >= this.length || position < 0 )
		return false;
	if( position == 0)
		temp_str = character + this.substr(1);
	else if( position == (this.length - 1))
		temp_str = this.substr(0,this.length - 1) + character;
	else
		temp_str = this.substr(0,position) + character + this.substr(position+1);
	return temp_str;
}

String.prototype.str_rep = repeat;
String.prototype.replaceCharAt = replace;





/* Creazione del 'vocabolario' */
var vocabolario = new Array();
<?php
// settaggio parametri
	$lingua = "";
	$tipo = "";
	$tempo = 0;
	if(isset($_GET["lang"]))
		$lingua = $_GET["lang"];
	if(isset($_GET["word"]))
		$tipo = $_GET["word"];
	if(isset($_GET["time"]))
		$tempo = $_GET["time"];

// direttive include
	include "../PHP/connettiDB.php";
	if(file_exists("../lingue/" . $lingua . ".php"))
		include "../lingue/$lingua.php";
		
$mySqlObj = new MySqlClass(DEFAULT_HOST,DEFAULT_USER,DEFAULT_PASS,DEFAULT_DB);
$mySqlObj->connetti();
$query = "SELECT idparole FROM parole WHERE lingua='$lingua' AND tipo='$tipo'";
$result = $mySqlObj->inviaQuery($query);
// riempimento array
	for($i=0;$row = mysql_fetch_array($result);$i++) { ?>
vocabolario[<?php echo $i ?>] = "<?php echo "{$row['idparole']}";?>";
<?php }$mySqlObj->disconnetti(); ?>





/* Oggetto 'Partita' e suoi metodi */
function Partita(dizionario,timer)
{
	// variabili
		this.dizionario = dizionario;
		this.timer = timer;
		this.tentativi = 6;
		this.indexAttuale = null;
		this.indexPrecedente = null;
		this.temp = null;
		var intervallo = null;
	// metodi
		this.nuova = nuova;
		this.cercaChar = cercaChar;
		this.confrontaRisultato = confrontaRisultato;
		this.tentativiFiniti = tentativiFiniti;
		this.termina = termina;
}

function nuova()
{
	this.tentativi = 6;
	while((this.indexAttuale == null) || (this.indexAttuale == this.indexPrecedente))
		this.indexAttuale = random((this.dizionario.length)-1);
	this.indexPrecedente = this.indexAttuale;
	this.temp = "_".str_rep(this.dizionario[this.indexAttuale].length);
	this.cercaChar(" ");
}

function cercaChar(lettera)
{
	var occorrenze = new Array();
	var i = 0,indice = 0,posizione = 0;
	lettera = lettera.toLowerCase();
	while( (posizione = this.dizionario[this.indexAttuale].indexOf(lettera,indice)) != -1 )
	{	
		occorrenze[i++] = posizione;
		indice = (posizione+1);
	}
	if(occorrenze.length == 0)
	{
		if(lettera != " ") 
			this.tentativi--;
		return false;
	}
	for(var i=0; i < occorrenze.length;i++)
		this.temp = this.temp.replaceCharAt(occorrenze[i],lettera);
	return true;
}

function confrontaRisultato()
{
	return(this.temp == this.dizionario[this.indexAttuale]);
}

function tentativiFiniti()
{
	return(this.tentativi == 0);
}

function termina()
{
	this.temp = this.dizionario[this.indexAttuale];
}





/* Funzioni per la visualizzazione sullo schermo */
function visualizzaCampi()
{
	setChildById("pContenutoParola","firstChild",miaPartita.temp);
	setChildById("spanTentativi","firstChild",miaPartita.tentativi);
}

function start()
{
	var lettera;
	// inizializza i parametri della partita
		miaPartita.nuova();
	// ripristina lo stile delle lettere
		for(i=0; i<26; i++) {
			lettera = String.fromCharCode("A".charCodeAt(0)+i);
			changeStyleById("id" + lettera,"color","''");
			changeStyleById("id" + lettera,"cursor","'pointer'");
			setAttributeById("id" + lettera,"onclick","trova('" + lettera + "');");
		}
	// visualizza la schermata di gioco
		visualizzaCampi();
		setChildById("spanTempo","firstChild",((miaPartita.timer!=0) ? miaPartita.timer : "/"));
		changeStyleById("pLettere","display","'block'");
		changeStyleById("cmdIndietro","display","'block'");
		changeStyleById("msgFinale","display","'none'");
		setAttributeById("imgLogo","src","./img/logoA.png");
		setAttributeById("imgMovimenti","src","./img/move0.png");
	// imposta,se necessario,il timer di gioco
		if(miaPartita.timer != 0)
			miaPartita.intervallo = setInterval("aggiornaTempo();",1000);
}

function stop(messaggio,cambiaImg)
{
	// termina la partita 	
		clearInterval(miaPartita.intervallo);
		miaPartita.termina();
		visualizzaCampi();
	// nasconde la schermata partita e mostra il messaggio finale
		changeStyleById("pLettere","display","'none'");
		changeStyleById("cmdIndietro","display","'none'");
		changeStyleById("msgFinale","display","'block'");
		setChildById("msgFinaleRisultato","firstChild",messaggio);
		if(cambiaImg)
			setAttributeById("imgLogo","src","./img/logoB.png");
}

function trova(lettera)
{
	var idElem = "id" + lettera;
	setAttributeById(idElem,"onclick","");
	changeStyleById(idElem,"cursor","'default'");
	if(miaPartita.cercaChar(lettera))
	{
		changeStyleById(idElem,"color","'lime'");
		if(miaPartita.confrontaRisultato())
		{
			stop("<?php echo "{$paginaGioca["msgVittoria"]}"?>",false);
			return;
		}
	}
	else
	{
		changeStyleById(idElem,"color","'red'");
		setAttributeById("imgMovimenti","src","./img/move" + (6 - miaPartita.tentativi) + ".png");
		if(miaPartita.tentativiFiniti())
		{
			stop("<?php echo "{$paginaGioca["msgSconfitta"]}"?>",true);
			return;
		}
	}
	visualizzaCampi();
}

function aggiornaTempo()
{
	var nodo;
	nodo = document.getElementById("spanTempo");
	if(--(nodo.firstChild.nodeValue) == 0)
		stop("<?php echo "{$paginaGioca["msgSconfitta"]}"?>",true);
}





/* Istanza di Partita */
var miaPartita = new Partita(vocabolario,<?php echo ($tempo>0)? $tempo : 0; ?>);