<?php

class Dao{
//------ Funciones de abstraccion de consultas SQL ---------------------
    function __construct() {
        ;
    }
    
  /* ~ 
  .---------------------------------------------------------------------------.
  |  INSERTS        CLIENTE                                                   |
  | ------------------------------------------------------------------------- |
  */
//-INSERT- $columns=get_commas(...)   $values=get_commas(...)
function get_insert($table, $columns, $values){
	return "INSERT INTO $table ($columns) VALUES ($values)";
}


function get_insert_return_id($table, $columns, $values, $id){
	return "INSERT INTO $table ($columns) VALUES ($values) RETURNING $id";
}
 /* ~ 
  .---------------------------------------------------------------------------.
  | UPDATE                                                                    |
  | ------------------------------------------------------------------------- |
  */

//-UPDATE- $values=get_mult_set(...)   $where=get_mult_set(...) o get_simp_set(...)
function get_update($table, $values, $where){
	return "UPDATE $table SET $values WHERE $where";
}

//-UPDATE- actualiza una tabla con valores de otra (sólo MySQL >4.xx)
function get_update_join($table_a, $table_b, $id_a, $id_b, $values, $where=''){
	if($where!='')
         $where="AND ($where)";
	return "UPDATE $table_a a, $table_b b SET $values WHERE a.$id_a=b.$id_b $where";
}// 

 function get_UpdateTable($nombreTabla, $arregloDatos, $criterio) {
        //$sql: Variable que construye el SQL
        $sql = "update $nombreTabla set ";
        $datos = '';
        // Para llevar el arreglo de a su primer valor
        reset($arregloDatos);
        // Para moverme dentro del arrays
        foreach ($arregloDatos as $campo => $valor) {
            $sql .= ' ' . $campo . ' = \'' . $valor . '\',';
        }
        $sql = substr($sql, 0, strlen($sql) - 1);
        // Se verifica que existe un criterio
        if ($criterio) {
            $datos .= ' where ';
            reset($criterio);
            foreach ($criterio as $campo => $valor) {
                $datos .= ' ' . $campo . ' = \'' . $valor . '\' and ';
            }
            $datos = substr($datos, 0, strlen($datos) - 4);
        }
        $sql.= $datos;
        if (!@pg_query($sql)) {
             echo "<script language='JavaScript'> alert('Error 0502: Error en la Funcion fdbUpdate,<br>Al momento de realizar la modificacion, No se logro con Exito') 
                         location.href = '../AdminMenuPrincipal.php';  exit();
                         </script> ";
           
            exit;
        }
    }
    
 /* ~ 
  .---------------------------------------------------------------------------.
  | SELECT                                                                    |
  | ------------------------------------------------------------------------- |
  */
//-SELECT- $columns=get_commas(...) o '*'   $where=get_mult_set(...) o get_simp_set(...)
function get_select($table, $columns, $where='', $order=''){
	$tmp = "SELECT $columns FROM $table";
	if($where!=''){
		$tmp.=" WHERE $where";
	}
	if($order!=''){
		$tmp.=" ORDER BY $order ASC";
	}
	return $tmp;
}
function get_selectT($table, $columns, $where=''){
	$tmp = "SELECT $columns FROM $table";
	if($where!=''){
		$tmp.=" WHERE $where";
	}
	
	return $tmp;
}


function get_select_having($table, $columns, $having='', $where = '', $order = ''){
	$tmp = "SELECT $columns FROM $table";
	if($where!=''){
		$tmp.=" WHERE $where";
	}
	if($order!=''){
		$tmp.=" ORDER BY $order";
	}
        if($having!=''){
		$tmp.=" HAVING  $having";
	}
	return $tmp;
}

function get_select_And($table, $columns, $where='', $and=''){
	$tmp = "SELECT $columns FROM $table";
	if($where!=''){
		$tmp.=" WHERE $where";
	}
	if($and!=''){
		$tmp.=" AND $where";
	}
	return $tmp;
}


//-SELECT- entre 2 tablas por 2 indices comunes
function get_select_join($table_a, $table_b, $id_a, $id_b, $columns, $where='', $order=''){
	$table ="$table_a a, $table_b b";
	$w="a.$id_a=b.$id_b ";
	if($where!='')	$w.="AND ($where)";
	return get_select($table, $columns, $w, $order);
}

function get_select_join_tres_tablas($table_a, $table_b,$table_c, $id_a, $id_b, $id_c,$columns, $where=''){
	$table ="$table_a a, $table_b b";
	$w="a.$id_a=b.$id_b
            c.$id_b=$where"  ;
	if($where!='')	$w.="AND ($where)";
	return get_select($table, $columns, $w, $where);
}
 /* ~ 
  .---------------------------------------------------------------------------.
  | DELETE                                                                    |
  | ------------------------------------------------------------------------- |
  */

//-DELETE-  $where=get_mult_set(...) o get_simp_set(...)
function get_delete($table, $where=''){
	$tmp = "DELETE FROM $table";
	if($where!=''){
		$tmp.=" WHERE $where";
	}
	return $tmp;
}


 /* ~ 
  .---------------------------------------------------------------------------.
  | COMPLEMENTO DE LAS OTRAS CONSULTAS                                        |
  | ------------------------------------------------------------------------- |
  */
//- get_commas(true|false, 1, 2, 4...) true pone comillas  => '1','2','4'...
function get_commas(){
	$a=func_get_args();
	$com = $a[0];
	return get_commasA(array_slice($a, 1, count($a)-1), $com);
}
//- como la anterior pero devuelve entre comas el array pasado
function get_commasA($arr_in, $comillas=true){
	$temp='';
	$coma="'";
	if(!$comillas) $coma=''; //-el 1er param==true, metemos comas

	foreach($arr_in as $arg){
	   if($temp!='')  $temp.=","; 
	   if(substr($arg,0,2)=='!!'){ //- Si empieza por !! no le pongo comas...
			$temp.=substr($arg,2); continue;
	   }
	   $temp.="$coma".$arg."$coma";
	}
	return $temp;
}

//- Devuelve una asignacion (por defecto) simple entre comillas  X='1' 
function get_simp_set($col, $val, $sign='=', $comillas=true){
	$cm="'";
	if(!$comillas) $cm='';
	if(substr($val,0,2)=='!!'){ //- Si empieza por !! no le pongo comas...
		$val=substr($val,2); $cm='';
	}
	return $col."$sign $cm".$val."$cm";
}

//-Mezcla cada valor de $a_cols, con uno de $a_vals   "X='1', T='2'...
//- ej:  con $simb='or'  X='1' or T='2'...
//- ej:  con $sign='>'   X>'1' or T>'2'...
function get_mult_set($a_cols, $a_vals, $simb=',', $sign='=', $comillas=true){
	$temp='';
	for($x=0;$x<count($a_cols);$x++){
		if($temp!='')  $temp.=" $simb ";
	   $temp.= get_simp_set($a_cols[$x],$a_vals[$x], $sign, $comillas);
	}
	return $temp;
}

function get_between($col, $min, $max){
	return "($col BETWEEN $min AND $max)";
}

/* ~ 
  .---------------------------------------------------------------------------.
  | FIN DE COMPLEMENTO DE LAS OTRAS CONSULTAS                                        |
  | ------------------------------------------------------------------------- |
  */
}

?>