<?php /* Template Name: priceing Template */ ?>
<?php get_header(); ?>
<div class="banner <?php echo get_field('banner_class'); ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-6 visual-img">
				<?php 
				$image = get_field('page_banner');
				$mobile = 'medium';
				$tablet = 'large';
				$full = 'full';
				?>
				<?php if(get_field('page_banner')): ?>
					<picture>
						<source srcset="<?php echo wp_get_attachment_image_url ($image['ID'], $mobile); ?>" media="(max-width: 767px)">
							<source srcset="<?php echo wp_get_attachment_image_url ($image['ID'], $tablet); ?>" media="(max-width: 1024px)">
								<source srcset="<?php echo wp_get_attachment_image_url ($image['ID'], $size); ?>">
									<img src="<?php echo wp_get_attachment_image_url ($image['ID'], $full); ?>" alt="GenRocket - Test Data Management">
								</picture>
							<?php endif; ?>
						</div>
						<?php if(get_field('banner_caption')): ?>
							<div class="col-md-6 traning-content pull-right text-center">
								<?php echo get_field('banner_caption'); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<main id="main">
				<?php if (have_posts()) : while (have_posts()) : the_post();?>
					<section class="second_nav">
						<div class="container"><?php echo do_shortcode('[custom_menu name="products-subnav"]'); ?></div>
					</section>
					<section class="surface block">
						<div class="container pricing-content pricing-a">
							<?php /*<div class="table-responsive">
								<table class="newpricing-table" width="100%" cellspacing="0" cellpadding="0" border="0">
									<tbody>
										<tr>
											<th> </th>
											<th>Startup</th>
											<th>Team</th>
											<th>Premium</th>
											<th>Enterprise</th>
											<th>Unlimited</th>
										</tr>
										<tr>
											<td>Annual License Fee</td>
											<td>$10,000</td>
											<td>$15,000</td>
											<td>$25,000</td>
											<td>$50,000</td>
											<td><center><em>Request Quote</em></center></td>
										</tr>
										<tr>
											<td><a href="https://genrocket.freshdesk.com/a/solutions/articles/19000000235" target="_blank" rel="noopener noreferrer">Maximum Projects</a></td>
											<td>3</td>
											<td>10</td>
											<td>25</td>
											<td>50</td>
											<td><center><em>Request Quote</em></center></td>
										</tr>
										<tr>
											<td># Project Versions</td>
											<td>3</td>
											<td>5</td>
											<td>10</td>
											<td>20</td>
											<td><center><em>Request Quote</em></center></td>
										</tr>
										<tr>
											<td>Total Domains (Tables) across Projects</td>
											<td>1,000</td>
											<td>5,000</td>
											<td>15,000</td>
											<td>30,000</td>
											<td><center><em>Request Quote</em></center></td>
										</tr>
										<tr>
											<td><a href="https://genrocket.freshdesk.com/support/solutions/articles/19000099424-genrocket-licensing-per-named-user-and-named-server" rel="noopener noreferrer" target="_blank">Named Users and/or Named Servers</a></td>
											<td>10</td>
											<td>25</td>
											<td>50</td>
											<td>100</td>
											<td><center><em>Request Quote</em></center></td>
										</tr>
										<tr>
											<th>Key Features</th>
											<th>Startup</th>
											<th>Team</th>
											<th>Premium</th>
											<th>Enterprise</th>
											<th>Unlimited</th>
										</tr>
										<tr>
											<td><a href="https://www.genrocket.com/self-service-test-data-design/" target="_blank" rel="noopener noreferrer">Self Service Test Data Design</a></td>
											<td>Yes</td>
											<td>Yes</td>
											<td>Yes</td>
											<td>Yes</td>
											<td>Yes</td>
										</tr>
										<tr>
											<td><a href="https://app.genrocket.com/browse/generators" target="_blank" rel="noopener noreferrer">Library of 663+ Data Generators</a></td>
											<td>Yes</td>
											<td>Yes</td>
											<td>Yes</td>
											<td>Yes</td>
											<td>Yes</td>
										</tr>
										<tr>
											<td><a href="https://app.genrocket.com/browse/receivers" target="_blank" rel="noopener noreferrer">Library of 81+ Data Receivers (Formats)</a></td>
											<td>Yes</td>
											<td>Yes</td>
											<td>Yes</td>
											<td>Yes</td>
											<td>Yes</td>
										</tr>
										<tr>
											<td><a href="https://genrocket.freshdesk.com/support/solutions/articles/19000106939-genrocket-team-permissions" target="_blank" rel="noopener noreferrer">Team-Level Permissions</a></td>
											<td> </td>
											<td>Yes</td>
											<td>Yes</td>
											<td>Yes</td>
											<td>Yes</td>
										</tr>
										<tr>
											<td>Data Lifecycle Management*</td>
											<td> </td>
											<td>Yes</td>
											<td>Yes</td>
											<td>Yes</td>
											<td>Yes</td>
										</tr>
										<tr>
											<td><a href="https://genrocket.freshdesk.com/support/solutions/articles/19000120490-g-subset-overview" target="_blank" rel="noopener noreferrer">Intelligent Data Subsetting & Masking</a></td>
											<td> </td>
											<td> </td>
											<td>Yes</td>
											<td>Yes</td>
											<td>Yes</td>
										</tr>
										<tr>
											<td>Complex Test Data Workflow Management*</td>
											<td> </td>
											<td> </td>
											<td> </td>
											<td>Yes</td>
											<td>Yes</td>
										</tr>
										<tr>
											<th>Hosting</th>
											<th>Startup</th>
											<th>Team</th>
											<th>Premium</th>
											<th>Enterprise</th>
											<th>Unlimited</th>
										</tr>
										<tr>
											<td><a href="https://vimeo.com/370208879" target="_blank" rel="noopener noreferrer">Virtual Private Cloud</a></td>
											<td>Yes</td>
											<td>Yes</td>
											<td>Yes</td>
											<td>Yes</td>
											<td>Yes</td>
										</tr>
										<tr>
											<td><a href="https://vimeo.com/370208879" target="_blank" rel="noopener noreferrer">Dedicated Private Cloud (Annual)</a></td>
											<td> </td>
											<td> </td>
											<td>$15,000</td>
											<td>$15,000</td>
											<td>$15,000</td>
										</tr>
										<td>On Premise (Annual)</td>
										<td> </td>
										<td> </td>
										<td>Request</td>
										<td>Request</td>
										<td>Request</td>
									</tr>
									<tr>
										<th>Solution Accelerators</th>
										<th>Startup</th>
										<th>Team</th>
										<th>Premium</th>
										<th>Enterprise</th>
										<th>Unlimited</th>
									</tr>
									<tr>
										<td>Salesforce Accelerator</td>
										<td>Yes</td>
										<td>Yes</td>
										<td>Yes</td>
										<td>Yes</td>
										<td>Yes</td>
									</tr>
									<tr>
										<td><a href="https://www.genrocket.com/x12-edi-test-data-solution-accelerator/" target="_blank" rel="noopener noreferrer">X12 EDI Test Data Accelerator (Annual)</a></td>
										<td> </td>
										<td> </td>
										<td>$10,000</td>
										<td>$10,000</td>
										<td>$10,000</td>
									</tr>
									<tr>
										<th>Training & Support</th>
										<th>Startup</th>
										<th>Team</th>
										<th>Premium</th>
										<th>Enterprise</th>
										<th>Unlimited</th>
									</tr>
									<tr>
										<td><a href="https://www.genrocket.com/flight-school-welcome/" target="_blank" rel="noopener noreferrer">Flight School</a></td>
										<td>Yes</td>
										<td>Yes</td>
										<td>Yes</td>
										<td>Yes</td>
										<td>Yes</td>
									</tr>
									<tr>
										<td><a href="https://www.genrocket.com/support/" target="_blank" rel="noopener noreferrer">5 X 24 Online Support</a></td>
										<td>Yes</td>
										<td>Yes</td>
										<td>Yes</td>
										<td>Yes</td>
										<td>Yes</td>
									</tr>
									<tr>
										<td><a href="https://genrocket.freshdesk.com/support/solutions" target="_blank" rel="noopener noreferrer">Online Knowledge Base</a></td>
										<td>Yes</td>
										<td>Yes</td>
										<td>Yes</td>
										<td>Yes</td>
										<td>Yes</td>
									</tr>
									<tr>
										<td>Customer Success Manager</td>
										<td>Yes</td>
										<td>Yes</td>
										<td>Yes</td>
										<td>Yes</td>
										<td>Yes</td>
									</tr>
									<tr>
										<th>Professional Services</th>
										<th>Startup</th>
										<th>Team</th>
										<th>Premium</th>
										<th>Enterprise</th>
										<th>Unlimited</th>
									</tr>
									<tr>
										<td>Pro Services Included with License</td>
										<td>No</td>
										<td>No</td>
										<td>No</td>
										<td>No</td>
										<td>No</td>
									</tr>
									<tr>
										<td>Fast Start Setup Services</td>
										<td>Request</td>
										<td>Request</td>
										<td>Request</td>
										<td>Request</td>
										<td>Request</td>
									</tr>
									<tr>
									</tbody>
								</table> 
							</div>*/ ?>
							<?php
							$homepage = file_get_contents("https://app.genrocket.com/public/edition");
							echo $homepage;
							?>
							<?php the_content(); ?>
						<?php endwhile; else : _e( 'Sorry, no content available.', 'textdomain' ); endif; wp_reset_query(); ?>
					</main>
					<?php get_footer(); ?>