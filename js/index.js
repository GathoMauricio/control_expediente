$(document).ready(init);
function init()
{
	$(".contenedor").click(function(){ $(".busqueda").css('display','none'); }); //desparece items de busqueda al tocar el contenedor
	$(".menu").click(function(){ $(".busqueda").css('display','none'); }); //desparece items de busqueda al tocar el menu
	$(".buzon").click(function(){ $(".busqueda").css('display','none'); }); //desparece items de busqueda al tocar el buzon
	$('.close').click(function(){
		close_box();
	});
 
	$('.backdrop').click(function(){
		close_box();
	});

	cargarNumBuzon();
}
function buscarExpediente(value)
{
	if(value.length<=0)$(".busqueda").css('display','none'); //desparece items de busqueda si ya no hay nada escrito en el input de busqueda
	else{
		$.post("control/ctrl_expediente.php?e=buscarExpediente",{value:value},function(data){
			$(".busqueda").html(data);
			$(".busqueda").css('display','inline');
		});
	}
}
function cerrarSesion()
{
	swal({
	  title: "Aviso",
	  text: "Está apunto de salir del sistema",
	  showCancelButton: true,
	  confirmButtonClass: "btn-primary",
	  confirmButtonText: "Salir",
	  cancelButtonText:"Cancelar",
	  closeOnConfirm: true
	},
	function(){
	  window.location='control/ctrl_usuario.php?e=cerrarSesion';
	});
}
function inicio()
{
	$("#contenedor").html('<center><img src="img/fondo.jpg" width:80%;></center>');
}
function nuevoExpediente()
{
	$.post('includes/nuevo_expediente.php',{},function(data){ $("#contenedor").html(data); });
}
function catalogo()
{
	$.post('includes/catalogo.php',{},function(data){ $("#contenedor").html(data); });
}
function exportar()
{
	window.open("control/lista_excel.php");
}
function ajustes()
{
	$.post('includes/ajustes.php',{},function(data){ $("#contenedor").html(data); });
}
function informacionGral(id_expediente)
{
	$.post('includes/informacion_gral.php',{id_expediente:id_expediente},function(data){ $("#contenedor").html(data); });
}
function informacionGralPase(id_expediente)
{
	$.post('includes/informacion_gral.php',{id_expediente:id_expediente},function(data){ 
		$("#contenedor").html(data); 
		window.location ="#id_pase";
	});
}
function historiaClinica (id_expediente)
{
	$.post('includes/historia_clinica.php',{id_expediente:id_expediente},function(data){ $("#contenedor").html(data); });
}
function consultas (id_expediente)
{
	$.post('includes/consultas.php',{id_expediente:id_expediente},function(data){ $("#contenedor").html(data); });
}
function infoConsulta(id_consulta){
	$.post('includes/info_consulta.php',{id_consulta:id_consulta},function(data){ $("#contenedor").html(data); });
}
function eliminarConsulta(id_paciente,id_consulta)
{
	swal({
	  title: "Aviso",
	  text: "¿Realmente desea eliminar la consulta?",
	  showCancelButton: true,
	  confirmButtonClass: "btn-warning",
	  confirmButtonText: "Eliminar",
	  cancelButtonText:"Cancelar",
	  closeOnConfirm: true
	},
	function(){
	  $.post('control/ctrl_consulta.php?e=eliminarConsulta',{id_consulta:id_consulta},function(data){ 
	  	swal('Aviso',data);
	  	consultas(id_paciente);
	 });
	});	
}
function archivos(id_expediente)
{
	$.post('includes/archivos.php',{id_expediente:id_expediente},function(data){ $("#contenedor").html(data); });
}
function iniciarConsulta(id_expediente)
{
	$.post('control/ctrl_expediente.php?e=validarPase',{id_expediente:id_expediente},function(data){
		console.log(data);
		var json = JSON.parse(data);
		console.log(json.total+"  "+json.pase);
		if(parseInt(json.pase) > 0)
		{
			$.post('includes/consulta.php?id_expediente='+id_expediente,{},function(data){ 
				removerBuzon(id_expediente);
				$("#contenedor").html(data); 
			});
		}else{
			swal({
			  html:true,
			  title: "Aviso",
			  text: "Precaución: revisar total de pases permitido<br>¿Desea editar la información de este expediente?",
			  showCancelButton: true,
			  confirmButtonClass: "btn-primary",
			  confirmButtonText: "Editar",
			  cancelButtonText:"Cancelar",
			  closeOnConfirm: true
			},
			function(){
				informacionGralPase(id_expediente);
			});	
		}
	});	
}

