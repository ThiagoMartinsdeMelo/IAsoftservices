/*
** Máscaras para os formulários de cadastro
*/

$("#telefone").mask("(00) 0000-00009", {placeholder: "(__) _____-____"});

$("#datepicker-abertura").mask("99/99/9999", {placeholder: "__/__/____"});

$("#datepicker-fechamento").mask("99/99/9999", {placeholder: "__/__/____"});


/*
** Datepicker para o cadastro das OS's
*/
$('#datepicker-abertura').datepicker({
	format: 'dd/mm/yyyy',
	language: 'pt-BR',	
	todayHighlight: true
 });

$('#datepicker-fechamento').datepicker({
	format: 'dd/mm/yyyy',
	language: 'pt-BR',	
	todayHighlight: true
 });