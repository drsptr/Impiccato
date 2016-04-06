function aggiungiRiga()
{
	var tabella = document.getElementById("tabella");
	var riga = tabella.getElementsByTagName("tr")[1];
	var nuovaRiga = riga.cloneNode(true);
	nuovaRiga.getElementsByTagName("input")[0].value = "";
	nuovaRiga.getElementsByTagName("input")[0].style.backgroundColor = "";
	tabella.appendChild(nuovaRiga);
}

function eliminaRiga()
{
	var tabella = document.getElementById("tabella");
	var numRighe = tabella.getElementsByTagName("tr").length;
	if( numRighe > 2)
		tabella.removeChild(tabella.lastChild);
	else
		alert("Impossibile rimuovere un'altra riga!");
}

function controllaSubmit()
{
	var actions = "",words = "",langs = "",types = "";
	var tabella = document.getElementById("tabella");
	var riga = tabella.getElementsByTagName("tr");
	var selects,input,stato = true;
	for(i=1; i<riga.length; i++)
	{
		input = riga[i].getElementsByTagName("input");
		selects = riga[i].getElementsByTagName("select");
		// collassa eventuali spazi presenti in cima ed in fondo
		input[0].value = input[0].value.replace(/^\s*/,"");
		input[0].value = input[0].value.replace(/\s*$/,"");
		if(	((stringaConSpazi(input[0].value) && selects[2].value == "SING"))   ||
			(stringaCaratteri(input[0].value) && selects[2].value == "MULT")   ||
			!stringaCaratteriSpazio(input[0].value)   ||      
			input[0].value == "" )
		{
			input[0].style.backgroundColor = "red";
			stato = false;
		}
		else
			input[0].style.backgroundColor = "";
		actions += selects[0].value + ";";
		words += input[0].value + ";";
		langs += selects[1].value + ";";
		types += selects[2].value + ";";
	}
	if(stato)
	{	
		var form = document.getElementById("formDB");
		var input = form.getElementsByTagName("input");
		input[0].value = actions;
		input[1].value = words;
		input[2].value = langs;
		input[3].value = types;
		form.submit();
	}
}