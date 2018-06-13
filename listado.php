<?php

#Listado de Tipos de Insumo
#Este programa muestra los diferentes  Tipos de Insumo
#
#
#Id: listado.php Ver. 1.0
#
# Control de Cambios:
# (agregar los cambios con el siguiente formato:  Fecha, Autor, Descripci�n del cambio)
#
# 27/12/2017 - Se ajusto el manejador de BD a PDO y se cambio a usar bootgrid.
#

//Sustituir por el nombre del tipo de datos que se administra con el modulo
$elemento_p="Tipos de Insumo";
$elemento_s="Tipo de Insumo";
$clave_principal="id_tipo";

/*
Parámetros para usarse en la definición de las columnas a aprecer en el grid.  (http://www.jquery-bootgrid.com/Documentation)
----------------------------------------------------------------------------------
texto: Texto que aparece en el título de la columna.
data-column-id: Identificacion de la columna, debe coincidir con el nombre de columna en el query.
data-identifier: Marca a una columna como el identificador unico. Default es "false".
data-order: Especifica la forma de ordenamiento. Default es "", valores: "asc", "desc".
data-searchable: Habilita la posibilidad de buscar en esa columna (no se puede en campos computados). Default es "true", valores: "true", "false".
data-align: Alineacion de los datos de las celdas: default es "left", valores: "left", "center", "right"
data-cssClass: Establece la clase CSS aplicable a las celdas. Default es ""
data-formatter: Especifica el nombre de un formateador. Formatea el contenido de una celda.
data-headerAlign: Alinea las celdas con los encabezados. Default es "left", valores: "left", "center", "right".
data-headerCssClass: Especifica la clase CSS aplicable a las celdas con los encabezados.
data-sortable: Habilita la posibilidad de ordenar por la columna. Default es "true", valores: "true", "false"
data-type: Cambia el tipo de dato en las celdas de la columna. Usar "data-converter" ya que esta obsoleto en algunas versions de jquery bootgrid. Defailt es "string", valores: "string", "numeric"
data-visible: Habilita la visualización de la columna. Default es "true", valores: "true", "false".

*/


$columnas=array(array('data-column-id'=>"id_tipo",'data-order'=>"asc",'data-type'=>"numeric",'data-identifier'=>"true",'data-header-align'=>"center",'data-width'=>"50px",'data-visible'=>"false",'texto'=>'ID'),
                array('data-column-id'=>"tipo_insumo",'data-searchable'=>"true",'data-sortable'=>"true",'data-header-align'=>"center",'data-width'=>"40%",'texto'=>"Unidad de Medida"),
                array('data-column-id'=>"abreviatura",'data-searchable'=>"true",'data-sortable'=>"true",'data-header-align'=>"center",'data-width'=>"20%",'texto'=>"Abreviatura"),
		        array('data-column-id'=>"estado",'data-header-align'=>"center",'data-width'=>"100px",'texto'=>"Estatus"));
                


error_reporting(0);
define("VERSION","1.0");
require_once("../../config.php");

require_once($CFG->dirroot_admin . '/lee_parametros.inc.php');

require_once($CFG->dirroot_admin . '/permisos.inc.php');

$myACL = new ACL();
if ($myACL->hasPermission('admin_tipo_insumo') != true)  // Se verifica los permisos para ver esta página

