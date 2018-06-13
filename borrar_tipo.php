<?php

#Borrar Tipos de Insumo
#Este programa borrar Tipos de Insumo
#
#
#Id: borrar_tipo.php Ver. 1.0
#
# Control de Cambios:
# (agregar los cambios con el siguiente formato:  Fecha, Autor, Descripci�n del cambio)
#

#


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
  <title>Borrar Tipo de Insumo | AdminPanel | <?php echo $CFG->empresa;?></title>
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
  <link rel="stylesheet" href="<?php echo $CFG->url_admin?>/adminlte/dist/css/skins/skin-seminario.css">

  <!-- includes especificos para este modulo  -->
  <link href="<?php echo $CFG->url_admin?>/imagenes/logo_marnic_small.ico" rel="shortcut icon" type="image/x-icon" />
   <link rel="stylesheet" href="<?php echo $CFG->url_admin;?>/lib/libform/css/zebra_form.css"> 
  <link rel="stylesheet" href="<?php echo $CFG->url_admin;?>/lib/Zebra_Dialog-master/css/default/zebra_dialog.css"> 


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
			<li><a href="<?php echo $CFG->url_admin?>/modulos/mod_tipos_insumo_v1.0/listado.php"><i class="fa fa-dashboard"></i> Listado de Tipos de Insumo</a></li>
            <li class="active">Borrar Tipo de Insumo</li>
			
		  </ol>
		  <h1>
			Tipos de Insumo
		  </h1>

		  <p></p>
		</section>

        
		<!-- Main content -->
		<section class="content">

		  <!-- Default box -->
		  <div class="box">
			<div class="box-header with-border">
			  <h2 class="box-title">Borrar Tipo de Insumo</h2>

			</div>
			<div class="box-body">


