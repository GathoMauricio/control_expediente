$(document).ready(init);
function init()
{
	$(".contenedor").click(function(){ $(".busqueda").css('display','none'); }); //desparece items de busqueda al tocar el contenedor
	$(".menu").click(function(){ $(".busqueda").css('display','none'); }); //desparece items de busqueda al tocar el menu
	$(".buzon").click(function(){ $(".busqueda").css('display','none'); }); //desparece items de busqueda al tocar el buzon

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
function informacionGral(id_expediente)
{
	$.post('includes/información_gral.php',{id_expediente:id_expediente},function(data){ $("#contenedor").html(data); });
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
			  text: "El espediente ha alcanzado el total de pases permitidos<br¿Desea editar la información de este expediente?>",
			  showCancelButton: true,
			  confirmButtonClass: "btn-primary",
			  confirmButtonText: "Editar",
			  cancelButtonText:"Cancelar",
			  closeOnConfirm: true
			},
			function(){
				informacionGral(id_expediente);
			});	
		}
	});	
}


function cargarBuzon(){
	$.post('control/ctrl_expediente.php?e=cargarBuzon',{},function(data){ $("#buzon").html(data); });
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
			  text: "El espediente ha alcanzado el total de pases permitidos<br¿Desea editar la información de este expediente?>",
			  showCancelButton: true,
			  confirmButtonClass: "btn-primary",
			  confirmButtonText: "Editar",
			  cancelButtonText:"Cancelar",
			  closeOnConfirm: true
			},
			function(){
				informacionGral(insert_id);
			});	
		}
	});	
} 
function removerBuzon(id_expediente)
{
	swal({
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
	});	
}
function abrirExpediente(id_expediente)
{
	$("#id_expediente").prop('value',id_expediente);
	$.post('includes/expediente.php?id_expediente='+id_expediente,{},function(data){ $("#contenedor").html(data); $(".busqueda").css('display','none');});
}

function eliminarArchivo(id_archivo)
  {
    if(confirm('¿Eliminar archivo?'))
    {
      window.location="control/ctrl_archivo.php?e=eliminarArchivo&id_archivo="+id_archivo;
    }
  }