<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	if ( ! function_exists('fDateToSave')){
		function fDateToSave($date){
			return substr($date, 6, 4).'-'.substr($date, 3, 2).'-'.substr($date, 0, 2);
		}	
	}
	if ( ! function_exists('fDateToDisplay')){
		function fDateToDisplay($tarikh){
			//$tarikh = "2003-02-11";
			$hari = substr($tarikh, 8, 2);
			$bulan = substr($tarikh, 5, 2);
			$tahun = substr($tarikh, 0, 4);
			return $tarikh = $hari."-".$bulan."-".$tahun . "  " . substr($tarikh,11,9);
		}	
	}
	
	
	
	
?>