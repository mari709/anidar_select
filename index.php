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
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>ComboBox Ajax, PHP y MySQL</title>
		<link href="css/styles.css" rel="stylesheet" />
		<script language="javascript" src="js/jquery-3.1.1.min.js"></script>
		
		<script language="javascript">
			$(document).ready(function(){
				$("#select-familia").change(function () {

										
					$("#select-familia option:selected").each(function () {
						idfamilia = $(this).val();
						$.get("includes/getProducto.php", { idfamilia: idfamilia }, function(data){
							$("#select-productos").html(data);
						});            
					});
				})
			});
			

		</script>
		
	</head>
	
	<body>
		<form id="combo" name="combo" action="insert_detalle.php" method="POST">
			<div class="row">
				<div class="col-md-6">
					<label class="font-weight-bold">Selecciona Familia</label>
					<select class="form-control" name= "select-familia" id="select-familia">
						<option value="0">Familia</option>
						<?php while($row = $resultado->fetch_assoc()) { ?>
						<option value="<?php echo $row['idfamilia']; ?>">
						<?php echo $row['familia']; ?>
						</option>
						<?php } ?>
					</select>
				</div>
				<div class="col-md-6">
					<label class="font-weight-bold">Selecciona Producto</label>
					<select class="form-control" name="select-productos" id="select-productos">
					</select>
				</div>
				<div class="col-md-4">
					<input class="form-control" type="text" name = "last" disabled value = <?php echo $numero?> />
					<input class=" form-control btn btn-primary" type="submit" id="enviar" name="enviar" value="Guardar" />
				</div>
			</div>
		</form>
	</body>

<?php




?>



</html>
