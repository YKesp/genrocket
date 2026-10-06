<?php /* Template Name: Test */ ?>
<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
?>
<?php
$current_archive = '';
if(is_archive() && is_tax( 'newsletter-category')){
	$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
	if ($term) {
		$current_archive = $term->name;
	}
}
$page_id = get_the_ID();
$meta_title = get_field('meta_title_cs', get_the_ID());
$meta_description = get_field('meta_description', get_the_ID()).' - '.$current_archive;
$meta_keywords = get_field('meta_keywords', get_the_ID());
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-0X5R36FF51"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'G-0X5R36FF51');
	</script>
	<?php
	if(is_tax( 'newsletter-category' )){ 
		$queried_object = get_queried_object();
		$term_name = $queried_object->name; ?>
		<title><?php echo $meta_title.' - '.$term_name; ?></title>
	<?php }
	else { ?>
		<title><?php echo !empty($meta_title)?$meta_title:'GenRocket'; ?></title>
		<?php
	}
	if(!empty($meta_description)){ ?>
		<meta name="description" content="<?php echo $meta_description; ?>" />
	<?php } if(!empty($meta_keywords)){ ?>
		<meta name="keywords" content="<?php the_field('meta_keywords', get_the_ID()); ?>" />
	<?php }
	the_field('meta_box');
	the_field('meta_open_graphs'); ?>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
	<?php
	if ( is_front_page() ) { ?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/home-new.css?v4.3">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/new-design.css?v4.3">
		<?php } elseif(is_page(7794)) { ?><!-- is_page(5022) -->
		<meta name="robots" content="noindex, nofollow">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/home-new.css?v4.3">
		<?php } elseif(is_page(8469)) { ?><!-- is_page(5022) -->
		<meta name="robots" content="noindex, nofollow">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/home-new.css?v4.3">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/new-design.css?v4.3">
	<?php } else { ?>
		<link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
		<link type="text/css" rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/style.css" media="all">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/all-new.css?v4.1">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/new-design.css?v4.2">
	<?php } ?>
	<?php wp_head(); ?>
	<style type="text/css" media="all">#wpadminbar { display:block !important; }#wpforms-7863{margin: 0 !important;}</style>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-32344187-1"></script>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<!--body-->
	<div id="wrapper">
			<?php  $page_id = get_the_ID(); if($page_id != 45) { ?>
			<?php get_template_part( 'inc/demo-form' ); } ?>
			<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
			<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
			<!-- Include all compiled plugins (below), or include individual files as needed -->
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
			<script src="<?php bloginfo('template_url'); ?>/assets/js/jquery.main.js"></script>
			<?php wp_footer(); ?>
	</div>
</body>
</html>