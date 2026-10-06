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
    /*elseif (is_post_type_archive()) {
      echo get_queried_object()->labels->name;
    } elseif (is_day()) {
      printf(__('Daily Archives: %s', 'roots'), get_the_date());
    } elseif (is_month()) {
      printf(__('Monthly Archives: %s', 'roots'), get_the_date('F Y'));
    } elseif (is_year()) {
      printf(__('Yearly Archives: %s', 'roots'), get_the_date('Y'));
    } elseif (is_author()) {
      $author = get_queried_object();
      printf(__('Author Archives: %s', 'roots'), $author->display_name);
    } else {
      single_cat_title();
    }*/
 }
 
$page_id = get_the_ID();
	
$meta_title = get_field('meta_title_cs', get_the_ID());
$meta_description = get_field('meta_description', get_the_ID()).' - '.$current_archive;
$meta_keywords = get_field('meta_keywords', get_the_ID());
 
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    
    <!-- Open Graph / Social Sharing -->
<meta property="og:type" content="website">
<meta property="og:url" content="https://www.genrocket.com/">
<meta property="og:site_name" content="GenRocket">

<meta property="og:title" content="GenRocket | Design-Driven Synthetic Test Data">
<meta property="og:description" content="GenRocket delivers secure, high-quality synthetic test data on demand, helping enterprises improve software quality, increase test coverage, and accelerate development.">

<meta property="og:image" content="https://www.genrocket.com/wp-content/uploads/2026/09/genrocket-social-logo.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="627">
<meta property="og:image:alt" content="GenRocket - Design-Driven Synthetic Test Data">

