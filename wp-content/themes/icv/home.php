<?php
/*
 * Template Name: ICV Home
 * Description: This is the Default Homepage
*/

get_header();

?>

<section id="home" class="js-hero-fit hero-conatiner full-width">
	<div class="inner-container header-lift">
		<header class="primary-header full-width">
			<a class="js-mobile-nav mobile-nav">
				<hr>
			</a>
			<nav class="js-primary-nav-container primary-nav-container full-width">
				<h1><a class="preventDefault primary-nav-logo" href="#home"><img src="<?php bloginfo('template_url'); ?>/img/icv-logo.png" width="146" height="auto" alt="icv-logo" title="icv-logo"></a></h1>
				<ul class="js-primary-nav primary-navigation">
					<li><a id="portfolio-section-nav" href="#portfolio">Portfolio</a></li>
					<li><a id="team-section-nav" href="#team">Team</a></li>
					<li><a id="press-section-nav" href="#press">Press</a></li>
					<li><a id="gallery-section-nav" href="#gallery">Gallery</a></li>
					<li><a id="contact-section-nav" href="#contact">Contact</a></li>
				</ul>
			</nav>
		</header>
	</div>
	<div class="js-hero-slider hero-slider cycle-slideshow" data-cycle-slides="> div.hero-slide" data-cycle-fx="fadeout" data-cycle-timeout="5000" data-cycle-speed="1200" data-cycle-pause-on-hover="true" data-cycle-prev=".slider-control-arrows .left" data-cycle-next=".slider-control-arrows .right" data-cycle-log="false">
		<div class="inner-container">
			<div class="text-container">
				<h1 class="hero-heading">Innovation for a <br> Sustainable Future</h1>
				<h2 class="hero-subheading">ICV partners with entrepreneurs using technology and business model<br> innovation to transform markets in a resource-constrained world.</h2>
				<p class="full-width">
					<a href="#portfolio" class="btn btn--green">view portfolio</a>
				</p>
			</div>
		</div>
		<?php pull_all_featured_hp($masterCategories); ?>
		<div class="hero-slider-controls hidden">
			<ul class="slider-control-arrows">
				<li><a href="#" class="left"><</a></li>
				<li><a href="#" class="right">></a></li>
			</ul>
		</div>
	</div>
	<div class="mobile-hero full-width">
		<div class="text-container full-width">
			<h1 class="hero-heading">Innovation for a <br> Sustainable Future</h1>
			<h2 class="hero-subheading">ICV partners with entrepreneurs using technology and business model<br> innovation to transform markets in a resource-constrained world.</h2>
			<p class="full-width">
				<a href="#portfolio" class="btn btn--green">view portfolio</a>
			</p>
		</div>
		<div class="mobile-slider full-width">
			<?php pull_all_flat_hp($masterCategories); ?>
		</div>
	</div>
</section>

<section id="portfolio-section" class="full-width subsection portfolio-subsection">
	<div class="inner-container">
		<h1 class="section-heading">Portfolio</h1>
		<ul class="full-width four-col portfolio-items cycle-slideshow" data-cycle-fx="scrollHorz" data-cycle-slides="> div.slide" data-cycle-timeout="0" data-cycle-speed="800" data-cycle-pause-on-hover="true" data-cycle-prev=".js-portfolio-control.left" data-cycle-next=".js-portfolio-control.right" data-cycle-log="false">
				<?php pull_all_portfolio($masterCategories); ?>
		</ul>
		<div class="mobile-portfolio full-width">
			<?php pull_all_portfolio_flat($masterCategories); ?>
		</div>
		<div class="overlay hidden js-folio-overlay" data-auto-height="calc">
			<a class="js-overlay-close close-x" href="#">+</a>

			<?php pull_all_portfolio_expanded($masterCategories); ?>

		</div>
		<a href="#" class="js-portfolio-control hidden large-arrow left black"><</a>
		<a href="#" class="js-portfolio-control hidden large-arrow right black">></a>
		<a href="#" class="js-portfolio-exp-control hidden large-arrow left black"><</a>
		<a href="#" class="js-portfolio-exp-control hidden large-arrow right black">></a>
	</div>
</section>

<section id="testimonials-section" class="full-width subsection testimonials-subsection">
	<div class="inner-container">
		<ul class="js-quotes full-width quotes cycle-slideshow" data-cycle-fx="scrollHorz" data-auto-height="calc" data-cycle-slides="> li.slide" data-cycle-timeout="5000" data-cycle-speed="2000" data-cycle-pause-on-hover="true" data-cycle-prev=".js-testimony-control.left" data-cycle-next=".js-testimony-control.right" data-cycle-log="false">
			<?php pull_all_testimonials($masterCategories); ?>
		</ul>
		<a class="js-testimony-control hidden large-arrow black left" href="#"><</a>
		<a class="js-testimony-control hidden large-arrow black right"href="#">></a>
	</div>
