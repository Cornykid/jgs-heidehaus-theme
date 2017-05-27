<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="//www.google-analytics.com" rel="dns-prefetch">

	<?php wp_head(); ?>
	<script>
    // conditionizr.com
    // configure environment tests
    conditionizr.config({
        assets: '<?php echo get_template_directory_uri(); ?>',
        tests: {}
    });
    </script>
</head>

<body <?php body_class(); ?>>
	<div class="container-fluid">
		<div class="row">
			<section class="content">
				<header class="header" role="banner">
					<?php get_template_part('partials/header/logo-container'); ?>
					<?php get_template_part('partials/slider'); ?>
					<?php get_template_part('partials/navigations/main-desktop'); ?>
				</header>
				
				<main class="main">