function cargarNumBuzon()
{
	$.post('control/ctrl_expediente.php?e=cargarNumBuzon',{},function(data){ 
		if(document.title!='Acceso')
		document.title= data+"Control expedientes";
	});
}

function cargarBuzon(){
	$.post('control/ctrl_expediente.php?e=cargarBuzon',{},function(data){ 
		$("#buzon").html(data); 
		cargarNumBuzon();
	});
}

function validarPase(id_expediente)
{
	$.post('control/ctrl_expediente.php?e=validarPase',{id_expediente:id_expediente},function(data){
		console.log(data);
		var json = JSON.parse(data);
		console.log(json.total+"  "+json.pase);
		if(parseInt(json.pase) > 0)
		{
			return 1;
		}else{
			return 0;
		}
	});
}
function agregarBuzon(insert_id)
{
	$.post('control/ctrl_expediente.php?e=validarPase',{id_expediente:insert_id},function(data){
		console.log(data);
		var json = JSON.parse(data);
		console.log(json.total+"  "+json.pase);
		if(parseInt(json.pase) > 0)
		{
			$.post('control/ctrl_expediente.php?e=agregarBuzon',{insert_id:insert_id},function(data){ 
			swal('','Expediente agregado...');
			cargarBuzon();
			});
		}else{
			swal({
			  html:true,
			  title: "Aviso",
			  text: "Precaución: revisar total de pases permitido<br>¿Desea editar la información de este expediente?",
			  showCancelButton: true,
			  confirmButtonClass: "btn-primary",
			  confirmButtonText: "Editar",
			  cancelButtonText:"Cancelar",
			  closeOnConfirm: true
			},
			function(){
				informacionGralPase(insert_id);
			});	
		}
	});	
} 
function removerBuzon(id_expediente)
{
	
	$.post('control/ctrl_expediente.php?e=removerBuzon',{id_expediente:id_expediente},function(data){ 
	  	//swal('Aviso',data);
		cargarBuzon();
	 });
	/*swal({
	  title: "Aviso",
	  text: "¿Remover del buzón sí se encuentra en espera?",
	  showCancelButton: true,
	  confirmButtonClass: "btn-primary",
	  confirmButtonText: "Remover",
	  cancelButtonText:"Cancelar",
	  closeOnConfirm: true
	},
	function(){
	  $.post('control/ctrl_expediente.php?e=removerBuzon',{id_expediente:id_expediente},function(data){ 
	  	swal('Aviso',data);
		cargarBuzon();
	 });
	});	*/
}
function abrirExpediente(id_expediente)
{
	$("#id_expediente").prop('value',id_expediente);
	$.post('includes/expediente.php?id_expediente='+id_expediente,{},function(data){ $("#contenedor").html(data); $(".busqueda").css('display','none');});
}

