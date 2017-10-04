$(document).ready(function(){
});
 
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
    $.post('control/ctrl_doctor.php?e=removerBuzon',{id_paciente:id_paciente},function(data){
    	swal('Aviso',data);
    	abrirBuzon();
    });
}