<?php
	require ('conexion.php');
	
//$query = "SELECT id_estado, estado FROM t_estado ORDER BY estado";
	
	$query = "SELECT idfamilia,familia FROM productos group by idfamilia";
	$resultado=$mysqli->query($query);
	$sql2= "select idnp from nota_pedidos  ORDER BY `nota_pedidos`.`idnp` desc limit 1";
    $query2 = mysqli_query($mysqli,$sql2);
    $resultado2 = mysqli_fetch_assoc($query2);
    $numero = $resultado2['idnp'];
?>

<html>
	<head>
		<title>ComboBox Ajax, PHP y MySQL</title>
		
		<script language="javascript" src="js/jquery-3.1.1.min.js"></script>
		
		<script language="javascript">
			$(document).ready(function(){
				$("#select-familia").change(function () {

										
					$("#select-familia option:selected").each(function () {
						idfamilia = $(this).val();
						$.get("includes/getMunicipio.php", { idfamilia: idfamilia }, function(data){
							$("#select-productos").html(data);
						});            
					});
				})
			});
			

		</script>
		
	</head>
	
	<body>
		<form id="combo" name="combo" action="insert_detalle.php" method="POST">
			<div>Selecciona Familia : <select name= "select-familia" id="select-familia">
				<option value="0">Familia</option>
				<?php while($row = $resultado->fetch_assoc()) { ?>
					<option value="<?php echo $row['idfamilia']; ?>"><?php echo $row['familia']; ?></option>
				<?php } ?>
			</select></div>
			
			<br />
			
			<div>Selecciona Producto : <select name="select-productos" id="select-productos">
		


			</select></div>
			
			<div>
			<input type="text" name = "last" value = <?php echo $numero?> >
            </div>

			<input type="submit" id="enviar" name="enviar" value="Guardar" />
		</form>
	</body>

<?php




?>



</html>
