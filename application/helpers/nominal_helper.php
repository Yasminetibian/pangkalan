<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('nominal')) {
	function nominal($angka){
		$jd = "Rp. ".number_format($angka, 0, ',', '.');
		return $jd;
	}
	function nominal_kg($angka){
		$jd = number_format($angka, 0, ',', '.')." Kg ";
		return $jd;
	}
	function jam($angka){
		$jd = number_format($angka, 0, ',', '.')." Jam ";
		return $jd;
	}



	function tgl_indo($tgl){
	$tanggal = substr($tgl,8,2);
	$bulan = getBulan(substr($tgl,5,2));
	$tahun = substr($tgl,0,4);

	return $tanggal.' '.$bulan.' '.$tahun;
}
function getBulan($bln){

	switch ($bln) {
		case 1:
			return "Januari";
			break;
		case 2:
			return "Februari";
			break;
		case 3:
			return "Maret";
			break;
		case 4:
			return "April";
			break;
		case 5:
			return "Mai";
			break;
		case 6:
			return "Juni";
			break;
		case 7:
			return "Juli";
			break;
		case 8:
			return "Agustus";
			break;
		case 9:
			return "September";
			break;
		case 10:
			return "Oktober";
			break;
		case 11:
			return "November";
			break;
		case 12:
			return "Desember";
			break;
	}
}

 function filter($a)
{
	echo htmlentities($a, ENT_QUOTES,'UTF-8');
}

}



?>