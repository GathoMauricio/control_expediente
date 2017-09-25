<?php

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Reporte_Personal_usuarios.xls");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LISTA DE USUARIOS</title>
</head>
<body>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr >
    <td><strong>Fecha de registro</strong></td>
    <td><strong>Nombre</strong></td>
    <td><strong>A. Paterno</strong></td>
    <td><strong>A.materno</strong></td>
    <td><strong>Sexo</strong></td>
    <td><strong>Fecha de nacimiento</strong></td>
    <td><strong>Edad</strong></td>
    <td><strong>Lugar de nacimiento</strong></td>
    <td><strong>RFC</strong></td>
    <td><strong>CURP</strong></td>
    <td><strong>Titular</strong></td>
    <td><strong>Teléfono celular</strong></td>
    <td><strong>Teléfono casa</strong></td>
    <td><strong>Teléfono oficina</strong></td>
    <td><strong>Teléfono otro</strong></td>
    <td><strong>Calle</strong></td>
    <td><strong>No exterior</strong></td>
    <td><strong>No interior</strong></td>
    <td><strong>Colonia</strong></td>
    <td><strong>Municipio</strong></td>
    <td><strong>Estado</strong></td>
    <td><strong>Escolaridad</strong></td>
    <td><strong>Ocupacion</strong></td>
    <td><strong>Edo. civil</strong></td>
    <td><strong>Comentarios</strong></td>
    <td><strong>Religion</strong></td>
    <td><strong>¿Cómo conocio el servicio?</strong></td>
    <td><strong>Correo electrónico</strong></td>
    <td><strong>Nombre del padre</strong></td>
    <td><strong>Ocupación del padre</strong></td>
    <td><strong>Edad del padre</strong></td>
    <td><strong>Teléfono de la madre</strong></td>
    <td><strong>Nombre de la madre</strong></td>
    <td><strong>Ocupación de la madre</strong></td>
    <td><strong>Edad de la madre</strong></td>
    <td><strong>Teléfono de la madre</strong></td>
    <td><strong>Nombre de cónyuge</strong></td>
    <td><strong>Ocupación de conyuge</strong></td>
    <td><strong>Edad de conyuge</strong></td>
    <td><strong>Teléfono de conyuge</strong></td>
    <td><strong>Detalles de hermanos</strong></td>40
    <td><strong>Detalles de hermanas</strong></td>
    <td><strong>Detalles de hijos</strong></td>
    <td><strong>Detalles de hijas</strong></td>
    <td><strong>Alergias</strong></td>
    <td><strong>Tipo de sangre</strong></td>
    <td><strong>Contacto nombre</strong></td>
    <td><strong>Contacto dirección</strong></td>
    <td><strong>Contacto parentezco</strong></td>
    <td><strong>Contacto teléfono</strong></td>
    <td><strong>Contacto comentarios</strong></td>
    <td><strong>Id pase</strong></td>
    <td><strong>Total pases</strong></td>
    <td><strong>Part A</strong></td>
    <td><strong>Part B</strong></td>
    <td><strong>Part C</strong></td>
    <td><strong>Altec</strong></td>
    <td><strong>Altes</strong></td>
    <td><strong>Axa Santander</strong></td>
    <td><strong>Axa conducef</strong></td>
    <td><strong>Banorte</strong></td>
    <td><strong>Bansefi</strong></td>
    <td><strong>BNCI</strong></td>
    <td><strong>Emp</strong></td>
    <td><strong>Gpo Med</strong></td>
    <td><strong>Gpo Med Doctor</strong></td>
    <td><strong>Gpo Med Procesa</strong></td>
    <td><strong>GPo Med Almacen</strong></td>
    <td><strong>Insen</strong></td>
    <td><strong>S inves cob</strong></td>
    <td><strong>S inves no cob</strong></td>
    <td><strong>Serfin</strong></td>
    <td><strong>Tepeyac</strong></td>
    <td><strong>Vitamédica AFO</strong></td>
    <td><strong>Vitamédica Bancomer Operadora</strong></td>
    <td><strong>Vitamédica Banamex</strong></td>
    <td><strong>Vitamédica Bancomer SAN</strong></td>
    <td><strong>Vitamédica membresía</strong></td>
    <td><strong>Zuriich</strong></td>
    <td><strong>Dato A1</strong></td>
    <td><strong>Dato B2</strong></td>
    <td><strong>Dato C3</strong></td>
    <td><strong>Dato D4</strong></td>
    <td><strong>Dato E5</strong></td>
    <td><strong>Dato F6</strong></td>
    <td><strong>Dato G7</strong></td>
    <td><strong>Dato H8</strong></td>
    <td><strong>Dato I9</strong></td>
    <td><strong>Dato J10</strong></td>
    <td><strong>Dato K11</strong></td>
    <td><strong>Dato L12</strong></td>
    <td><strong>Dato M13</strong></td>
    <td><strong>Dato N14</strong></td>
    <td><strong>Dato O15</strong></td>
    <td><strong>Dato P16</strong></td>
    <td><strong>Dato Q17</strong></td>
    <td><strong>Dato R18</strong></td>
    <td><strong>Dato S19</strong></td>
    <td><strong>Dato T20</strong></td>
    <td><strong>Dato U21</strong></td>
    <td><strong>Dato V22</strong></td>
    <td><strong>Dato X23</strong></td>
    <td><strong>Dato Y24</strong></td>
    <td><strong>Dato Z25</strong></td>
    <td><strong>Dato A26</strong></td>
    <td><strong>Dato B27</strong></td>
    <td><strong>Dato C28</strong></td>
    <td><strong>Estado del expediente</strong></td>
    <td><strong>Referencia</strong></td>
    <td><strong>Peso</strong></td>
    <td><strong>Talla</strong></td>
    <td><strong>T.A</strong></td>
    <td><strong>F.C</strong></td>
    <td><strong>F.R</strong></td>
    <td><strong>Temperatura</strong></td>
    <td><strong>FUM</strong></td>
    <td><strong>Antecedentes familiares</strong></td>
    <td><strong>Antecedentes personales no patologicos</strong></td>
    <td><strong>Antecedentes personales patológicos</strong></td>
    <td><strong>Padecimiento actual</strong></td>
    <td><strong>Exploración física</strong></td>
     <td><strong>Otros datos</strong></td>
    <td><strong>RX</strong></td>
    <td><strong>Diagnóstico</strong></td>
    <td><strong>Tratamiento</strong></td>
  </tr>

<?php 
include "control/conexion.php";
$con = new Conexion();
$datos = $con->select("SELECT * FROM paciente");
while($fila=mysqli_fetch_array($datos))
{
	echo 
"<tr>
    <td>".$fila['nombre_paci']."</td>
</tr>";
}
 ?> 
</table>
</body>
</html>