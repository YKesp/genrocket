<?php /* Template Name: New Home */ ?>
<?php get_header(); ?>
<main id="main">
	<div class="mainslideshow mainslideshow3">
		<div class="slideset">
			<div class="slide">
				<video width="100%" autoplay muted loop class="video"><source src="<?php bloginfo('template_url'); ?>/assets/videos/video1a.mp4" type="video/mp4">Your browser does not support the video tag.</video><h1 class="title mb-5 tagline">Global Solutions for DevOp Teams</h1>
				</div>
				<div class="slide">
					<video width="100%" autoplay muted loop class="video"><source src="<?php bloginfo('template_url'); ?>/assets/videos/video2a.mp4" type="video/mp4">
					Your browser does not support the video tag.</video><h1 class="title mb-5 tagline">Real Time Synthetic Test Data</h1>
				</div>
				<div class="slide">
					<video width="100%" autoplay muted loop class="video"><source src="<?php bloginfo('template_url'); ?>/assets/videos/video3a.mp4" type="video/mp4">Your browser does not support the video tag.</video><h1 class="title mb-5 tagline">On Demand Self Service Platform</h1>
					</div>
					<div class="pagination d-none d-md-block"></div>
				</div>
				<div class="caption">
					<div class="container text-left new-caption">
						<div class="row justify-content-center">
							<div class="col-xl-6 col-lg-12">
								<h3><a href="javascript:;" class="btnVideo">GenRocket is the Synthetic Test Data Market Leader</a></h3>
								<center>
									<div class="video-box">
									<a href="javascript:;" id="videobtn"><img src="<?php bloginfo('template_url'); ?>/assets/images/video-placeholder.jpg" class="VideoIMg" alt=""></a>
									<!-- <iframe id="video1" src="https://www.youtube.com/embed/E60tsIOKjmQ" allowfullscreen="allowfullscreen" width="460" height="250" frameborder="0">
										<span style="display: inline-block; width: 0px; overflow: hidden; line-height: 0;" data-mce-type="bookmark" class="mce_SELRES_start"></span>
									</iframe> -->
										<div class="youtube-video" id="video1" data-video-id="E60tsIOKjmQ" width="460" height="290"></div>
									</div>
								</center>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php if (have_posts()) : while (have_posts()) : the_post();?>
				<?php //the_content(); ?>
				<div class="block td-automation text-center text-md-left dataBlock">
					<div class="container">
						<div class="innerContain">
							<h3 class="mb-lg-5 text-bluedark">Maximize Test Coverage</h3>
							<div class="row">
								<div class="col-md-8 text-white">
									<h4 class="text-center text-md-left">Design Synthetic Data for Any Test Case</h4>
									<div class="d-sm-flex text-left justify-content-center justify-content-md-start">
										<ul>
											<li>Postive data</li>
											<li>Negative data</li>
											<li>Edge Case data</li>
											<li>Unique data</li>
											<li>All Permutations</li>
											<li>Stateful Data</li>
										</ul>
										<ul>
											<li>With Referential Integrity</li>
											<li>With Dynamic Rules</li>
											<li>Small to Huge Volume</li>
											<li>For Complex Workflows</li>
											<li>SWIFT MT & MX Messages</li>
											<li>X12 EDI Transactions</li>
										</ul>
									</div>
								</div>
								<div class="col-md-4"><img src="<?php bloginfo('template_url'); ?>/assets/images/newdesign/nd-img-1.png" class="img-fluid d-block mx-auto mb-5 mb-md-0" alt="Maximize Test Converage"><br>
									<div class="btns d-flex justify-content-center">
									<a href="https://www.genrocket.com/blog/how-to-use-synthetic-data-to-maximize-test-coverage" class="btn btn-primary" target="_blank">Learn More</a>
									</div>
								</div>
							</div>
						</div>
						<div class="innerContain borderTop">
							<h3 class="mb-lg-5 text-bluedark">Minimize Cycle Time</h3>
							<div class="row">
								<div class="col-md-6">
									<img src="<?php bloginfo('template_url'); ?>/assets/images/newdesign/nd-img-2.png" class="img-fluid d-block mx-auto mb-5 mb-md-0" alt="Minimize Cycle Time"><br>
									<div class="btns d-flex justify-content-center"><a href="https://www.genrocket.com/blog/a-streamlined-process-for-self-service-test-data-provisioning" class="btn btn-primary" target="_blank">Learn More</a></div>
								</div>
								<div class="col-md-6 text-white">
									<h4 class="text-center text-md-left">Generate Test Data On-Demand</h4>
									<ul>
										<li>Generate Test Data On-Demand</li>
										<li>Rapid self-service test data provisioning</li>
										<li>Fresh, secure, controlled data in real-time</li>
										<li>Generate billions of rows of data in minutes</li>
										<li>Integrate into your CI/CD release pipeline</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- wp:html -->
				<div class="block simple-twocolumns  text-center text-md-left">
					<div class="container">
						<h2 class="text-center">Synthetic Test Data Automation</h2>
						<center>
							<!-- <img src="<?php //bloginfo('template_url'); ?>/assets/images/newdesign/stsa.jpg" class="img-fluid d-block mx-auto mb-5" alt="Synthetic Test Data Automation"> -->
							<!-- <figure><iframe src="https://www.youtube.com/embed/hOwH9zPCchI?rel=0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="allowfullscreen" width="560" height="315" frameborder="0"><span style="display: inline-block; width: 0px; overflow: hidden; line-height: 0;" data-mce-type="bookmark" class="mce_SELRES_start"></span></iframe></figure> -->
							<video width="100%" muted autoplay loop style="border:1px solid #ddd; max-width: 789px; margin: 0 auto 20px;">
								<source src="<?php bloginfo('template_url'); ?>/assets/images/presentation1a.mp4" type="video/mp4">
									Your browser does not support the video tag.
								</video> 
							</center>
							<p>Synthetic Test Data Automation (TDA) streamlines the time-consuming process of copying, masking, and subsetting production data for testing. With GenRocket, only the metadata containing the data model of the target data environment is used to build a Test Data Project, a collection of Test Data Cases associated with a database or an application.</p>
							<p>Test Data Cases contain the rules for generating synthetic test data. As each test case is developed, their acceptance criteria and test data requirements are defined. GenRocket makes it easy to transform test case requirements into an executable Test Data Design using a self-service dashboard hosted in a secure cloud environment. Once defined, Test Data Cases are downloaded to a local test environment and executed whenever test data is needed. And it's easy to integrate the GenRocket platform with test automation tools and frameworks to create a fully automated release pipeline for continuous integration and testing.</p>
							<div class="btn-block text-center"><a href="#" class="btn btn-light btn-yt"><i class="fa fa-youtube-play"></i> Watch Video <iframe style="display: none;" width="560" height="315" src="https://www.youtube.com/embed/E60tsIOKjmQ?start=216&end=401"></iframe></a></div>
						</div>
					</div>
					<!-- /wp:html -->
					<!-- wp:html -->
					<div class="block DevOpsScale bg-tda  text-center text-md-left">
						<div class="container">
							<h2 class="text-center text-white">Synthetic Test Data On-Demand</h2>
							<div class="row">
								<div class="col-md-4"><img src="<?php bloginfo('template_url'); ?>/assets/images/newdesign/benefits.jpg" class="img-fluid d-block mx-auto mb-5 mb-md-3" alt="Synthetic Test Data On-Demand"></div>
								<div class="col-md-8">
									<h4>TDA is the Future of Test Data Management</h4>
									<p>Synthetic Test Data Automation allows DevOps teams to deliver the
										highest level of quality because test data is designed to meet every test
										case requirement with a controlled and comprehensive synthetic dataset.
										There's no need to hunt for test data in a production database. Just design
									the data you need and generate it on-demand.</p>
									<p>And because the data is synthetic, there's no need for masking. Synthetic
										data is always 100% secure and private. Once your data is modeled and
										the data generation rules are defined as Test Data Cases, they can be
									shared, repurposed and version-controlled by the DevOps team.</p>
									<p>Test Data Automation reduces cost, risk, complexity and cycle time. At
										the same time, TDA enables greater coverage, expanded test automation,
									and increased productivity for the entire DevOps team.</p>
								</div>
							</div>
							<div class="btn-block text-center"><a href="https://www.genrocket.com/test-data-automation-deployment-strategy/" class="btn btn-primary" rel="noopener noreferrer" target="_blank">REQUEST A DEMO</a></div>
						</div>
					</div>
					<!-- /wp:html -->
					<!-- wp:html -->
					<div class="block bg-block benefits-block">
						<div class="container text-center">
							<h2 class="text-white mb-5">Real-World Customer Benefits</h2>
							<div class="outer-textBoxes d-flex flex-column align-items-center">
								<div class="btn-block text-center"><a href="#" class="btn btn-light btn-yt"> <i class="fa fa-youtube-play"></i> See How Customer Benefits <iframe style="display: none;" width="560" height="315" src="https://www.youtube.com/embed/E60tsIOKjmQ?start=401"></iframe></a></div>
								<img src="<?php bloginfo('template_url'); ?>/assets/images/newdesign/image-1.png" class="img-fluid d-block mx-auto my-4" alt="Real-World Customer Benefits">
								<div class="textBox box1">
									<div class="inner">
										<span class="mb-4 d-block">Cycle time reduction of <br><b>1400 hours</b></span>
										<p>Increased coverage for SIT and performance <b>from 30% to 80%</b></p>
									</div>
									<strong class="title">Payments</strong>
								</div>	
								<div class="textBox box2">
									<div class="inner">
										<span class="mb-4 d-block">Test cycle time reduction of <br><b>more than 380 hours</b></span>
										<p>Increased regression & API performance coverage <b>from 0% to 70%</b>.</p>
									</div>
									<strong class="title">Bank</strong>
								</div>	
								<div class="textBox box3">
									<div class="inner">
										<span class="mb-4 d-block">Reduced test cycle time by <br><b>more than 200 hours</b></span>
										<p>Increase component testing coverage <b>from 0% to 50%</b></p>
									</div>
									<strong class="title">Data & Analytics (DNA)</strong>
								</div>	
								<div class="textBox box4">
									<div class="inner">
										<span class="mb-4 d-block">Saved over 1300 hours during the <br><b>first 9 months of deploment</b></span>
										<p>Increased regression coverage <b>from 0% to 50%</b></p>
									</div>
									<strong class="title">Card</strong>
								</div>	
							</div>
						</div>
					</div>
					<!-- /wp:html -->
				<?php endwhile; else : _e( 'Sorry, no content available.', 'textdomain' ); endif; wp_reset_query(); ?>
				<div class="block partners newdesign">
					<div class="container">
						<h2 class="text-center">Software Testing Partners</h2>
						<div class="partners-carousel">
							<div class="mask">
								<ul class="partners-logoes">
									<?php if( have_rows('partners', 'option') ):
										while ( have_rows('partners', 'option') ) : the_row(); ?>
											<li><img src="<?php echo the_sub_field('logos');?>" alt="Partners logo"></li>
										<?php endwhile; else : endif; ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<?php if(get_field('additional_editor')): ?>
						<?php echo get_field('additional_editor');?>
					<?php endif; ?>
				</main>
				<?php get_footer(); ?>