function eliminarArchivo(id_archivo,id_expediente)
{
    swal({
	  title: "Aviso",
	  text: "¿Eliminar archivo?",
	  showCancelButton: true,
	  confirmButtonClass: "btn-primary",
	  confirmButtonText: "Remover",
	  cancelButtonText:"Cancelar",
	  closeOnConfirm: true
	},
	function(){
	  window.location="control/ctrl_archivo.php?e=eliminarArchivo&id_archivo="+id_archivo+"&id_expediente="+id_expediente;
	});	
}
function eliminarExpediente(id_expediente)
{
  	swal({
  	  html:true,
	  title: "Aviso",
	  text: "¿Eliminar expediente?<br>Este cambio ya no se podrá deshacer!!!",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Eliminar",
	  cancelButtonText:"Cancelar",
	  closeOnConfirm: true
	},
	function(){
	  $.post('control/ctrl_expediente.php?e=eliminarExpediente',{id_expediente:id_expediente},function(data){ 
      		inicio();
      		swal('Aviso',data);
      		window.open("control/conexion.php?e=exportarBD");
      		window.open("control/lista_excel.php");
    	})
	});
    
  
}
function abrirReproductor(tipo,title,url){
	$("#title_ligth_box").text(title);
	switch(tipo)
	{
		case '1': 
			$("#title_ligth_box").text(title);
			$("#content_ligth_box").html('<img src="'+url+'" style="width:100%;border-radius:5px;" height="300">');

			$('.backdrop, .box').animate({'opacity':'.50'}, 300, 'linear');
			$('.box').animate({'opacity':'1.00'}, 300, 'linear');
			$('.backdrop, .box').css('display', 'block');
		break;
		case '2': 
			$.post('includes/reproductor.php',{},function(data){ 
				$("#content_ligth_box").html(data);
				$("#jquery_jplayer_1").jPlayer({
				ready: function (event) {
					$(this).jPlayer("setMedia", {
						title: title,
						artist: "Sistema de control de expedientes médicos",
						//webmv:'archivos/brillas.mp4',//ruta del video
						webmv:url,//ruta del video
						poster:'img/fondo.jpg'//imagen de portada del video
					});
				},
				swfPath: "js",
				supplied: "webmv, ogv ,m4a, oga, mp3, mp4",
				//supplied: "m4a, oga",
				size: {
					width: "100%",
					height: "220px",
					cssClass: "jp-video-300p"
				},
				wmode: "window",
				useStateClassSkin: true,
				autoBlur: false,
				smoothPlayBar: true,
				keyEnabled: true,
				remainingDuration: true,
				toggleDuration: true
			});

			});
		break;
		case '3': 
			$.post('includes/reproductor.php',{},function(data){ 
				$("#content_ligth_box").html(data);
				$("#jquery_jplayer_1").jPlayer({
				ready: function (event) {
					$(this).jPlayer("setMedia", {
						title: title,
						artist: "Sistema de control de expedientes médicos",
						//m4a:'archivos/cali-wma.wma',//ruta del video
						m4a:url,//ruta del video
						poster:'img/fondo.jpg'//imagen de portada del video
					});
				},
				swfPath: "js",
				supplied: "m4a, oga",
				size: {
					width: "100%",
					height:'225px'
				},
				wmode: "window",
				useStateClassSkin: true,
				autoBlur: false,
				smoothPlayBar: true,
				keyEnabled: true,
				remainingDuration: true,
				toggleDuration: true
			});

			});

		break;
	}
	$('.backdrop, .box').animate({'opacity':'.50'}, 300, 'linear');
	$('.box').animate({'opacity':'1.00'}, 300, 'linear');
	$('.backdrop, .box').css('display', 'block');
}
function close_box()
{
	$('.backdrop, .box').animate({'opacity':'0'}, 300, 'linear', function(){
	$('.backdrop, .box').css('display', 'none');
	});
	$("#jquery_jplayer_1").html('');
}
function isImagen(extension)
{
    if(
    	extension.toLowerCase()=='jpg' || 
    	extension.toLowerCase()=='jpeg' || 
    	extension.toLowerCase()=='png' || 
    	extension.toLowerCase()=='gif'
    ) 
    {
    	return true;
    }else{
    	return false;
    }
}
function isVideo(extension)
{
    if(extension.toLowerCase()=='mp4' || 
    	extension.toLowerCase()=='webm' || 
    	extension.toLowerCase()=='flv' ||
    	extension.toLowerCase()=='m4v' || 
    	extension.toLowerCase()=='ogv' 
    ) 
    {
    	return true;
    }else{
    	return false;
    }
}
function isAudio(extension)
{
    if(extension.toLowerCase()=='mp3' || 
    	extension.toLowerCase()=='oga' || 
    	extension.toLowerCase()=='vaw' || 
    	extension.toLowerCase()=='m4a'
    ) 
    {
    	return true;
    }else{
    	return false;
    }
}
function isPdf(extension)
{
    if(extension.toLowerCase()=='pdf') 
    {
    	return true;
    }else{
    	return false;
    }
}
function calcularEdad(value)
{
	var edad = $("#txt_edad_generar");
	$.post('control/ctrl_expediente.php?e=CalcularEdad',{value:value},function(data){
		edad.prop('value',data);
	});
	setTimeout(function(){ calcularRfcCurp(); },500);
	
}
function calcularRfcCurp()
{
	
	var fecha_paci = $("#cbo_fecha_nacimiento").prop('value');
	var nombre_paci = $("#txt_nombre_paci").prop('value');
	var paterno_paci = $("#txt_paterno_paci").prop('value');
	var materno_paci = $("#txt_materno_paci").prop('value');
	console.log(fecha_paci+" "+nombre_paci+" "+paterno_paci+" "+materno_paci);
	$.post('control/ctrl_expediente.php?e=calcularRfc',{
		fecha_paci:fecha_paci,
		nombre_paci:nombre_paci,
		paterno_paci:paterno_paci,
		materno_paci:materno_paci
	},function(data){
		var json = JSON.parse(data);
		if(nombre_paci.length>0 && paterno_paci.length>0 && materno_paci.length>0)
		{
			var rfc = json.body.response.data.rfc;
			$("#txt_rfc_paci").prop('value',rfc);
			var curp = rfc.substring(0, 10);
			$("#txt_curp_paci").prop('value',curp+'HOMO');
		}else{
			swal("","Por favor ingrese el nombre para calcular RFC/CURP");
			$("#cbo_fecha_nacimiento").prop('value','');
		}
	});
}
function agregarReligion(value)
{
	if(value=='agregar')
	{
		swal({
		  title: "Agregar religión",
		  text: "Escriba el nombre de la religión",
		  type: "input",
		  showCancelButton: true,
		  closeOnConfirm: false,
		  inputPlaceholder: "Escribir"
		}, function (inputValue) {
		  if (inputValue === false) return false;
		  if (inputValue === "") {
		    swal.showInputError("Es necesario escribir algo...");
		    return false
		  }
		  $.post('control/ctrl_religion.php?e=nuevaReligion',{religion:inputValue},function(data){
		  	swal('Aviso',data);
		  	$.post('includes/options_religiones.php',{selected:inputValue},function(data){$("#cbo_religion_nuevo").html(data);});
		  });
		});
	}
}
function agregarEdoCiv(value)
{
	if(value=='agregar')
	{
		swal({
		  title: "Agregar estado civil",
		  text: "Escriba el nombre del estado civil",
		  type: "input",
		  showCancelButton: true,
		  closeOnConfirm: false,
		  inputPlaceholder: "Escribir"
		}, function (inputValue) {
		  if (inputValue === false) return false;
		  if (inputValue === "") {
		    swal.showInputError("Es necesario escribir algo...");
		    return false
		  }
		  $.post('control/ctrl_edo_civil.php?e=nuevoEdoCivil',{edo_civil:inputValue},function(data){
		  	swal('Aviso',data);
		  	$.post('includes/options_edo_civil.php',{selected:inputValue},function(data){$("#cbo_edo_civ_nuevo").html(data);});
		  });
		});
	}
}