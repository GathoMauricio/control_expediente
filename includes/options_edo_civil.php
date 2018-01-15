<?php 
if(isset($_POST['selected']))include '../control/conexion.php';
$con = new Conexion();
$sql = "SELECT * FROM edo_civil ORDER BY edo_civil";
$datos = $con->select($sql);
echo "<option value='Sin estado civil' >~~Seleccione estado civil~~</option>";
while($fila=mysqli_fetch_array($datos))
{
if(isset($_POST['selected']))
{
	if($fila['edo_civil']==$_POST['selected'])
	{
		echo "<option value='".utf8_encode($fila['edo_civil'])."' selected>".utf8_encode($fila['edo_civil'])."</option>";
	}else{
		echo "<option value='".utf8_encode($fila['edo_civil'])."'>".utf8_encode($fila['edo_civil'])."</option>";
	}
}else{
	echo "<option value='".utf8_encode($fila['edo_civil'])."' >".utf8_encode($fila['edo_civil'])."</option>";
}

}
 ?>
 <option value="agregar">--Agregar estado civil--</option>