<?php include 'head.php'; ?>
<?php 
session_start();
if(isset($_SESSION['tipo_usu']))
{
	switch($_SESSION['tipo_usu'])
	{
		case 'Doctor': header('Location: doctor.php'); break;
		case 'Asistente': header('Location: asistente.php'); break;
	}
}else{
	header('Location: index.php');
}
 ?>
<style type="text/css">
.contenedor_menu_administracion{
  padding: 20px;
  width: 60%;
  background-color: white;
  text-align: left;
  opacity: 0.9;
  box-shadow: 5px 5px 15px #0080FF;
  border-style: outset;
}
</style>
<center>
<br><br><br><br>
<div class="contenedor_menu_administracion">
<label style="float:right;color:red;cursor:pointer;" title="Cerrar sesión" onclick="cerrarSesion();"><span class='icon-exit'></span></label><br>
<label style="float:right;"><?php echo $_SESSION['tipo_usu'].': '.$_SESSION['nombre']; ?></label><br><br>
<h4>Menú de administración.</h4>
Estas son las opciones que tenemos disponibles para el menú de administración.
<br><br><br>
<button style="width:100%;" class="btn btn-primary" onclick="openNuevoUsuario();"> 
	<span class="icon-user-plus"></span> 
	Crear nuevo usuario
</button>
<br><br>
<button style="width:100%;" class="btn btn-primary" onclick="openVerUsuarios();">
	<span class="icon-users"></span> 
	Catálogo de usuarios
</button>
<br><br>
<button style="width:100%;" class="btn btn-primary" onclick="openImportarBd();">
	<span class="icon-upload3"></span> 
	Importar base de datos
</button>
<br><br>
<button style="width:100%;" class="btn btn-primary" onclick="exportarBd();">
	<span class="icon-download3"></span> 
	Exportar base de datos
</button>
<!--	<br><br>
<button style="width:100%;" class="btn btn-primary">Cambiar contraseña</button>-->
<br><br><br>
</div>
</center>
<?php include 'forms/frm_ver_usuarios.php'; ?>
<?php include 'forms/frm_nuevo_usuario.php'; ?>
<?php include 'forms/frm_actualizar_usuario.php'; ?>
<?php include 'forms/frm_importar_bd.php'; ?>
<?php include 'forms/frm_load.php'; ?>
 <?php include 'footer.php'; ?>	
 <script type="text/javascript">
 $(document).ready(function(){




$(".messages").hide();
    //queremos que esta variable sea global
    var fileExtension = "";
        //función que observa los cambios del campo file y obtiene información
    $('#input_importar').change(function()
    {
        //obtenemos un array con los datos del archivo
        var file = $("#input_importar")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
        console.log("Archivo para subir: "+fileName+", peso total: "+fileSize+" bytes. Extensión: "+fileExtension);
    });
   $("#form_importar_bd").submit(function(e){
        e.preventDefault();
        
        var formData = new FormData($("#form_importar_bd")[0]);
        var message = ""; 
        if(isSql(fileExtension)){
        //hacemos la petición ajax 
        	showLoad(); // mensaje cargando
	        $.ajax({
	            url: 'control/conexion.php?e=importarBD',  
	            type: 'POST',
	            // Form data
	            //datos del formulario
	            data: formData,
	            //necesario para subir archivos via ajax
	            cache: false,
	            contentType: false,
	            processData: false,
	            //mientras enviamos el archivo
	            beforeSend: function(){
	                       
	            },
	            //una vez finalizado correctamente
	            success: function(data){
	            	hideLoad();
	                swal('Aviso',data);
	                $("#modal_importar_bd").modal('hide');
	            },
	            //si ha ocurrido un error
	            error: function(error){
	            	hideLoad();
	                swal('Aviso',error);
	                $("#modal_importar_bd").modal('hide');   
	            }
	        });
		}else{ swal('Aviso',"El archivo que intenta cargar no parece ser un script válido!",'error'); }

 	});







 	$("#frm_nuevo_usuario").submit(function(e){
 		e.preventDefault();
 		var contrasena = $("#txt_contrasena_usuario_nuevo").prop('value');
 		var recontrasena = $("#txt_recontrasena_usuario_nuevo").prop('value');
 		if(contrasena==recontrasena)
 		{
 			$.post('control/ctrl_usuario.php?e=insertUsuario',$("#frm_nuevo_usuario").serialize(),function(data){
 				swal("Aviso",data);
 				$("#frm_nuevo_usuario")[0].reset();
 				$("#modal_nuevo_usuario").modal('hide');
 			});
 		}else{
 			swal("Aviso","Las contraseñas deben coincidir!","error");
 		}
 	});
 	$('#frm_actualizar_usuario').submit(function(e){
 		e.preventDefault();
 		var contrasena = $("#txt_contrasena_usuario_actualizar").prop('value');
 		var recontrasena = $("#txt_recontrasena_usuario_actualizar").prop('value');
 		if(contrasena==recontrasena)
 		{
 			$.post('control/ctrl_usuario.php?e=updateUsuario',$("#frm_actualizar_usuario").serialize(),function(data){
 				swal("Aviso",data);
 				$("#frm_actualizar_usuario")[0].reset();
 				$("#modal_actualizar_usuario").modal('hide');
 				openVerUsuarios();
 			});
 		}else{
 			swal("Aviso","Las contraseñas deben coincidir!","error");
 		}
 	});
 });
