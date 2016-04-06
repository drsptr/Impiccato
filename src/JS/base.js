// Gestione immagine logo
function setLogo()
{
	var interval=setInterval("changeImg('imgLogo','./img/logoA.png','./img/logoB.png')",800);
}

function changeImg(id,src1,src2)
{
	var img = document.getElementById(id);
	if(img.src.search(src1)!=-1)
		img.src=src2;
	else
		img.src=src1;
}


// Gestione elementi con DOM
function changeStyleById(nodeId,propName,propValue)
{
	var node,command;
	node = document.getElementById(nodeId);
	command = "node.style." + propName + " = " + propValue + ";";
	eval(command);
}

function setChildById(nodeId,childNum,value)
{
	var node,command;
	node = document.getElementById(nodeId);
	command = "node." + childNum + ".nodeValue = '" + value + "';";
	eval(command);
}

function setAttributeById(nodeId,attrName,attrValue)
{
	var node;
	node = document.getElementById(nodeId);
	node.setAttribute(attrName,attrValue);
}



// Funzioni per il controllo delle form
function stringaAlfanumerica(str)
{
	var rxp = /[^a-z0-9]/i;
	return !rxp.test(str);
}

function stringaCaratteri(str)
{
	var rxp = /[^a-z]/i;
	return !rxp.test(str);
}

function stringaCaratteriSpazio(str)
{
	var rxp = /[^a-z\s]/i;
	return !rxp.test(str);
}

function stringaConSpazi(str)
{
	var rxp = /[\s]+/g;
	return rxp.test(str);
}
