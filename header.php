<!doctype html>

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>
<?php if ( !is_front_page() ) { echo wp_title( ' ', true, 'left' ); echo ' | '; }
			echo bloginfo( 'name' ); echo ' - '; bloginfo( 'description', 'display' );  ?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- icons & favicons -->
<!-- For iPhone 4 -->
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/library/images/icons/h/apple-touch-icon.png">
<!-- For iPad 1-->
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/library/images/icons/m/apple-touch-icon.png">
<!-- For iPhone 3G, iPod Touch and Android -->
<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/library/images/icons/l/apple-touch-icon-precomposed.png">
<!-- For Nokia -->
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/library/images/icons/l/apple-touch-icon.png">
<!-- For everything else -->
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">

<!-- media-queries.js (fallback) -->
<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>			
		<![endif]-->

<!-- html5.js -->
<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<link href='http://fonts.googleapis.com/css?family=Lato:400,900' rel='stylesheet' type='text/css'>
<!-- wordpress head functions -->
<?php wp_head(); ?>
<!-- end of wordpress head -->
<!--[if lt IE 9]>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/library/css/dumbo.css">
<![endif]-->
<!--[if IE 7]>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/library/css/font-awesome-ie7.css">
<![endif]-->

</head>

<body>
<div class="container" id="wrapper">
<header role="banner" id="top">
  <div id="inner-header" class="clearfix">
    <div class="row-fluid">
      <div class="search-collapse collapse pull-right mar-half-b" id="search-collapse">
        <form class="navbar-search" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
          <label for="s"><span class="hidden">Search</span></label><input name="s" id="s" type="text" class="search-query" autocomplete="off" placeholder="<?php _e('Search','summertheme'); ?>" data-provide="typeahead" data-items="4" data-source='<?php echo $typeahead_data; ?>'>
        </form>
      </div>
    </div>
    
    
      <div id="utility-navigation"><div class="row-fluid pad-one-b">
        <nav id="utility"><a data-toggle="collapse" data-target="#search-collapse" class="utility-search">Search <i class="icon-search"></i></a>
			<?php if(! is_front_page()){ ?>
          <a href="#sidebar-nav" class="pull-right visible-phone clearfix" id="to-menu">Main Menu <i class="icon-circle-arrow-down"></i></a>
            <? } ?>
          <div class="visible-desktop">
            <?php summer_utility(); // Adjust using Menus in Wordpress Admin ?>
          </div>
          
        </nav>
      </div>
    </div>
    <div id="logo" role="banner">
      <div class="branding"> <a title="<?php echo get_bloginfo('name'); ?>" href="<?php echo home_url(); ?>"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/library/img/summerSU_logo.png" alt="<?php bloginfo( 'name' ); ?>" /><h1 class="hidden"><?php bloginfo( 'name' ); ?></h1></a></div>
    </div>
  </div>
  <!-- end #inner-header --> 
</header>
<!-- end header -->

<div class="row-fluid">
