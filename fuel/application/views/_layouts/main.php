<?php 
	if(isset($views)){
		$this->load->view($views);
	}
	else
	{
		define('FUELIFY', FALSE);
		echo fuel_var('body', '');
	}
?>