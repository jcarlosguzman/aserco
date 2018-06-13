<?php
#Genera los registros para poblar la tabla de listado de unidades
#
#
#Id: response_unidades.php Ver. 1.0
#
# Control de Cambios:
# (agregar los cambios con el siguiente formato:  Fecha, Autor, Descripci?n del cambio)
#
# 27/12/2017. Version inicial.
#


error_reporting(0);

require_once("../../config.php");

require_once($CFG->dirroot_admin . '/lee_parametros.inc.php');

require_once($CFG->dirroot_admin . '/permisos.inc.php');

$myACL = new ACL();
if ($myACL->hasPermission('admin_tipo_insumo') != true)  // Se verifica los permisos para ver esta p�gina
{
	$location=$CFG->url_admin . "sin_permiso.php";
	header($location);
}

require_once ($CFG->dirroot_admin . "/lib/pdo_database/database.class.php");
$database = new DatabasePDO(); 
	 
// inicializando variables
$params =  $totalRecords = $data = array();
$sqlTot = $sqlRec = $where = "";
$tabla_miembros="tb_tipo_insumo";   //Cambiar para ajustar al nombre de la tabla para las paginas (MYSQL)

$params = $_REQUEST;
$limit = $params["rowCount"];

// Se determina la p�ginaci�n de la tabla
if (isset($params["current"])) { $page  = $params["current"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;

// Se realiza la busqueda de la frase proporcionada en el cuadro "Buscar". Inlcuir todas las columnas en las cuales se intenta buscar.

if( !empty($params['searchPhrase']) ) {   
	$where .=" WHERE ";
	$where .=" ( upper(x.tipo_insumo) LIKE '%" . strtoupper($params['searchPhrase']) . "%' ";    
	$where .=" OR x.abreviatura LIKE '%".$params['searchPhrase']."%' )";
	$where .=" OR x.estado LIKE '%".$params['searchPhrase']."%' )";
}


// Se calcula el numero total de registros sin considerar alguna busqueda la cual modificaria el resultado ya que se mostrarian los registros filtrados

//Se hace un query anidado para que pueda buscar en la columna "publicado" que es considerada como columna calculada, sino la nueva columna no es detectada en el Where y marca error
//$sql = "select * from (SELECT id_miembro,nombre_miembro,m.id_tipo_miembro,tipo_miembro,case estado when 'N' then 'No Pub.' when 'P' then 'Publicado' end publicado FROM $tabla_miembros) x";

/*$sql_total = "select * from (SELECT mi_id_clave,mi_nombre,case activo when 'N' then 'Inactivo.' when 'S' then 'Activo' end estado 
                       FROM tb_miembros) x";*/
					   					   
					  
$sql= "select * from (select id_tipo,tipo_insumo,abreviatura,case estado when 'I' then 'Inactivo' when 'A' then 'Activo' end estado
						from tb_tipo_insumo) x ";				   

$sqlTot = $sql;		//SQl para el total de registros	
$sqlRec = $sql;		// SQL para obtener el detalle de los registros	


//concatenate search sql if value exist
if(isset($where) && $where != '') {
	$sqlTot .= $where;
	$sqlRec .= $where;
}

$sortArray=$params['sort'];
$colToOrder=array_keys($sortArray);
$orderToOrder=array_values($sortArray);
$sqlRec .=  " ORDER BY ". $colToOrder[0] ."   ". $orderToOrder[0];
$sqlTot .=  " ORDER BY ". $colToOrder[0] ."   ". $orderToOrder[0];

//Se ajusta el limite de registros a mostrar por cada pagina en la tabla, solo aplica para los registros mostrados y no para el total de registros
if ($limit!=-1) {
	$sqlRec .= " LIMIT $start_from, $limit";
}

//Ejecutando el query para sacar el total de registros a mostrar, no se "atrapan" los registros ya que solo se requiere saber el numero de ellos

$database->query($sqlTot);   //se prepara el query

//$database->bind(':grupo',$_POST['id_disciplina'],PDO::PARAM_INT);	

$database->resultset();		     // Se ejecuta el query
$totalRecords=$database->rowcount();    //Se lee la cantidad de registros obtenidos

//Se ejecuta el query para el detalle de los registros


$database->query($sqlRec);   //se prepara el query
//$database->bind(':grupo',$_POST['id_disciplina'],PDO::PARAM_INT);
$queryRecords = $database->resultset();		   //Se ejecuta el query
	 
//iterate on results row and create new index array of data
if ($database->rowcount()>0) {
    foreach ($queryRecords as $row) {
	   	$data[] = $row;
	}
}

$json_data = array(
		"current"            => intval( $params['current'] ), 
		"rowCount"            => 10, 			
		"total"    => intval( $totalRecords ),
		"rows"            => $data   // total data array
		);

echo json_encode($json_data);  // send data as json format
?>
	