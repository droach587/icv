<?php
function internal_scripts()
{
    wp_enqueue_script('bootstrap-core', get_template_directory_uri() . '/js/vendor/bootstrap-core.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'internal_scripts');
?>

<?php get_header('content'); ?>

<?php
    $catslug = get_the_category($id)[0]->slug;
    $isSinglePost = is_single();
?>

<!-- Fixed navbar -->
<div class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">
				<img width="100%" height="auto" src="<?php bloginfo('template_url')?>/img/icv-logo.png">
			</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li <?php if (get_query_var('pagename')==='portfolio'): ?>class="active"<?php endif; ?>><a href="/portfolio">Portfolio</a></li>
				<li <?php if (get_query_var('pagename')==='team'): ?>class="active"<?php endif; ?>><a href="/team">Team</a></li>
				<li <?php if (get_category_name($id)==='news-and-press'): ?>class="active"<?php endif; ?>><a href="/news-and-press">Press</a></li>
				<li <?php if (get_category_name($id)==='gallery'): ?>class="active"<?php endif; ?>><a href="/gallery">Gallery</a></li>
				<li <?php if (get_category_name($id)==='contact'): ?>class="active"<?php endif; ?>><a href="#contact-section">Contact</a></li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</div>
<!-- Fixed Nav -->
<div class="jumbotron">
  <div class="container">
		<?php if(!is_page()): ?>
	    <h1><?php echo get_the_category($id)[0]->cat_name; ?></h1>
	    <p><?php echo strip_tags(category_description(get_the_category($id)[0]->cat_ID)); ?></p>
	<?php else: ?>
		<h1><?php echo ucfirst(get_query_var('pagename')); ?></h1>
		<?php
			$pageName = ucfirst(get_query_var('pagename'));
			$overview = get_field(get_query_var('pagename').'_overview', $pageName->ID);
		?>
		<p><?php echo $overview; ?></p>
		<?php endif; ?>
  </div>
</div>


<!-- Begin page content -->
<div class="container body">
	<ol class="breadcrumb">
	  <li><a href="/">Home</a></li>
		<?php if(!is_page()): ?>
	  	<li><a href="/<?php echo get_category_name($id); ?>"><?php echo get_the_category($id)[0]->cat_name; ?></a></li>
		<?php else: ?>
			<li><a href="/<?php echo get_query_var('pagename'); ?>"><?php echo ucfirst(get_query_var('pagename')); ?></a></li>
		<?php endif; ?>
	  <?php if (is_single()): ?>
	  	<li><?php wp_title(' ', true, 'right'); ?></li>
	  <?php endif; ?>
	</ol>
    <?php /* begin the loop */ if (have_posts()) : ?>
	<?php query_posts($query_string . '&orderby=date&order=ASC'); ?>
	<?php while (have_posts()) : the_post(); ?>
		<?php if (is_page()) : /* show page contents */ ?>
            <div class="pagecontent" id="post-<?php the_ID(); ?>">
                <h1><?php the_title(); ?></h1>

								<?php if(get_query_var('pagename')==='team'): ?>

									<?php
										$bios = get_page_by_title('Team');
										$teamMem = get_field('team_members', $bios->ID);
									?>

									<?php foreach($teamMem as $team): ?>
									<div class="col-lg-12" style="margin-top:20px;">
										<h1 style="margin-top:50px;"><?php echo $team[name]; ?>, <?php echo $team[title]; ?></h1>
										<hr>
										<div class="col-sm-3 no-pad featured-team-inset"><img src="<?php echo $team[headshot][sizes]['team-thumbnail'] ?>" width="100%" height="auto" class="img-circle"></div>
										<div class="col-md-9">
											<p><?php echo $team[bio]; ?></p>
											<p class="desc"><a href="mailto:<?php echo $team[email]; ?>" class="btn btn--green"><?php echo $team[name]; ?> »</a></p>
										</div>
									</div>
									<?php endforeach; ?>

								<?php endif; ?>

								<?php if(get_query_var('pagename')==='portfolio'): ?>

									<?php
										$portfolios = get_page_by_title('Portfolio');
										$portItem = get_field('portfolio_items', $portfolios->ID);
									?>

									<?php foreach($portItem as $item): ?>
									<div class="post col-md-3" id="post-605" style="min-height:440px; margin-bottom:60px;">
								    <div class="postcontents ">
								      <div class="featured-image text-center portfolio">
								        <div class="internal-portfolio-image full-width" style="background-image: url(<?php echo $item[company_image]; ?>);"></div>
								      </div>
								      <h1 class="text-center"><?php echo $item[company_name]; ?></h1>
								      <div class="text-center">
								        <div class="portfolio-text">
								          <p><?php echo $item[company_description]; ?></p>
								        </div>
								      </div>
								    </div>
								    <div class="postmeta no-line portfolio">
								      <p class="text-center">
								        <a class="btn btn-default" target="_blank" href="<?php echo $item[company_url]; ?>">Visit Website »</a>
								      </p>
								    </div>
								  </div>
								<?php endforeach; ?>

								<?php endif; ?>

            </div>


        <?php elseif (is_search()) : /* show search results */ ?>

            <div class="searchresults">
            <div class="post" id="post-<?php the_ID(); ?>">
                <div class="postcontents">
                    <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                    <?php the_excerpt(); ?> <a href="<?php the_permalink() ?>"><?php the_permalink() ?></a>
                </div>
            </div>
            </div>

        <?php else : /* show post contents */ ?>

			<?php
                $allowableColumns = array(
                    'team',
                    'portfolio'
                );
                if (in_array($catslug, $allowableColumns)):
            ?>
				<?php if (!is_single()): ?>
				 <?php if ($catslug === 'portfolio'): ?>
				  	<div class="post col-md-3" id="post-<?php the_ID(); ?>" style="min-height:440px; margin-bottom:60px;">
				  <?php else: ?>
				  <div class="post col-md-4" id="post-<?php the_ID(); ?>">
				 <?php endif; ?>
				 <?php else: ?>
				 <div class="post" id="post-<?php the_ID(); ?>">
				 <?php endif; ?>
			<?php elseif ($catslug === 'gallery'): ?>
				<div class="post col-sm-3" id="post-<?php the_ID(); ?>">
			<?php else: ?>
				 <div class="post" id="post-<?php the_ID(); ?>">
			<?php endif; ?>

                <div class="postcontents <?php if ($catslug === 'gallery'): ?>gallery-post<?php endif; ?>">
                    <?php if (!is_single()) : ?>
                    	<?php if ($catslug !== 'news-and-press'): ?>
                        <div class="featured-image text-center <?php if ($catslug === 'portfolio'): ?>portfolio<?php elseif ($catslug ==='gallery'): ?>gallery<?php endif; ?>">
	                        <?php if ($catslug === 'gallery'): ?>
	                        	<?php
                                    $isVideo = (pull_custom_field($id, 'youtube_url'))? true : false;
                                    $lightbox=(!$isVideo)? 'fancybox-thumb' : false;
                                ?>
	                        	<a <?php if ($lightbox): ?>class="fancybox-thumb" rel="fancybox-thumb"<?php endif; ?> href="<?php if ($isVideo): ?><?php echo pull_custom_field($id, 'youtube_url') ?><?php else: ?><?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0]; ?><?php endif; ?>" class="gallery-thumb <?php if ($isVideo): ?>video fancybox-thumb fancybox.iframe<?php endif; ?>" rel="fancybox-thumb" title="<?php the_title(); ?>">
		                        	<?php echo pull_select_post_image($id, 'team-thumbnail'); ?>
	                        	</a>
	                        <?php else: ?>
	                        	<?php if ($catslug !== 'portfolio'): ?>
		                        	<a href="<?php the_permalink() ?>">
	                        	<?php endif; ?>
	                        	<?php if ($catslug === 'portfolio'): ?>
	                        		<?php $bgImage = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0]; ?>
									<div class="internal-portfolio-image full-width" style="background-image: url(<?php echo $bgImage; ?>);"></div>
	                        	<?php else: ?>

	                        		<?php echo pull_select_post_image($id, 'team-thumbnail'); ?>

	                        	<?php endif; ?>
	                        	<?php if ($catslug !== 'portfolio'): ?>
		                        	</a>
	                        	<?php endif; ?>
	                        <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <?php if ($catslug !=='portfolio'): ?>
                    		<?php if ($catslug !== 'gallery'): ?>
								<h1 class="<?php if ($catslug !== 'news-and-press'): ?>text-center<?php endif; ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
								<?php if ($catslug === 'team'): ?>
								<h4 class="text-center"><?php echo pull_custom_field($id, 'job_title'); ?></h4>
								<?php endif; ?>
                        	<?php endif; ?>
                        <?php else: ?>
                        	<h1 class="text-center"><?php the_title(); ?></h1>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php $jobTitle = pull_custom_field($id, 'job_title'); ?>
                        <h1><?php the_title(); ?><?php if (isset($jobTitle) && !empty($jobTitle)): ?><?php echo ', '.$jobTitle; ?><?php endif; ?></h1>
                    <?php endif; ?>
					<div class="<?php if ($catslug != 'news-and-press' && !is_single()): ?>text-center<?php endif; ?>">
						<?php if ($catslug == 'portfolio'): ?>
						<div class="portfolio-text">
							<?php the_content(); ?>
						</div>
						<?php elseif ($catslug == 'news-and-press'): ?>
							<?php $newsContent = get_the_content(); ?>
							<p>
								<?php if (is_single()): ?>
									<?php the_content(); ?>
								<?php else: ?>
									<?php echo truncate_utf8(strip_tags($newsContent), 240, $wordsafe = true, $dots = true); ?>
								<?php endif; ?>
							</p>
							<div class="post-tags">
		                    <?php the_tags('<strong>Tags:</strong> ', ', ', ' | '); ?> <strong>Source: </strong><?php echo pull_custom_field($post->ID, 'article_source'); ?> |
		                    Posted <?php the_date() ?> by  <?php the_author_link(); ?>
		                    </div>
							<hr>
						<?php endif; ?>
						<?php if ($catslug=='team' && $isSinglePost): ?>
							<?php $teamContent = get_the_content(); ?>
							<hr>
							<div class="col-sm-3 no-pad featured-team-inset">
								<img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'team-thumbnail')[0]; ?>" width="100%" height="auto" class="img-circle">
							</div>
							<div class="col-md-9">
								<p><?php echo $teamContent; ?></p>
								<?php
                                        $email = (pull_custom_field($post->ID, 'email_address'))? '<a href="mailto:'.pull_custom_field($post->ID, 'email_address').'" class="btn btn--green">Email '.strip_tags($post->post_title).' &raquo;</a>' : false;
                                        $linkedin = (pull_custom_field($post->ID, 'linkedin'))? '<a target="_blank" href="'.pull_custom_field($post->ID, 'linkedin').'" class="btn btn--green">View '.strip_tags($post->post_title).'\'s LinkedIn &raquo;</a>' : false;
                                    ?>
									<?php
                                     echo '<p class="desc">
											'.$email.' &nbsp; '.$linkedin.'
											</p>';
                                     ?>
							</div>
						<?php endif; ?>
					</div>
					<?php if ($catslug === 'gallery'): ?>
						<h4 class="text-center"><?php the_title(); ?></h4>
					<?php endif; ?>
                </div>
                <?php if (!is_single()): ?>
                	<?php if ($catslug !== 'gallery'): ?>
	                <div class="postmeta <?php if ($catslug === 'portfolio'): ?>no-line portfolio<?php endif; ?>">
	                    <p <?php if ($catslug != 'news-and-press'): ?>class="text-center"<?php endif; ?>>
	                    	<?php if ($catslug === 'news-and-press'): ?>
		                    	<a class="btn btn-default" href="<?php the_permalink() ?>">Read More &raquo;</a>
		                    <?php elseif ($catslug == 'portfolio'): ?>
			                    <a class="btn btn-default" target="_blank" href="<?php echo pull_custom_field($id, 'company_url'); ?>">Visit Website &raquo;</a>
		                    <?php else: ?>
		                    	<a class="btn btn-default" href="<?php the_permalink() ?>">Read Bio &raquo;</a>
	                    	<?php endif; ?>
		                </p>
	                </div>
	                <?php endif; ?>
				<?php endif; ?>
            </div>
        <?php endif; /* end if page or post */ ?>

    <?php endwhile;/* end the main loop */ ?>


    <?php /* post navigation */ ?>
    <?php if (is_single()) : ?>
    <br clear="all">
    <br clear="all">
    <div class="panel panel-default">
	  <div class="panel-body">
	        <div class="postnavigation">
	            <div class="pull-left"><?php previous_post_link('%link  ', '<span>&lt;</span> Previous', $in_same_term = true) ?></div>
	            <div class="pull-right"><?php next_post_link('  %link', 'Next <span>&gt;</span>', $in_same_term = true) ?></div>
	        </div>
	  </div>
    </div>
    <?php endif; ?>
    <?php if ($catslug != 'portfolio'): ?>
    <?php if ($wp_query->max_num_pages > 1) : ?>
    	<br clear="all">
        <div class="postnavigation">
            <?php next_posts_link('Older posts <span>&gt;</span>') ?>
            <?php previous_posts_link('<span>&lt;</span> Newer posts') ?>
        </div>
    <?php endif; ?>
    <?php endif; ?>

    <?php else : /* show page not found message */ ?>

    <div class="pagecontent pagenotfound">

        <h1>Page not found</h1>

        <p>Sorry, the page you are looking for is not available. It may have moved, or you may have followed a bad link. Please
        <a href="<?php bloginfo('url') ?>">visit our homepage</a> to find what you're looking for.</p>

    </div>
    <?php endif; /* end if have_posts */ ?>