</section>

<section id="team-section" class="full-width subsection team-subsection">
	<div class="inner-container">
		<header>
			<div class="section-heading inline-image">
				<img src="<?php bloginfo('template_url'); ?>/img/team.png" width="287" height="auto">
					<h1>Team</h1>
					<?php
					$team = get_page_by_title('Team');
					$team_overview = get_field('team_overview', $team->ID);
					?>
				<p class="section-subheading"><?php echo $team_overview; ?> </p>
			</div>
		</header>
		<ul class="js-team team-bio-cont full-width three-col cycle-slideshow" data-cycle-fx="scrollHorz" data-auto-height="calc" data-cycle-slides="> div.slide" data-cycle-timeout="0" data-cycle-speed="800" data-cycle-pause-on-hover="true" data-cycle-prev=".js-team-control.left" data-cycle-next=".js-team-control.right" data-cycle-log="false">
			<?php pull_all_bios($masterCategories); ?>
		</ul>
		<div class="full-width mobile-team">
			<?php pull_all_bios_flat($masterCategories); ?>
		</div>
		<a class="js-team-control hidden large-arrow black left" href="#"><</a>
		<a class="js-team-control hidden large-arrow black right"href="#">></a>
		<a class="js-team-exp-control hidden large-arrow black left" href="#"><</a>
		<a class="js-team-exp-control hidden large-arrow black right"href="#">></a>
		<div class="overlay-team hidden js-overlay-team">
			<a class="js-overlay-close close-x" href="#">+</a>
			<?php pull_all_bios_expanded($masterCategories); ?>
		</div>
	</div>
</section>

<section id="press-section" class="full-width subsection news-subsection">
	<div class="inner-container">
		<h1 class="section-heading">News &amp; Press</h1>
		<ul class="js-news news-col three-col cycle-slideshow" data-cycle-fx="scrollHorz" data-auto-height="calc" data-cycle-slides="> div.slide" data-cycle-timeout="0" data-cycle-speed="800" data-cycle-pause-on-hover="true" data-cycle-prev=".js-news-control.left" data-cycle-next=".js-news-control.right" data-cycle-log="false">
			<?php pull_all_news($masterCategories); ?>
		</ul>
		<div class="mobile-news">
			<?php pull_all_news_flat($masterCategories); ?>
		</div>
		<a class="js-news-control hidden large-arrow black left" href="#"><</a>
		<a class="js-news-control hidden large-arrow black right"href="#">></a>
		<p class="full-width contact-info">
			<a class="all-news-btn btn btn--green" href="/news">View all News &raquo;</a>
			<br clear="all">
			For all press inquiries & media requests, please contact <a href='&#109;ai&#108;&#116;&#111;&#58;k&#97;ren&#64;ic&#118;&#46;%76&#99;'>&#107;a&#114;en&#64;icv&#46;vc</a> Karen Greenfield</a> (+972-3-644-6611)
		</p>
	</div>
</section>


<section id="gallery-section" class="full-width subsection gallery-subsection">
	<div class="inner-container">
		<h1 class="section-heading">Gallery</h1>
		<ul class="js-gallery-filters hidden full-width five-col gallery-filters">
			<li class="float-left col"><a class="active" data-filter="all" href="">All</a></li>
			<li class="float-left col"><a href="" data-filter="filter-2">Filter 2</a></li>
			<li class="float-left col"><a href="">Filter</a></li>
			<li class="float-left col"><a href="">Filter</a></li>
		</ul>
		<ul class="js-gallery full-width gallery four-col cycle-slideshow" data-cycle-fx="scrollHorz" data-auto-height="calc" data-cycle-slides="> div.slide:not(.hidden)" data-cycle-timeout="0" data-cycle-speed="800" data-cycle-pause-on-hover="true" data-cycle-prev=".js-gallery-control.left" data-cycle-next=".js-gallery-control.right" data-cycle-log="false">
			<?php pull_all_gallery($masterCategories); ?>
		</ul>
		<div class="mobile-gallery">
			<?php pull_all_gallery_flat($masterCategories); ?>
		</div>
		<p>
			<a href="/gallery" class="view-all-gallery btn btn--green">View all Gallery &raquo;</a>
		</p>
		<a class="js-gallery-control hidden large-arrow black left" href="#"><</a>
		<a class="js-gallery-control hidden large-arrow black right"href="#">></a>
	</div>
</section>

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


<?php
get_footer();
?>
