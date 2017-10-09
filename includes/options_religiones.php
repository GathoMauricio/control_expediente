<?php 
include '../control/conexion.php';
$con = new Conexion();
$sql = "SELECT * FROM religion ORDER BY religion";
$datos = $con->select($sql);
while($fila=mysqli_fetch_array($datos))
{
if(isset($_POST['selected']))
{
	if($fila['religion']==$_POST['selected'])
	{
		echo "<option value='".utf8_encode($fila['religion'])."' selected>".utf8_encode($fila['religion'])."</option>";
	}else{
		echo "<option value='".utf8_encode($fila['religion'])."'>".utf8_encode($fila['religion'])."</option>";
	}
}else{
	echo "<option value='".utf8_encode($fila['religion'])."' >".utf8_encode($fila['religion'])."</option>";
}

}
 ?>
 <option value="agregar">--Agregar religión--</option>