</div>

<section id="contact-section" class="full-width subsection contact-subsection">
	<?php
    $footerInfo = get_page_by_title('Footer Information');
    $footerCopy = get_field('footer_copy', $footerInfo->ID);
    $footerAddress = get_field('company_address', $footerInfo->ID);
    $footerAddressURL = get_field('directions_url', $footerInfo->ID);
    $footerTel = get_field('telephone', $footerInfo->ID);
    $footerEmail = get_field('email', $footerInfo->ID);
    $footerTwitter = get_field('twitter_url', $footerInfo->ID);
    $footerFacebook = get_field('facebook_url', $footerInfo->ID);
    $footerLinkedIn = get_field('linked_in_url', $footerInfo->ID);
    ?>
	<div class="inner-container">
		<h1 class="section-heading">Contact Us</h1>
		<p class="section-desc"><?= $footerCopy; ?></p>
		<div class="full-width three-col">
			<form class="wufoo topLabel page" enctype="multipart/form-data" method="post" novalidate="" action="https://karenicv.wufoo.eu/forms/z1bs9v3d0tw52sg/#public">
				<div class="form-col col">
					<label>
						Your Name*
						<input id="Field9" name="Field9" type="text" placeholder="Your Name">
					</label>
					<label>
						Email*
						<input id="Field6" name="Field6" type="email" placeholder="Your Email">
					</label>
					<div class="masked">
						Reason for Contact:
						<a class="js-popupmenu suckerfish">
							<input class="js-popuplaceholder" id="Field3" name="Field3" type="text" readonly placeholder="Select an option...">
							<span class="arrow">
								<i></i>
							</span>
							<ul class="js-popupmenu-options menu">
								<li><label>Financing</label></li>
								<li><label>Employment</label></li>
								<li><label>General</label></li>
							</ul>
						</a>
					</div>
					<label class="file-upload">
						Upload File: <em>Optional</em>
						<span class="full-width upload-contain">
							<p class="upload-button">Choose File</p>
							<input class="js-file-upload-placeholder input-placeholder" disabled="disabled" type="text" placeholder="Select a file...">
						</span>
						<input class="js-file-upload" id="Field5" name="Field5" type="file" class="field file" size="12" tabindex="4">
					</label>
				</div>
				<div class="form-col col">
					<label>
						Comments
						<textarea id="Field4" name="Field4"></textarea>
					</label>
					<button class="btn btn--green float-right">send enquiry</button>
				</div>
				<input type="hidden" id="idstamp" name="idstamp" value="WEbb2TMpcgbx/9hkkiDpsU3HyotfJYg+mQpHBdgNV40=">
			</form>
			<div class="col last">
				<p>
					<img class="logo" src="<?php bloginfo('template_url'); ?>/img/icv-logo.png" width="141" height="auto">
					<br clear="all">
					<?= $footerAddress; ?>
					<br />
					<a href="<?= $footerAddressURL; ?>" target="_blank">Get Directions &raquo;</a>
					<br><br>
					<strong>T:</strong>  <?= $footerTel; ?> <br>
					<strong>E:</strong>  <a href='mailto:<?= $footerEmail; ?>'><?= $footerEmail; ?></a>
					<br><br>
					<a href="<?= $footerTwitter; ?>" target="_blank" class="social fi-social-twitter"></a> &nbsp;
					<a href="<?= $footerFacebook; ?>" target="_blank" class="social fi-social-facebook"></a> &nbsp;
					<a href="<?= $footerLinkedIn; ?>" target="_blank" class="social fi-social-linkedin"></a>
				</p>
			</div>
		</div>
	</div>
</section>

<div class="js-modal-cont interstitial-wrap hidden">
	<div class="interstitial">
		<h1>You are about to leave this website</h1>
		<p>The link you have clicked will direct you off of this website. Linked sites are not under ICV's control and the company is not responsible or liable for the privacy practices or the contents of any linked site, or any link contained in any linked site. If you intend to complete this action, you may click "<strong>proceed</strong>" from the buttons below. If you do not intend to complete this action you may hit <strong>escape</strong> on your keyboard or close this window by clicking "<strong>back to website</strong>" below. </p>
		<a href="#" class="js-back-button">&laquo; Back</a>
		<a class="js-go-button" href="#">Proceed to External Website &raquo;</a>
	</div>
</div>

<?php /* footer */ get_footer(); ?>
