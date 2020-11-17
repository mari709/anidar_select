<?php
	
	require ('../conexion.php');
	
	$id_familia = $_GET['idfamilia'];
	
$queryM = "SELECT * FROM productos WHERE idfamilia = '".$id_familia."' order by producto";

	echo $queryM;

	$resultadoM = $mysqli->query($queryM);
	
	$html= "<option value='3'>Selecciona Producto</option>";
	
	while($rowM = $resultadoM->fetch_assoc())
	{
		$html.= "<option value='".$rowM['idproducto']."'>".$rowM['producto']."</option>";
	}
	
	echo $html;
?>		