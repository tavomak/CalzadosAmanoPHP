<?php
      	/* variables paginador */

		$window = 5; //cantidad maxima de paginas a los lados de la central (x x x A y y y)
		$page = $_SERVER['PHP_SELF'].'?'; //pagina a la cual se debe redireccionar (por lo general a esta misma

		if(isset($_REQUEST["clave"])){
			$clave = $_REQUEST["clave"];
		}
		$ini = isset($_REQUEST["ini"]) ? $_REQUEST['ini'] : 0;
		tep_db_connect();
		$lista = searchList($criterio,$order,$ini,$cant,"*",$table); //arreglo con la data a paginar
		$total = count(searchList($criterio,NULL,0,NULL,"*",$table)); //cuantos registros hay en total
		tep_db_close();
		$parc = count($lista); //cuantos registros se trajeron
		$pages = ceil($total/$cant); //cuantas paginas se van a generar
		$actual = ceil($ini/$cant) + 1; //en cual pagina estoy parado
		if(max($actual - $window,1) == 1){
			$li = 1;
			$ls = min($pages,(2 * $window) + 1);
		}else if(min($actual + $window,$pages) == $pages){
			$li = max(1,min($pages - (2 * $window),$pages));
			$ls = $pages;
		}else{
			$li = max($actual-$window,1);
			$ls = min($actual+$window,$pages);
		}
		/* fin paginador */
	  ?>
