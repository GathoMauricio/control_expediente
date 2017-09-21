<?php 
if(isset($_GET['e']))
{
	switch ($_GET['e']) {
		case 'iniciarSesion': iniciarSesion(); break;
		case 'cerrarSesion' : cerrarSesion(); break;
		case 'insertUsuario': insertUsuario(); break;
		case 'selectUsuarios': selectUsuarios(); break;
		case 'buscarUsuario': buscarUsuario(); break;
		case 'getUsuario': getUsuario(); break;
		case 'updateUsuario': updateUsuario(); break;
		case 'eliminarUsuario': eliminarUsuario(); break;
	}
}
function iniciarSesion()
{
	include 'conexion.php';
	$con = new Conexion();
	$sql="SELECT * FROM usuario WHERE nom_usu='$_POST[usuario]' AND con_usu='$_POST[contrasena]'";
	$datos = $con->select($sql);
	if($fila=mysqli_fetch_array($datos))
	{
		session_start();
		$_SESSION['id_usuario']=$fila['id_usuario'];
		$_SESSION['tipo_usu']=$fila['tipo_usu'];
		$_SESSION['nombre']=$fila['nombre_usu'].' '.$fila['ape_pat'].' '.$fila['ape_mat'];
		echo json_encode(array('error'=>'0','mensaje'=>'Datos correctos','tipo_usuario'=>$fila['tipo_usu']));
	}else{
		echo json_encode(array('error'=>'1','mensaje'=>'Datos incorrectos'));
	}
}
function cerrarSesion()
{
	session_start();
	session_destroy();
	header('Location: ../index.php');
}
function insertUsuario()
{
	include 'conexion.php';
	$con = new Conexion();
	$sql="INSERT INTO usuario (tipo_usu,nom_usu,con_usu,curp,nombre_usu,ape_pat,ape_mat,prof,sex,cedula_p,matricula,fecha_naci,cedula_esp) VALUES ('$_POST[tipo_usu]','$_POST[nom_usu]','$_POST[con_usu]','$_POST[curp]','$_POST[nombre_usu]','$_POST[ape_pat]','$_POST[ape_mat]','$_POST[prof]','$_POST[sex]','$_POST[cedula_p]','$_POST[matricula]','$_POST[fecha_naci]','$_POST[cedula_esp]')";
	if($con->insert($sql))
	{
		echo "El usuario se insertó con éxito!";
	}else{
		echo "Ocurrió un error durante la operación!";
	}
}
function selectUsuarios()
{
	include 'conexion.php';
	$con = new Conexion();
	$sql="SELECT * FROM usuario ";
	$datos = $con->select($sql);
	echo '
	<table class="table table-hover" style="width:100%;">
          <tr>
            <th>Tipo de usuario</th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Opciones</th>
          </tr>
	';
	while($fila=mysqli_fetch_array($datos))
	{
		echo '
		 <tr>
            <td>'.$fila['tipo_usu'].'</td>
            <td>'.$fila['nom_usu'].'</td>
            <td>'.$fila['nombre_usu'].' '.$fila['ape_pat'].' '.$fila['ape_mat'].'</td>
            <td>
            	<button class="btn btn-warning" onclick="openEditarUsuario('.$fila['id_usuario'].');"><span class="icon-pencil"></span></button>
            	<button class="btn btn-danger" onclick="eliminarUsuario('.$fila['id_usuario'].');"><span class="icon-bin"></span></button>
            </td>
         </tr>
	';
	}
	echo '</table>';
}
function buscarUsuario()
{
	include 'conexion.php';
	$con = new Conexion();
	$sql="SELECT * FROM usuario WHERE nombre_usu LIKE '%$_POST[nombre]%' OR ape_pat LIKE '%$_POST[nombre]%' OR ape_mat LIKE '%$_POST[nombre]%'";
	$datos = $con->select($sql);
	echo '
	<table class="table table-hover" style="width:100%;">
          <tr>
            <th>Tipo de usuario</th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Opciones</th>
          </tr>
	';
	$contador=0;
	while($fila=mysqli_fetch_array($datos))
	{
		$contador++;
		echo '
		 <tr>
            <td>'.$fila['tipo_usu'].'</td>
            <td>'.$fila['nom_usu'].'</td>
            <td>'.$fila['nombre_usu'].' '.$fila['ape_pat'].' '.$fila['ape_mat'].'</td>
            <td>
            	<button class="btn btn-warning" onclick="openEditarUsuario('.$fila['id_usuario'].');"><span class="icon-pencil"></span></button>
            	<button class="btn btn-danger" onclick="eliminarUsuario('.$fila['id_usuario'].');"><span class="icon-bin"></span></button>
            </td>
         </tr>
	';
	}
	echo '</table>';
	if($contador<=0)
	{
		echo '<center><br><br><label>No se encontraron coincidencias.</label></center>';
	}
}
function getUsuario()
{
	include 'conexion.php';
	$con = new Conexion();
	$sql="SELECT * FROM usuario WHERE id_usuario=$_POST[id_usuario]";
	$datos = $con->select($sql);
	if($fila=mysqli_fetch_array($datos))
	{
		echo json_encode(array(
			'id_usuario'=>$fila['id_usuario'],
			'tipo_usu'=>$fila['tipo_usu'],
			'nom_usu'=>$fila['nom_usu'],
			'con_usu'=>$fila['con_usu'],
			'curp'=>$fila['curp'],
			'nombre_usu'=>$fila['nombre_usu'],
			'ape_pat'=>$fila['ape_pat'],
			'ape_mat'=>$fila['ape_mat'],
			'prof'=>$fila['prof'],
			'sex'=>$fila['sex'],
			'cedula_p'=>$fila['cedula_p'],
			'matricula'=>$fila['matricula'],
			'fecha_naci'=>$fila['fecha_naci'],
			'cedula_esp'=>$fila['cedula_esp']
		));
	}else{
		echo "Ocurrió un error";
	}
}
function updateUsuario()
{
	include 'conexion.php';
	$con = new Conexion();
	$sql="UPDATE usuario SET 
	tipo_usu='$_POST[tipo_usu]',
	nom_usu='$_POST[nom_usu]',
	con_usu='$_POST[con_usu]',
	curp='$_POST[curp]',
	nombre_usu='$_POST[nombre_usu]',
	ape_pat='$_POST[ape_pat]',
	ape_mat='$_POST[ape_mat]',
	prof='$_POST[prof]',
	sex='$_POST[sex]',
	cedula_p='$_POST[cedula_p]',
	matricula='$_POST[matricula]',
	fecha_naci='$_POST[fecha_naci]',
	cedula_esp='$_POST[cedula_esp]'
	 WHERE id_usuario=$_POST[id_usuario]";
	if($con->update($sql))
	{
		echo "Datos actualizados";
	}else{
		echo "Ocurrió un error";
	}
}
function eliminarUsuario()
{
	include 'conexion.php';
	$con = new Conexion();
	$sql="DELETE FROM usuario WHERE id_usuario=$_POST[id_usuario]";
	if($con->delete($sql))
	{
		echo "Registro eliminado!";
	}else{
		echo "Ocurrió un error";
	}
}
 ?>