<?php
      
       if (!isset($_GET['id']) and !isset($_POST['id_tipo']))
       {
           	echo "<div class=\"row margin-vertical-20 \">
           	         <div class=\"col-md-5 col-md-offset-3\">
           	        	<div class=\"alert alert-danger\" role=\"alert\">
					 		<span class=\"h3\"><span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"> </span><strong> {$msgs['pagina_noencontrada']}</strong></span>
				  		</div>
				     </div>
				   </div>";
			echo "<div class=\"row margin-vertical-20 \">
           	         <div class=\"col-md-5\">
           	             <div role=\"alert\">
			               <a href=\"listado.php\" class=\"label label-primary well\"><span class=\"h4\"><span class=\"glyphicon glyphicon-arrow-left\" aria-hidden=\"true\"></span> Regresar</span></a>
			             </div>
			         </div>
				  </div>";				
 	
       }
	   else {
	   	 //Se busca el registro de la página solicitada
	   	 
	   	       
         require_once ($CFG->dirroot_admin . '/lib/pdo_database/database.class.php');
		   $database = new DatabasePDO();   
           $qry="select * from tb_tipo_insumo where id_tipo=:id_tipo";		   
		   $database->query($qry);   //se prepara el query
		   
		   if (isset($_GET['id'])) {
		   		$database->bind(':id_tipo',$_GET['id'],PDO::PARAM_INT);
				$id_tipo=$_GET['id'];
		   }
		   elseif (isset($_POST['id_tipo'])) {
		   		$database->bind(':id_tipo',$_POST['id_tipo'],PDO::PARAM_INT);
				$id_tipo=$_POST['id_tipo'];
		   }

		   //Se ejecuta el query
		   $row = $database->single();
		   if ($database->rowCount() >0) {
					extract($row);
		
		
		
		
				   // include the Zebra_Form class
				     require($CFG->dirroot_admin .'/lib/libform/Zebra_Form.php');
					 $form = new Zebra_Form('form-elementos', 'post', $_SERVER['PHP_SELF'], array('autocomplete' => 'off' ));
					 $form->language('espanol');
					 
					 
					 $form->clientside_validation(array(
						  'close_tips'                =>  true,      //  don't show a "close" button on tips with error messages
						  'on_ready'                  =>  false,      //  no function to be executed when the form is ready
						  'disable_upload_validation' =>  true,       //  using a custom plugin for managing file uploads
						  'scroll_to_error'           =>  true,      //  don't scroll the browser window to the error message
						  'tips_position'             =>  'right',    //  position tips with error messages to the right of the controls
						  'validate_on_the_fly'       =>  false,      //  don't validate controls on the fly
						  'validate_all'              =>  true,      //  show error messages one by one upon trying to submit an invalid form
					 ));
					 
					 $form->show_all_error_messages(true);
					 
					 
				        $form->add('hidden','id_tipo',$id_tipo);
						$form->add('hidden','id_nodo',$nodo);
						
				        // Tipo de Insumo
				        $form->add('label', 'lbl_Tipo', 'txt_Tipo', 'Tipo de Insumo :');
				        $obj = $form->add('text', 'txt_Tipo',$tipo_insumo,array('class' => 'form-control','style' => 'width:90% !important;','readonly' => true));
		
						    
				 
				        // Abreviatura
				        $form->add('label', 'lbl_Abreviatura', 'txt_Abreviatura', 'Abreviatura :');
				        $obj = $form->add('text', 'txt_Abreviatura',$abreviatura,array('class' => 'form-control','style' => 'width:90% !important;','readonly' => true));
						

					       
				
					    // Estado
					    $form->add('label', 'lbl_Estado', 'opt_Estado', 'Estatus :');
					    $obj = $form->add('radios', 'opt_Estado', array(
					        'A' =>  'Activo',
					        'I' =>  'Inactivo',
					    ),$estado,array('style' => 'width:30px;','aria-required' => true,'disabled' => true));


				
				        $form->add('submit', 'btnsubmit', 'Borrar ',array('class' =>'btn btn-success'));
						$form->add('button', 'btnback', 'Regresar ','button',array('class' =>'btn btn-success','onclick'=>'javascript:window.location = "'. $CFG->url_admin . '/modulos/mod_tipos_unidad_v1.0/listado.php"'));
						
				        
				        // validate the form
				        if ($form->validate()) {
				
							require_once("../../config.php");
							  require_once ($CFG->dirroot_admin . '/lib/pdo_database/database.class.php');
				
							   $database = new DatabasePDO();      
							   
							   // Checando si la unidad de medida esta siendo usada en algun insumo o en un concepto,
							   // si asi es entonces no se puede borrar la unidad de medida ya que podria haber problemas de integridad relacional
							   
							   $mensaje_error2=0;
							   $qry="select count(*) as cuantos_insumos from tb_insumos_basicos where tipo_insumo=:id_tipo";
							   $database->query($qry);   //se prepara el query			   
							   $database->bind(':id_tipo',$_POST['id_tipo'],PDO::PARAM_INT);	
							   $row = $database->single();	
							   if ($database->rowCount()>0) {
									extract($row);
									if ($cuantos_insumos>0) {
										   $mensaje_error2.=$msgs['unidad_con_insumo'];
									}								  
							   }	
								else {
									$cuantos_insumos=999999;
									$mensaje_error2.=$msgs['fallo_verificar_registros'];
								}	
								

                               if ($cuantos_insumos>0) {
								    echo "<div class=\"row margin-vertical-20\">
											<div class=\"col-md-5 col-md-offset-3\">
												<div class=\"alert alert-danger\" role=\"alert\">
														<span class=\"h3\"><span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"> </span><strong> $mensaje_error2</strong></span>
														
												</div>
											</div>
										  </div>";
							   }							   
							   if (($cuantos_insumos == 0) and ($cuantos_conceptos == 0)  ) {
								   //--- borrando disciplinas 
								   $qry="delete from tb_tipo_insumo where id_tipo=:id_tipo";
								   
								   error_reporting(0);
								   $database->query($qry);   //se prepara el query			   
								   $database->bind(':id_tipo',$_POST['id_tipo'],PDO::PARAM_INT);									  
								   
												   
								   //Se ejecuta el query
						
								 
								   if ($database->execute()) {
										
										//Se ajusta el url amigable del nodo
										require_once ($CFG->dirroot_admin . '/includes/admin_nodo.inc.php');
										$nodo=$_POST['id_nodo'];
										$tipo_contenido="tipo_unidad";
										
										borra_nodo($nodo,$tipo_contenido);
										
										echo "<div class=\"row margin-vertical-20\">
												 <div class=\"col-md-5 col-md-offset-3\">
													  <div class=\"alert alert-success\" role=\"alert\">
														  <span class=\"h3\"><span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span><strong> {$msgs['borrado_exito']}</strong><br />
														  <div id=\"datos_nodo\">
															  <span class=\"negritas\">Nodo: </span>$nodo
															   
														  </div>
													   </div>
												 </div>
											  </div>";	
											  
													
											  
									 }
									 else {
										echo "<div class=\"row margin-vertical-20\">
												 <div class=\"col-md-5 col-md-offset-3\">
													<div class=\"alert alert-danger\" role=\"alert\">
														<span class=\"h3\"><span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"> </span><strong>  {$msgs['borrado_error']}</strong></span>
													</div>
												 </div>
											  </div>";

									 }
									 // ---------------
								 
								}
							
								echo "<div class=\"row margin-vertical-20 \">
					           	         <div class=\"col-md-5\">
					           	             <div role=\"alert\">
								               <a href=\"listado.php\" class=\"label label-primary well\"><span class=\"h4\"><span class=\"glyphicon glyphicon-arrow-left\" aria-hidden=\"true\"></span> Regresar</span></a>
								             </div>
								         </div>
									  </div>";	
				
						}
						else {
							$form->render('templates/template-agregar_tipo.php');
						}
			    } // fin del if donde se busco la página y si se encontro
			    else {   //No se encontro la página
				    echo "<div class=\"row margin-vertical-20\">
           	                 <div class=\"col-md-5 col-md-offset-3\">
           	        	         <div class=\"alert alert-danger\" role=\"alert\">
					 		           <span class=\"h3\"><span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"> </span><strong> {$msgs['pagina_noencontrada']}</strong></span>
				  		         </div>
				             </div>
				         </div>";
					echo "<div class=\"row margin-vertical-20 \">
		           	         <div class=\"col-md-5\">
		           	             <div role=\"alert\">
					               <a href=\"listado.php\" class=\"label label-primary well\"><span class=\"h4\"><span class=\"glyphicon glyphicon-arrow-left\" aria-hidden=\"true\"></span> Regresar</span></a>
					             </div>
					         </div>
						  </div>";	
					
				}

			}

?>





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

	  

<!-- load Zebra_Form's JavaScript file -->
<script src="<?php echo $CFG->url_admin; ?>/lib/libform/js/zebra_form.js"></script>
<script type="text/javascript" src="<?php echo $CFG->url_admin;?>/lib/Zebra_Dialog-master/javascript/zebra_dialog.js"></script> 


<div class="black_overlay">
<div id="load"><img src="<?php echo $CFG->url_admin;?>/imagenes/trabajando-marnic.gif"/></div>
</div>

<script type="text/javascript">

$("#form-elementos").submit(function(e){
	e.preventDefault();	
	$(".black_overlay").show();	
		$.Zebra_Dialog('¿Está seguro de borrar el Tipo de Insumo?', {
			'type':     'question',
			'title':    'Confirmar borrado',
			'buttons':  [
							{caption: 'Si', callback: function() { 	
							    					
						        $("#form-elementos")[0].submit();
						        	 
						        return; 
						        $(".black_overlay").hide();	
						
							}},
							{caption: 'No', callback: function() { 
							    e.preventDefault();
							    $(".black_overlay").hide();	
        						return;
							}},
						]
		});	
	
	

});

</script>

</body>
</html>