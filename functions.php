<?php 
	function wpbootstrap_scripts_with_jquery() 
	{ 
		// Register the script like this for a theme: 
		wp_register_script( 'custom-script', get_template_directory_uri() . '/bootstrap/js/bootstrap.js', array( 'jquery' ) ); 
		// For either a plugin or a theme, you can then enqueue the script: 
		wp_enqueue_script( 'custom-script' ); 
		
	} 
	
<<<<<<< HEAD
	add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );
	include_once (TEMPLATEPATH . '/carpool_functions.php');
	
?>



=======
	add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' ); 
?>
>>>>>>> cc259aba2809bd9a42aedeef884438f8ec3851a9