function isSql(extension)
{
    if(extension.toLowerCase()=='sql') 
    {
    	return true;
    }else{
    	return false;
    }
}
 function openVerUsuarios()
{
	$.post('control/ctrl_usuario.php?e=selectUsuarios',{},function(data){
		$("#contenedor_ver_usuarios").html(data);
		$("#modal_ver_usuarios").modal('show');
	});	
}
function openNuevoUsuario()
{
	$("#modal_nuevo_usuario").modal('show');
}
function openEditarUsuario(id_usuario)
{
	$.post('control/ctrl_usuario.php?e=getUsuario',{id_usuario:id_usuario},function(data){
		var json = JSON.parse(data);
		$("#txt_id_usuario_actualizar").prop('value',json.id_usuario);
		$("#cbo_tipo_usu_actualizar").prop('value',json.tipo_usu);
		$("#txt_nom_usu_actualizar").prop('value',json.nom_usu);
		$("#txt_contrasena_usuario_actualizar").prop('value',json.con_usu);
		$("#txt_recontrasena_usuario_actualizar").prop('value',json.con_usu);
		$("#txt_curp_usuario_actualizar").prop('value',json.curp);
		$("#txt_nombre_usu_actualizar").prop('value',json.nombre_usu);
		$("#txt_ape_pat_actualizar").prop('value',json.ape_pat);
		$("#txt_ape_mat_actualizar").prop('value',json.ape_mat);
		$("#txt_prof_actualizar").prop('value',json.prof);
		$("#cbo_sex_actualizar").prop('value',json.sex);
		$("#txt_cedula_p_actualizar").prop('value',json.cedula_p);
		$("#txt_matricula_actualizar").prop('value',json.matricula);
		$("#cbo_fecha_naci_actualizar").prop('value',json.fecha_naci);
		$("#txt_cedula_esp_actualizar").prop('value',json.cedula_esp);
		$("#modal_actualizar_usuario").modal('show');
	});	
	
}
function eliminarUsuario(id_usuario){
	if(confirm("¿Realmente desea elimiran este registro?"))
	{
		$.post('control/ctrl_usuario.php?e=eliminarUsuario',{id_usuario:id_usuario},function(data){
		swal("Aviso",data);
		openVerUsuarios();
	});
	}
}
function buscarUsuario(nombre)
{
	$.post('control/ctrl_usuario.php?e=buscarUsuario',{nombre:nombre},function(data){
		$("#contenedor_ver_usuarios").html(data);
	});
}
function exportarBd()
{
	window.location ="control/conexion.php?e=exportarBD";
}
function openImportarBd()
{
	$("#modal_importar_bd").modal('show');
}
function showLoad()
{
	$("#modal_load").modal('show');
}
function hideLoad()
{
	$("#modal_load").modal('hide');
}
 </script>