<!-- X / Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="GenRocket | Design-Driven Synthetic Test Data">
<meta name="twitter:description" content="GenRocket delivers secure, high-quality synthetic test data on demand, helping enterprises improve software quality, increase test coverage, and accelerate development.">
<meta name="twitter:image" content="https://www.genrocket.com/wp-content/uploads/2026/09/genrocket-social-logo.jpg">
    
    <?php
    if($page_id==9540 || $page_id==9573 || $page_id==9612 || $page_id==7739 || $page_id==10027 || $page_id==10060 || $page_id==10065 || $page_id==367 || is_404()==true || is_search()==true)
    {  ?>
    <meta name="robots" content="noindex, nofollow">
    <?php }
    ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		if(is_tax( 'newsletter-category' )){ 
			$queried_object = get_queried_object();
			$term_name = $queried_object->name; 
			$category_id = $queried_object->term_id;
			//$metacategory_title = get_field('meta_title_cs', 'newsletter-category_' . $category_id);
			$metacategory_title = 'Newsletters';
			//$metacategory_description = get_field('meta_description', 'newsletter-category_' . $category_id);
			$metacategory_description = 'Newsletters';
	?>
	<title><?php echo $metacategory_title . ' - ' . $term_name; ?></title>
		<?php }
		else { ?>
	<title><?php echo !empty($meta_title)?$meta_title:'GenRocket'; ?></title>
		<?php } ?>
				<?php if(is_tax( 'newsletter-category' )){ ?>
	<meta name="description" content="<?php echo $metacategory_description .' - ' . $term_name; ?>" />
					<?php } else { ?>
							<?php if(!empty($meta_description)){ ?>
	<meta name="description" content="<?php echo $meta_description; ?>" />
							<?php } ?>
					<?php }  ?>
		<?php if(!empty($meta_keywords)){ ?>
	<meta name="keywords" content="<?php the_field('meta_keywords', get_the_ID()); ?>" />
		<?php }
		the_field('meta_box');
		the_field('meta_open_graphs'); ?>
		
		<?php
		
		if($page_id=='5022') 
		{ ?>
	<script type="application/ld+json">
			{
				"@context": "http://schema.org",
				"@id": "https://www.genrocket.com/#website",
				"@type": "WebSite",
				"url": "https://www.genrocket.com/",
				"name": "GenRocket",
				"potentialAction": {
					"@type": "SearchAction",
					"target": "https://www.genrocket.com/?src=mc_google&s={search_term_string}",
					"query-input": "required name=search_term_string"
				}
			}
	</script>
	<meta name="google-site-verification" content="FUkj6rILACVF2txkbYS8ND3SpgYM2QLQRLYjsMujY70" />
			<?php } ?>

			<?php if($page_id=='5164') { ?>
				<script type="application/ld+json">{
  "@context": "http://schema.org",
  "@type": "VideoObject",
  "name": "Demo Part 1 - Business Scenario 1",
  "description": "Demo Part 1 - Business Scenario 1 - X12 EDI Test Data Automation – Live Demonstration",
  "thumbnailUrl": "https://i.ytimg.com/vi/42ZKNns-o2E/default.jpg",
  "uploadDate": "2021-03-10T21:37:05Z",
  "duration": "PT5M21S",
  "embedUrl": "https://www.youtube.com/embed/42ZKNns-o2E",
  "interactionCount": "82"
}</script>

<script type="application/ld+json">{
  "@context": "http://schema.org",
  "@type": "VideoObject",
  "name": "Demo Brief Introduction",
  "description": "Demo Executive Summary - X12 EDI Test Data Automation – Live Demonstration",
  "thumbnailUrl": "https://i.ytimg.com/vi/XKXBgG9I-RI/default.jpg",
  "uploadDate": "2021-03-10T21:32:57Z",
  "duration": "PT2M56S",
  "embedUrl": "https://www.youtube.com/embed/XKXBgG9I-RI",
  "interactionCount": "126"
}</script>

<script type="application/ld+json">{
  "@context": "http://schema.org",
  "@type": "VideoObject",
  "name": "Demo Executive Summary",
  "description": "Demo Executive Summary - X12 EDI Test Data Automation",
  "thumbnailUrl": "https://i.ytimg.com/vi/3IzdHUJ5gb4/default.jpg",
  "uploadDate": "2021-03-10T21:24:20Z",
  "duration": "PT4M1S",
  "embedUrl": "https://www.youtube.com/embed/3IzdHUJ5gb4",
  "interactionCount": "182"
}</script>


<script type="application/ld+json">{
  "@context": "http://schema.org",
  "@type": "VideoObject",
  "name": "Demo Part 2  - Business Scenario 2",
  "description": "Demo Part 2  - Business Scenario 2 - X12 EDI Test Data Automation – Live Demonstration",
  "thumbnailUrl": "https://i.ytimg.com/vi/noqFf7ciwtI/default.jpg",
  "uploadDate": "2021-03-10T19:24:08Z",
  "duration": "PT1M46S",
  "embedUrl": "https://www.youtube.com/embed/noqFf7ciwtI",
  "interactionCount": "35"
}</script>

<script type="application/ld+json">{
  "@context": "http://schema.org",
  "@type": "VideoObject",
  "name": "Demo Part 3  - Business Scenario 5",
  "description": "Demo Part 3  - Business Scenario 5 - X12 EDI Test Data Automation – Live Demonstration",
  "thumbnailUrl": "https://i.ytimg.com/vi/e11-C4tApLg/default.jpg",
  "uploadDate": "2021-03-10T22:18:21Z",
  "duration": "PT8M1S",
  "embedUrl": "https://www.youtube.com/embed/e11-C4tApLg",
  "interactionCount": "42"
}</script>
	
			<?php } ?>
			<?php if($page_id=='4128') { ?>
				<script type="application/ld+json">{
  "@context": "http://schema.org",
  "@type": "VideoObject",
  "name": "GenRocket EDI Test Data Platform",
  "description": "GenRocket EDI Test Data Platform - Meeting the Challenge of X12 EDI Test Data",
  "thumbnailUrl": "https://i.ytimg.com/vi/ZFgn-OxUfCk/default.jpg",
  "uploadDate": "2019-10-22T15:33:59Z",
  "duration": "PT3M15S",
  "embedUrl": "https://www.youtube.com/embed/ZFgn-OxUfCk",
  "interactionCount": "428"
}</script>
				<?php } ?>
				<?php if($page_id=='4650') { ?>
					<script type="application/ld+json">{
  "@context": "http://schema.org",
  "@type": "VideoObject",
  "name": "Complete your Data Equation: Test Data Generation + Data Validation = Data Success",
  "description": "During this webinar, we tackle two major challenges to assuring your data quality:  - Test Data Generation - Data Validation  We illustrate how GenRocket and QuerySurge, used in conjunction, can solve these challenges. Also see how they can be easily integrated into your Continuous Integration / Continuous Delivery process.  Session Overview --------------------------------- Primary challenges organizations are facing with their data projects Key success factors for data validation & testing How to setup a workflow around test data generation and data validation using GenRocket & QuerySurge How to automate this workflow in your CI/CD process  The Goal ------------------------------- The keys to a successfully test data throughout your data architecture are the following :  To be able to validate the critical business rules and transformation logic being applied to the data  To be able to pinpoint where data defects were introduced in the architecture and link them back to the specification or data model  To be able to execute data tests as part of a Continuous Integration /Continuous Delivery pipeline  The 2 Main Issues -------------------------------------- There are two major challenges when dealing with data testing that need to be overcome to have a successful implementation  1) How do I generate the data needed to conduct the tests to be executed?  2) How do I execute the tests in an accurate and an efficient way that aligns with my testing cycle?   The Ideal Data Testing Strategy  ------------------------------------------------------ - Be able to accurately and rapidly generate all the data needed for the scenarios that need to be tested  - Be able to mask data to ensure data security  - Be able to validate large amounts of data quickly  - Be able to validate difficult transformation rules between the various source and target systems being tested  - Be able to be integrated into your build pipeline to achieve continuous testing  - Be able to store historical results and provide analytics  The Ideal Data Testing Solutions  ------------------------------------------------------ GenRocket & QuerySurge    About GenRocket  (www.GenRocket.com) -------------------------------- An Enterprise Test Data Automation Platform + Fast, secure, low cost, versatile, industry leading data quality + more than 9 years of development, refinement, customer experience + Recommended by top Global Systems Integrators + Customers across the world in 10 different vertical markets + Only Patented Test Data Platform(2017)  About QuerySurge (www.QuerySurge.com) ------------------------------ QuerySurge is the smart Data Testing solution that automates the data validation and testing of Big Data, Data Warehouses, Business Intelligence Reports and Enterprise Applications with full DevOps functionality for continuous testing.  Automated Data Testing Use Cases + Data Warehouse & ETL Testing + Big Data Testing + DevOps / Continuous Testing + Data Migration Testing + BI Report Testing + Enterprise App / ERP Testing  Challenges We Solve - Your need for data quality at speed. Validate up to 100% of all data up to 1,000 x faster than traditional testing.  - Your test automation issue. Now you can automate your data testing from the kickoff of tests to performing the validation to automated emailing of the results and updating your test management system.  -  Your ability to test across platforms, whether a Big Data lake, Data Warehouse, traditional database, NoSQL document store, BI reports, flat files, JSON files, SOAP or restful web services, xml, mainframe files, or any other data store.   - Your need to integrate for Continuous Testing. QuerySurge integrates with most Data Integration/ETL solutions, Build/Configuration solutions, and QA/ Test Management solutions to fit nicely into your DevOps or DataOps pipeline.   - Your ability to analyze your data, with our Data Analytics Dashboard & Data Intelligence Reports",
  "thumbnailUrl": "https://i.ytimg.com/vi/Zy25i74l-qo/default.jpg",
  "uploadDate": "2020-03-19T20:13:32Z",
  "duration": "PT1H1M59S",
  "embedUrl": "https://www.youtube.com/embed/Zy25i74l-qo",
  "interactionCount": "1527"
}</script>
					<?php } ?>
						<?php if($page_id=='4738') { ?>
							<script type="application/ld+json">{
  "@context": "http://schema.org",
  "@type": "VideoObject",
  "name": "GenRocket Bank Solutions Demo with Test Data Cases",
  "description": "GenRocket Bank Solutions Demo with Test Data Cases",
  "thumbnailUrl": "https://i.ytimg.com/vi/j-2GWGG3EVI/default.jpg",
  "uploadDate": "2020-05-19T19:53:49Z",
  "duration": "PT4M45S",
  "embedUrl": "https://www.youtube.com/embed/j-2GWGG3EVI",
  "interactionCount": "1773"
}</script>
							<?php } ?>
							<?php if($page_id=='8469') { ?>
								<script type="application/ld+json">{
  "@context": "http://schema.org",
  "@type": "VideoObject",
  "name": "Genrocket - The Future of Test Data Management",
  "description": "The Future of Test Data Management - GenRocket",
  "thumbnailUrl": "https://i.ytimg.com/vi/7JRUq_ylVpw/default.jpg",
  "uploadDate": "2023-06-28T14:41:06Z",
  "duration": "PT4M20S",
  "embedUrl": "https://www.youtube.com/embed/7JRUq_ylVpw",
  "interactionCount": "679"
}</script>

							<?php } ?>
							<?php if($page_id=='9342') { ?>
								<script type="application/ld+json">{
  "@context": "http://schema.org",
  "@type": "VideoObject",
  "name": "GenRocket Executive Briefing Video",
  "description": "GenRocket Executive Briefing Video",
  "thumbnailUrl": "https://i.ytimg.com/vi/qRfFfZvXgRk/default.jpg",
  "uploadDate": "2023-05-15T17:19:18Z",
  "duration": "PT12M9S",
  "embedUrl": "https://www.youtube.com/embed/qRfFfZvXgRk",
  "interactionCount": "203"
}</script>
							<?php } ?>

							<?php if($page_id=='9524') { ?>
								<script type="application/ld+json">{
  "@context": "http://schema.org",
  "@type": "VideoObject",
  "name": "The Future of Test Data Management",
  "description": "The Future of Test Data Management - GenRocket",
  "thumbnailUrl": "https://i.ytimg.com/vi/7JRUq_ylVpw/default.jpg",
  "uploadDate": "2023-06-28T14:41:06Z",
  "duration": "PT4M20S",
  "embedUrl": "https://www.youtube.com/embed/7JRUq_ylVpw",
  "interactionCount": "686"
}</script>
							<?php } ?>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
	<?php
		if ( is_front_page() ) { ?>
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/home-new.css?v4.8">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/new-design.css?v7.4">
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/homeupdated_style.css?v0.6">
	<?php /* ?>
    <?php } elseif(is_page(9397)) { ?><!-- is_page(5022) is_page(7794)-->
	<meta name="robots" content="noindex, nofollow">
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/home-new.css?v4.5">
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/new-design.css?v7.4">
	   	<?php } elseif(is_page(8469)) { ?><!-- is_page(5022) -->
	<meta name="robots" content="noindex, nofollow">
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/home-new.css?v4.5">
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/new-design.css?v7.4">
	   	<?php } elseif(is_page(10804)) { ?><!-- is_page(5022) -->
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/home-new.css?v4.7">
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/new-design.css?v7.4">
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/homeupdated_style.css?v0.6">
  <?php */ ?>
		<?php } elseif(is_page(11465)) { ?><!-- is_page(5022) -->
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/home-new.css?v4.8">
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/new-design.css?v7.4">
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/homeupdated_style.css?v0.6">
	   <?php } else { ?>
	<link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
	<link type="text/css" rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/style.css" media="all">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/all-new.css?v4.3">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/new-design.css?v7.4">
	<?php if(is_page(4298)) { ?><!-- is_page(5022) -->
	<meta name="robots" content="noindex, nofollow"> 
	<?php 	} ?>
	    <?php } ?>
