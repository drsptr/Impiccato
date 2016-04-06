function controllaSubmit(idForm)
{
	var form = document.getElementById(idForm);
	if(stringaAlfanumerica(form.elements[0].value) && stringaAlfanumerica(form.elements[1].value))
		form.submit();
}