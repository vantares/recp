<?php
//print_r($_REQUEST);
if ($_REQUEST['action'] == 'imprimir') {
	switch ($_REQUEST['tipo']) {
		case 'matrimonio':
			require("../actas/data/insc_data_mat.php");
			break;
		case 'defuncion':
			require("../actas/data/insc_data_def.php");
			break;
		case 'nacimiento':
			require("../actas/data/insc_data_nac.php");
			break;
		case 'disolucionmatrimonio':
			require("../actas/data/insc_data_dis.php");
			break;
		case 'inscripcionvaria':
			require("../actas/data/insc_data_var.php");
			break;
		default:
			break;
	}
}
?>