<?php wp_head(); ?>
<style type="text/css" media="all">#wpadminbar { display:block !important; }#wpforms-7863{margin: 0 !important;}</style>

<script type='application/ld+json'> 
{
  "@context": "http://www.schema.org",
  "@type": "Organization",
  "name": "GenRocket inc",
  "url": "https://www.genrocket.com/",
  "sameAs": [
    "https://twitter.com/genrocketinc",
    "https://www.youtube.com/user/GenRocketINC",
    "https://www.linkedin.com/company/genrocket",
    "https://www.facebook.com/GenRocket/"
  ],
  "logo": "https://www.genrocket.com/wp-content/themes/genrocket/assets/images/logo.png",
  "image": "https://www.genrocket.com/wp-content/themes/genrocket/assets/images/tdgbanner1.png",
  "description": "GenRocket TDG is a fresh, new approach for provisioning secure, accurate, and controlled test data in high volume and on-demand. It’s the next generation of Test Data Management. GenRocket TDG creates any kind of test data on-the-fly, whenever it’s needed. There’s no gold copy test database to store and maintain. There’s no longer a need to mask or refresh test data sets. And there’s no extreme cost or complicated software to centrally manage. GenRocket replaces the cost and complexity of traditional Test Data Management with a low-cost, self-service paradigm for test data provisioning.\n\nTo understand GenRocket TDG, one must think differently about test data. Abandon the notion that all test data must either be copied from a production database or painfully created by hand in Excel spreadsheets.",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "2930 East Ojai Ave",
    "addressLocality": "Ojai",
    "addressRegion": "California",
    "postalCode": "93023",
    "addressCountry": "United States"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "805-836-2879",
    "contactType": "GenRocket Support"
  },
