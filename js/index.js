/*$(document).ready(function(){
	alert = swal;

});*/
$(document).ready(function(){
    $("#form_subir_archivos")[0].reset();	

    /*$(".messages").hide();
    //queremos que esta variable sea global
    var fileExtension = "";
    //función que observa los cambios del campo file y obtiene información
    $(':file').change(function()
    {
        //obtenemos un array con los datos del archivo
        var file = $("#imagen")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
        showMessage("<span class='info'>Archivo para subir: "+fileName+", peso total: "+fileSize+" bytes.</span>");
    });
 
    //al enviar el formulario
    $(':button').click(function(){
        //información del formulario
        var formData = new FormData($(".formulario")[0]);
        var message = ""; 
        if(isSql(fileExtension)){
        //hacemos la petición ajax  
	        $.ajax({
	            url: 'control/conexion.php',  
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
	                message = $("<span class='before'>Subiendo la imagen, por favor espere...</span>");
	                showMessage(message)        
	            },
	            //una vez finalizado correctamente
	            success: function(data){
	                message = $("<span class='success'>"+data+"</span>");
	                showMessage(message);
	                
	            },
	            //si ha ocurrido un error
	            error: function(){
	                message = $("<span class='error'>Ha ocurrido un error.</span>");
	                showMessage(message);
	            }
	        });
		}else{ swal('Aviso',"El archivo que intenta cargar no parece ser un script válido!",'error'); }
    });*/
});
 
//como la utilizamos demasiadas veces, creamos una función para 
//evitar repetición de código
function showMessage(message){
    $(".messages").html("").show();
    $(".messages").html(message);
}
 
//comprobamos si el archivo a subir es una imagen
//para visualizarla una vez haya subido
function isSql(extension)
{
    if(extension.toLowerCase()=='sql') 
    {
    	return true;
    }else{
    	return false;
    }
}
function cerrarSesion()
{
    if(confirm('Esta apunto de salir del sistema'))
    {
        window.location="control/ctrl_usuario.php?e=cerrarSesion";
    }
}
function iniciarConsulta(id_paciente)
{
    window.location="nueva_consulta.php?id_paciente="+id_paciente;
}
function removerBuzon(id_paciente)
{
    //remover
}