{
	$location=$CFG->url_admin . "sin_permiso.php";
	//header("location: ../../sin_permiso.php");
	header($location);
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Administración de <?php echo $elemento_p;?> | AdminPanel | <?php echo $CFG->empresa;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link rel="stylesheet" href="<?php echo $CFG->url_admin?>/css/estilos.css">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo $CFG->url_admin?>/adminlte/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $CFG->url_admin?>/adminlte/css/font-awesome.min.css">
  <!-- Marnic Font -->
  <link rel="stylesheet" href="<?php echo $CFG->url_admin?>/css/marnic_fonts_styles.css">  
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $CFG->url_admin?>/adminlte/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $CFG->url_admin?>/adminlte/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $CFG->url_admin?>/adminlte/dist/css/skins/skin-red.min.css">

  <!-- includes especificos para este modulo  -->
  <link href="<?php echo $CFG->url_admin?>/imagenes/logo_marnic_small.ico" rel="shortcut icon" type="image/x-icon" />
  <link rel="stylesheet" href="<?php echo $CFG->url_admin;?>/lib/Zebra_Dialog-master/css/default/zebra_dialog.css"> 
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $CFG->url_admin;?>/lib/jquery.bootgrid/jquery.bootgrid.css" />

</head>
<body class="hold-transition skin-red sidebar-mini fixed">

<div id="wrapper">

	<!-- Encabezado -->
	<?php
	require_once($CFG->dirroot_admin . '/includes/header-ap.inc.php');
	?>

	  <!-- =============================================== -->

	  <!-- Columna izquierda -->

	<?php
	require_once($CFG->dirroot_admin . '/includes/columna-izquierda-ap.inc.php');
	?>
	  <!-- =============================================== -->

	  <!-- Content Wrapper. Contiene el contenido de la página-->
	  <div class="content-wrapper">


<?php

include_once($CFG->dirroot_admin . '/includes/alerta_javascript.inc.php');

?>
		<!-- Content Header (Page header) -->
		<section class="content-header">
		  <ol class="breadcrumb">
			<li><a href="<?php echo $CFG->url_admin?>/principal.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"><?php echo $elemento_p;?></li>
			
		  </ol>
		  <h1>
			<?php echo $elemento_p;?>
		  </h1>

		  <p></p>
		</section>

        
		<!-- Main content -->
		<section class="content">

		  <!-- Default box -->
		  <div class="box">
			<div class="box-header with-border">
			  <h3 class="box-title">Listado</h3>

			</div>
			<div class="box-body">

			<div class="row">
				<div class="col-md-12">
				  <button id="agregarElemento" type="button" class="btn btn-operaciones"><img src="imagenes/file-add.png" alt="" style="height:30px"> Agregar  <?php echo $elemento_s;?></span></button>
				  <button id="borrarElemento" type="button" class="btn btn-operaciones"><img src="imagenes/file-delete.png" alt=""  style="height:30px"> Borrar <?php echo $elemento_p;?></button>
				  <button id="publicarElemento" type="button" class="btn btn-operaciones"><img src="imagenes/file-publish2.png" alt=""  style="height:30px"> <span style="color:#000000">Activar <?php echo $elemento_p;?></span></button>
				  <button id="nopublicarElemento" type="button" class="btn btn-operaciones"><img src="imagenes/file-unpublish2.png" alt=""  style="height:30px"> <span style="color:#000000">Desactivar <?php echo $elemento_p;?></span></button>
				  
				</div>
			
			</div>


    <table id="grid-data" class="table table-condensed table-hover table-striped table-bordered">
        <thead class="thead-inverse">
            <tr>   
			<?php

				foreach ($columnas as $columna) {
				    echo "<th ";
					foreach($columna as $clave => $valor) {
						if ($clave<>"texto") {
							echo "$clave=$valor ";
						}
						else {
							$titulo=$valor;
						}
					}
					echo ">$titulo</th>";
			    }
			
			?>

                <th data-column-id="commands" data-formatter="commands" data-sortable="false" data-width="150px" data-header-align="center" data-align="center">Operaciones</th>
            </tr>
        </thead>
    </table>




			</div>
			<!-- /.box-body -->
			<div class="box-footer text-right">
			  Versión modulo: <?php echo constant("VERSION");?>
			</div>
			<!-- /.box-footer-->
		  </div>
		  <!-- /.box -->

		</section>
		<!-- /.content -->


	  </div>
	  <!-- /.content-wrapper -->

	  
	<!-- Footer --> 

	<?php
	require_once($CFG->dirroot_admin . '/includes/footer-ap.inc.php');
	?>



	  <!-- Control Sidebar -->
	<?php
	require_once($CFG->dirroot_admin . '/includes/columna-configuracion-ap.inc.php');

	?>


</div>
<!-- ./wrapper -->


	<!-- Include Scripts -->
<?php
	require_once($CFG->dirroot_admin . '/includes/scripts-to-include-ap.inc.php');

?>	
	 <script type="text/javascript" src="<?php echo $CFG->url_admin;?>/lib/jquery.bootgrid/jquery.bootgrid.fa.js"></script>
     <script type="text/javascript" src="<?php echo $CFG->url_admin;?>/lib/jquery.bootgrid/jquery.bootgrid.js"></script>  
	 <script type="text/javascript" src="<?php echo $CFG->url_admin;?>/lib/Zebra_Dialog-master/javascript/zebra_dialog.js"></script>  


<script type="text/javascript">
$(document).ready(function(){

    $("#grid-data").bootgrid({
        ajax: true,
        post: function ()
        {
            /* To accumulate custom parameter with the request object */
            return {
                id: "b0df282a-0d67-40e5-8558-c9e93b7befed",
				id_tipo:"<?php echo $_GET['id'];?>"
            };
        },
		url: "response_insumos.php",
        selection: true,
        multiSelect: true,
        rowSelect: true,
        keepSelection: true,
	    labels: {
            noResults: "No hay resultados",
			all: "Todos",
			infos: "Mostrando  {{ctx.start}} a {{ctx.end}} de {{ctx.total}} entradas",
			loading: "Cargando",
			refresh: "Refrescar Tabla",
			search: "Buscar"
        },

        formatters: {
			 "commands": function(column, row)
					{
						/*
						return "<a href=\"ver_uni.php?id_tipo=<?php echo $_GET['id'];?>&id=" + row.<?php echo $clave_principal;?> + "\"><span class=\"icono-comando\"><img src=\"imagenes/view2.png\" alt=\"ver\"></span></a>" +
								"<a href=\"editar_unidad.php?id_tipo=<?php echo $_GET['id'];?>&id=" + row.<?php echo $clave_principal;?> + "\"><span class=\"icono-comando\"><img src=\"imagenes/edit.png\" alt=\"editar\"></span></a>" +
								"<a href=\"borrar_unidad.php?id_tipo=<?php echo $_GET['id'];?>&id=" + row.<?php echo $clave_principal;?> + "\"><span class=\"icono-comando\"><img src=\"imagenes/trash.png\" alt=\"borrar\"></span></a>"; 
						*/
						
						return 	"<a href=\"editar_tipo.php?id=" + row.<?php echo $clave_principal;?> + "\"><span class=\"icono-comando\"><img src=\"imagenes/edit.png\" alt=\"editar\"></span></a>" +
								"<a href=\"borrar_tipo.php?id=" + row.<?php echo $clave_principal;?> + "\"><span class=\"icono-comando\"><img src=\"imagenes/trash.png\" alt=\"borrar\"></span></a>"; 
								
					}
    }
});
$("#limpiarBusqueda").on("click", function ()
{
	$("#grid-data").bootgrid("search");
});
$("#recargar").on("click", function ()
{
	$("#grid-data").bootgrid("reload");
});
$("#agregarElemento").on("click", function ()
{
	window.location.href = "agregar_tipo.php";
});



$("#borrarElemento").on("click", function ()
{
	var elementos=$("#grid-data").bootgrid("getSelectedRows");
	if (elementos.length <= 0) {
		$.Zebra_Dialog('Se debe seleccionar algun <?php echo $elemento_s;?> para borrar', {
			'type':     'information',
			'title':    'Operaciones rápidas',

		});	
    }
	else {
	
		$.Zebra_Dialog('¿Está seguro de borrar algunos <?php echo $elemento_p;?> ?', {
			'type':     'question',
			'title':    'Confirmar borrado',
			'buttons':  [
							{caption: 'Si', callback: function() { 
								   
							       var formData = { 'operacion': 'borrar',
													lista: elementos};
								   $.ajax({
										type     : 'POST',
										url      : 'procesa_operaciones_insumos.php',
									    beforeSend: function(){
									        $(".black_overlay").show();
									    },
										data     : formData
								   })
									 .done(function(data) {
										 	$.Zebra_Dialog(data, {
														'type':     'confirmation',
														'title':    'Resultado de la operación',
											});
											$(".black_overlay").hide();
											$("#grid-data").bootgrid("deselect").bootgrid("reload");	
									 })
									 .fail(function(data) {
											$.Zebra_Dialog(data, {
														'type':     'error',
														'title':    'Resultado de la operación',
											});
											$(".black_overlay").hide();
											$("#grid-data").bootgrid("deselect").bootgrid("reload");	
									 });
									}},
							{caption: 'No', callback: function() { }},
						]
		});	
		
		

	}
	
});

$("#publicarElemento").on("click", function ()
{
	var elementos=$("#grid-data").bootgrid("getSelectedRows");
	if (elementos.length <= 0) {
		$.Zebra_Dialog('Se debe seleccionar alguna <?php echo $elemento_s;?> para activar', {
			'type':     'information',
			'title':    'Operaciones rápidas',

		});	
    }
	else {
       var formData = { 'operacion': 'publicar',
	                    lista: elementos};
	   $.ajax({
	        type     : 'POST',
			url      : 'procesa_operaciones_insumos.php',
			beforeSend: function(){
			    $(".black_overlay").show();
			},
			data     : formData
	   })
	     .done(function(data) {
			$.Zebra_Dialog(data, {
						'type':     'confirmation',
						'title':    'Resultado de la operación',
			});
			$(".black_overlay").hide();
		 	$("#grid-data").bootgrid("deselect").bootgrid("reload");    
		 })
		 .fail(function(data) {
			$.Zebra_Dialog(data, {
						'type':     'error',
						'title':    'Resultado de la operación',
			});
			$(".black_overlay").hide();
		    $("#grid-data").bootgrid("deselect").bootgrid("reload");
		     
		 });
         
	}
});

$("#nopublicarElemento").on("click", function ()
{
	var elementos=$("#grid-data").bootgrid("getSelectedRows");
	if (elementos.length <= 0) {
		$.Zebra_Dialog('Se debe seleccionar algun <?php echo $elemento_s;?> para desactivar', {
			'type':     'information',
			'title':    'Operaciones rápidas',

		});	
		
    }
	else {
       var formData = { 'operacion': 'ocultar',
	                    lista: elementos};
	   $.ajax({
	        type     : 'POST',
			url      : 'procesa_operaciones_insumos.php',
			beforeSend: function(){
			       $(".black_overlay").show();
			},			
			data     : formData
	   })
	     .done(function(data) {
			$.Zebra_Dialog(data, {
						'type':     'confirmation',
						'title':    'Resultado de la operación',
			});
			$(".black_overlay").hide();
		    $("#grid-data").bootgrid("deselect").bootgrid("reload");			
		   
		 })
		 .fail(function(data) {
			$.Zebra_Dialog(data, {
						'type':     'error',
						'title':    'Resultado de la operación',
			});
			$(".black_overlay").hide();
		    $("#grid-data").bootgrid("deselect").bootgrid("reload");		 
		     
		 });
		 
		 	
	}
});


}); 
</script>
<div class="black_overlay">
<div id="load"><img src="<?php echo $CFG->url_admin;?>/imagenes/trabajando-marnic.gif"/></div>
</div>
</body>
</html>