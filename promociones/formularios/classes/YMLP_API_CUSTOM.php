<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2012
 */
//incluimos el api de YMLP
require_once 'YMLP_API.class.php';

class YMLP_API_CUSTOM extends YMLP_API{

	function ListaGrupos($nombreGrupo){
		$resultados = $this->GroupsGetList();
		// output results
		if ($this->ErrorMessage){
			//echo "There's a connection problem: " . $this->ErrorMessage;
			return FALSE;
		} else {
			if (isset($resultados["Code"])) return FALSE;//echo "{$resultados["Code"]} => {$resultados["Output"]}";
			else foreach ($resultados as $item) {
					if($item['GroupName']==$nombreGrupo) return $item['ID'];
				}
		}
	}

	function AgregarALista($email, $id_grupo, $grupo){
		$class = new stdClass;
		$class->success = FALSE;

		if($id_grupo>0){//verificando que el grupo sea mayor a 0(grupo valido)
			$OtherFields["Field2"]="Dummy Field2";
			$output = $this->ContactsAdd($email,$OtherFields,$id_grupo,0);
			// output results
			if ($this->ErrorMessage){
				//echo "There's a connection problem: " . $this->ErrorMessage;
				$class->success = FALSE;
				$class->errorMessage = $this->ErrorMessage;
				return $class;
			} else {
				//echo "{$output["Code"]} => {$output["Output"]}";
				$class->success = TRUE;
				$class->successCode = $output[ 'Code' ];
				$class->successMessage = $output[ 'Output' ];
				return $class;
			}
		}
		else {//el grupo es igual a 0
			$class->success = FALSE;
			$class->errorMessage = 'El nombre del grupo[ ' . $grupo . ' ] no es válido, es necesario darse de alta.';
			return $class;
		}
	}

	function BorrarDeLista($email, $id_grupo){
		$output = $this->ContactsDelete($email,$id_grupo);
		// output results
		if ($this->ErrorMessage){
			//echo "There's a connection problem: " . $api->ErrorMessage;
			return FALSE;
		} else {
			//echo "{$output["Code"]} => {$output["Output"]}";
			return TRUE;
		}
	}
}

?>