"aggregateRating": {
  "@type": "AggregateRating",
  "ratingValue": "5",
  "bestRating": "5",
  "worstRating": "1",
  "ratingCount": "1"
}
}
</script>
	
</head>

<body <?php body_class(); ?>>
	
<?php wp_body_open(); ?>
<!--body-->
	<div id="wrapper">
		<?php
if(get_the_ID() != 9540 && get_the_ID() != 9573 && $page_id != 9612 && $page_id != 10027 && $page_id != 10060 && $page_id != 10065){
	?>
    <header id="newheader" class="header no-print">
      <div class="container">
        <nav class="navbar navbar-expand-md navbar-light justify-content-between p-md-0">
          <a class="navbar-brand" href="<?php echo site_url();?>"><img src="<?php bloginfo('template_url'); ?>/assets/images/GenRocket-logo.svg" width="240" alt="GenRocket - Test Data Management"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php
	           if(has_nav_menu('top')){
	            wp_nav_menu(array(
	             'theme_location'  => 'top',
	             'container'       => 'ul',
	             'menu_class'      => 'navbar-nav mr-auto nav',
	             'menu_id'         => 'nav',
	             'echo'            => true,
	             'fallback_cb'     => 'wp_page_menu',
	             'before'          => '',
	             'after'           => '',
	             'link_before'     => '',
	             'link_after'      => '',
	             'depth'           => 0
	           ));
	          }
	         ?>
          </div>
          <form action="<?php echo esc_url(site_url()); ?>" class="serach-form">
	            <a href="javascript:void(0)" class="serach-opner" aria-label="search Button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M500.3 443.7l-119.7-119.7c27.22-40.41 40.65-90.9 33.46-144.7C401.8 87.79 326.8 13.32 235.2 1.723C99.01-15.51-15.51 99.01 1.724 235.2c11.6 91.64 86.08 166.7 177.6 178.9c53.8 7.189 104.3-6.236 144.7-33.46l119.7 119.7c15.62 15.62 40.95 15.62 56.57 0C515.9 484.7 515.9 459.3 500.3 443.7zM79.1 208c0-70.58 57.42-128 128-128s128 57.42 128 128c0 70.58-57.42 128-128 128S79.1 278.6 79.1 208z"/></svg></a>
	            <div class="field">
	              <input placeholder="search" name="s" class="input" type="search">
	              <button type="submit" aria-label="submit"><i class="fa fa-search"></i></button>
	            </div>
	          </form>
        </nav>
      </div>
    </header>
<?php } ?>