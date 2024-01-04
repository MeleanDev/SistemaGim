function validaRut(campo){

	if ( campo.length == 0 ){ return false; }

	if ( campo.length < 8 ){ return false; }



	campo = campo.replace('-','')

	campo = campo.replace(/\./g,'')



	var suma = 0;

	var caracteres = "1234567890kK";

	var contador = 0;    

	for (var i=0; i < campo.length; i++){

		u = campo.substring(i, i + 1);

		if (caracteres.indexOf(u) != -1)

		contador ++;

	}

	if ( contador==0 ) { return false }

	

	var rut = campo.substring(0,campo.length-1)

	var drut = campo.substring( campo.length-1 )

	var dvr = '0';

	var mul = 2;

	

	for (i= rut.length -1 ; i >= 0; i--) {

		suma = suma + rut.charAt(i) * mul

                if (mul == 7) 	mul = 2

		        else	mul++

	}

	res = suma % 11

	if (res==1)		dvr = 'k'

                else if (res==0) dvr = '0'

	else {

		dvi = 11-res

		dvr = dvi + ""

	}

	if ( dvr != drut.toLowerCase() ) { return false; }

	else { return true; }

}



/* La siguiente instrucción extiende las capacidades de jquery.validate() para que

	admita el método RUT, por ejemplo:



$('form').validate({

	rules : { rut : { required:true, rut:true} } ,

	messages : { rut : { required:'Escriba el rut', rut:'Revise que esté bien escrito'} }

})

// Nota: el meesage:rut sobrescribe la definición del mensaje de más abajo

*/

// comentar si jquery.Validate no se está usando

function cargar_validaciones_custom(){

	jQuery.validator.addMethod("rut", function(value, element) { 
			return this.optional(element) || validaRut(value); 
	}, "Revise el RUT");

    jQuery.validator.addMethod("validDate", function(value, element) {
        return this.optional(element) || /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/.test(value);
    }, "Ingrese una fecha válida en el formato DD/MM/YYYY");

	$.validator.addMethod("selectize", function(value, element) {
        return this.optional(element) || $(element)[0].selectize.getValue() !== "";
    }, "Por favor, seleccione una opción de la lista.");

	// Agrega la regla de validación para el tamaño de archivo
	$.validator.addMethod('filesize', function(value, element, param) {
		return this.optional(element) || (element.files[0].size <= param)
	}, 'El tamaño del archivo no puede ser mayor a {0} bytes');
}

