<?php

function setExcelContentType(){
	if (headers_sent()){
		return false;
	}

	header('Content-type: application/vnd.ms-excel');
	return true;
}

function setDownloadAsHeader($filename){
	if (headers_sent()){
		return false;
	}

	header('Content-disposition: attachment; filename='.$filename);
	return true;
}

function csvFromResult($stream,$result,$showColumnHeaders=true){
	if ($showColumnHeaders){
		$columnHeaders=array();
		$nfields=mysql_num_fields($result);
		for ($i=0; $i<$nfields; $i++){
			$field=mysql_fetch_field($result,$i);
			$columnHeaders[]=$field->name;
		}
		fputcsv($stream,$columnHeaders,";");
	}

	$nrows=0;
	while($row=mysql_fetch_row($result)){
		fputcsv($stream,$row,";");
		$nrows++;
	}

	return $nrows;
}

function csvFileFromResult($filename,$result,$showColumnHeaders=true){
	$fp=fopen($filename,'w');
	$rc=csvFromResult($fp,$result,$showColumnHeaders);
	fclose($fp);
	return $rc;
}

function csvToExcelDownloadFromResult($result,$showColumnHeaders=true,$asFilename='suscritos.csv'){
	setExcelContentType();
	setDownloadAsHeader($asFilename);
	return csvFileFromResult('php://output',$result,$showColumnHeaders);
}


	include "../../include/configure.php";
	include "../../include/database_tables.php";
	include "../../include/functions/database.php";

tep_db_connect();



$result = mysql_query("SELECT * FROM " . TABLE_USUARIO . " WHERE empleado='3'" );
tep_db_close();
csvToExcelDownloadFromResult($result,true,'csv/suscritos.csv');

?>
