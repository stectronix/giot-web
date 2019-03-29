$(document).ready(function(){

	// $.validator.addMethod('validarNombre',function(value, element){
	// 	return this.optional(element) || /[a-zA-ZñÑ\s]{2,20}+$/i.test(value);
	// }, 'NOMBRE solo puede contener letras y espacios, de 2 a 20 caracteres');

	// $.validator.addMethod('validarApellido',function(value, element){
	// 	return this.optional(element) || /[a-zA-ZñÑ\s]{2,20}+$/i.test(value);
	// }, 'APELLIDO solo puede contener letras y espacios, de 2 a 20 caracteres');

	// $.validator.addMethod('validarUsuario',function(value, element){
	// 	return this.optional(element) || /[a-zA-ZñÑ][\w]{2,20}+$/i.test(value);
	// }, 'USUARIO puede contener letras, números y guion bajos, de 2 a 20 caracteres');

	// $.validator.addMethod('validarEmail',function(value, element){
	// 	return this.optional(element) || /[a-zñÑ]+[\w-\.]{2,}@([\w-]{2,}\.)+[\w-]{2,4}$/i.test(value);
	// }, 'EMAIL debe tener un formato válido, con un maximo de 30 caracteres');

	$("#formulario-registro").validate({
		rules:{
			nombre:{
				required: true,
				validarNombre: true
			},
			apellido:{
				required: true,
				validarApellido: true
			},
			usuario:{
				required: true,
				validarUsuario: true
			},
			email:{
				required: true,
				validarEmail: true
			},
			clave:{
				required: true
			},
			clave2:{
				required: true,
				equalTo: "#clave"
			},
			terminos:{
				required: true
			}
		},
		messages:{
			nombre:{
				required: 'NOMBRE es un campo requerido.',
			},
			apellido:{
				required: 'APELLIDO es un campo requerido.'
			},
			usuario:{
				required: 'USUARIO es un campo requerido.'
			},
			email:{
				required: 'E-MAIL es un campo requerido.',
			},
			clave:{
				required: 'CONTRASEÑA es un campo requerido.'
			},
			clave2:{
				required: 'CONTRASEÑA es un campo requerido.',
				equalTo: "CONTRASEÑAS no coinciden"
			},
			terminos:{
				required: 'TERMINOS Y CONDICIONES es un campo requerido.'
			}
		}
	});
});