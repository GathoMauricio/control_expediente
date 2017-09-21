<?php 
function enviarNotificacion($mensaje){
require "Pusher.php";
$options = array(
    'cluster' => 'us2',
    'encrypted' => true
  );
  $pusher = new Pusher\Pusher(
    'be16aa8bec249ddd5126',
    '96a93c27bf945c3d4081',
    '402770',
    $options
  );

  $data['mensaje'] = $mensaje;
  $pusher->trigger('canal_doctor', 'e_nuevo_paciente', $data);

}
 ?>