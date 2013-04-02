<?php
session_start();
if($_SESSION['login'] != true){
  header("Location: http://localhost/wordpress/");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>LUMS Carpooling System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Abdul Aleem Khan">
    
	<link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">
	
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
	<?php wp_enqueue_script("jquery"); ?>
    <?php wp_head(); ?>
	
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner"> 
			<div class="container"> 
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> 
					<span class="icon-bar"></span> 
					<span class="icon-bar"></span> 
					<span class="icon-bar"></span> 
				</a> 
				<a class="brand" href="<?php echo site_url(); ?>"><?php bloginfo('name'); ?></a> 
				<div class="nav-collapse collapse"> 
					<ul class="nav"> 
						<?php wp_list_pages(array('title_li' => '')); ?>
					</ul>
					<div class="btn-group">
						<a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i> User</a>
						<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#"><i class="icon-pencil"></i> Edit</a></li>
							<li><a href="#"><i class="icon-trash"></i> Delete</a></li>
							<li><a href="#"><i class="icon-ban-circle"></i> Ban</a></li>
							<li class="divider"></li>
							<li><a href="#"><i class="icon-off"></i>logout</a></li>
						</ul>
					</div>
				</div><!--/.nav-collapse --> 
			</div> 
		</div> 
	</div>
	
    <div class="container">
		
		<div class="hero-unit" >
			
		</div>
		
		
		