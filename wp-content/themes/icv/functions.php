<?php


$masterCategories = array(
	'hpslider' => 3,
	'portfolio' => 5,
	'testimonials' => 7,
	'team' => 6,
	'news' => 4,
	'gallery' => 2
);

/*
//Sta
$masterCategories = array(
	'hpslider' => 3,
	'portfolio' => 5,
	'testimonials' => 7,
	'team' => 6,
	'news' => 4,
	'gallery' => 2
);
*/

global $masterCategories;

/* sidebar */
if ( function_exists('register_sidebar') )
    register_sidebar(array('description' => 'Left Sidebar'));

/* nav menus */
if ( function_exists( 'register_nav_menu' ) ) {
	register_nav_menu('header_nav', __('Header Navigation Menu'));
	register_nav_menu('footer_nav', __('Footer Navigation Menu'));
}


/* automatic feed links */
add_theme_support('automatic-feed-links');

if (function_exists('add_theme_support')) {
	add_theme_support('post-thumbnails');
	if (function_exists('add_image_size')) {
		add_image_size('portfolio-thumbnail', 452, 264, true);
		add_image_size('testimonial-thumbnail', 170, 170, true);
		add_image_size('team-thumbnail', 452, 452, true);
		add_image_size('gallery-thumbnail', 452, 312, true);
	}
}

add_filter( 'image_size_names_choose', 'custom_image_sizes_choose' );
function custom_image_sizes_choose( $sizes ) {
    $custom_sizes = array(
        'portfolio-thumbnail' => 'Portfolio Thumbnail',
        'testimonial-thumbnail' => 'Testimonial Thumbnail',
        'team-thumbnail' => 'Team Thumbnail',
        'gallery-thumbnail' => 'Gallery Thumbnail'
    );
    return array_merge( $sizes, $custom_sizes );
}

function icv_scripts() {

	wp_enqueue_script( 'jquery.fancybox.pack', get_template_directory_uri() . '/js/vendor/jquery.fancybox.pack.js', array(), '1.0.0', true );
	wp_enqueue_Script( 'main', get_template_directory_uri(). '/js/main.js', array(), '1.0.0', true);
	wp_enqueue_script( 'homepageSliderUtils', get_template_directory_uri() . '/js/homepageSliderUtils.js', array(), '1.0.0', true );
	wp_enqueue_Script( 'homepageFormUtils', get_template_directory_uri(). '/js/homepageFormUtils.js', array(), '1.0.0', true);
	wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/js/vendor/waypoints.js', array(), '1.0.0', true );
	wp_enqueue_script( 'homepageJumpNavi', get_template_directory_uri() . '/js/homepageJumpNavi.js', array(), '1.0.0', true );
	wp_enqueue_script( 'jqueryCycle', get_template_directory_uri() . '/js/vendor/jquery.cycle2.min.js', array(), '1.0.0', true );

}

add_action( 'wp_enqueue_scripts', 'icv_scripts' );


function get_category_name($id){
	return get_the_category( $id )[0]->category_nicename;
}

function pull_select_post_image($postID, $customSize){
	return get_the_post_thumbnail($postID, $customSize);
}

function pull_custom_field($postID, $key){
	 return get_post_meta($postID, $key, true);
}

function get_post_tags($postID){
	$tags = wp_get_post_tags($postID);
	$tagList = array();
	foreach ($tags as $postTags){
		$tagList[]= $postTags->name;
	}
	return implode(', ', $tagList);
}

function pull_all_featured_hp($masterCategories){

	$page = get_page_by_title('Homepage Hero');
	$data = get_field('hero_images', $page->ID);

	foreach($data as $image){

		echo '
			<div class="hero-slide" style="background-image: url('.$image[image].');">
				<p class="slide-details"><strong>'.strip_tags($image[company_name]).'</strong> - '.strip_tags($image[company_short_desc]).'</p>
			</div>
		';
	}

}

function pull_all_flat_hp($masterCategories){

	$page = get_page_by_title('Homepage Hero');
	$data = get_field('hero_images', $page->ID);

	shuffle($data);

	foreach($data as $image){

		echo '
			<div class="slide" style="background-image: url('.$image[image].');">
				<p class="slide-details"><strong>'.strip_tags($image[company_name]).'</strong> - '.strip_tags($image[company_short_desc]).'</p>
			</div>
		';

	}

}

function pull_all_portfolio($masterCategories){

	$page = get_page_by_title('Portfolio');
	$data = get_field('portfolio_items', $page->ID);

  $i = 0;
  $sn = 0;

	foreach($data as $portfolio){

		$bgImage = $portfolio[company_image];

		if($i%8 == 0) {
			echo $i > 0 ? "</div>" : "";
			echo "<div class='slide'>";
		}

		echo '
			<li class="col">
				<a href="'.$portfolio[company_url].'" class="js-flyout-trigger" data-index="'.$sn.'">
					<div class="portfolio-image" style="background-image: url('.$bgImage.');"></div>
					<h4 class="list-heading">'.strip_tags($portfolio[company_name]).'</h4>
					<span class="hover-tip">
						<span class="vertical-center">
							<p>'.strip_tags($portfolio[company_description]).'... </p>
						</span>
					</span>
				</a>
			</li>
		';
	$sn++;
	$i++;
	}
}

function pull_all_portfolio_expanded($masterCategories){

	$page = get_page_by_title('Portfolio');
	$data = get_field('portfolio_items', $page->ID);

	foreach($data as $portfolio){

		$bgImage = $portfolio[company_image];

		echo '
			<div class="folio-expanded-slide">
				<div class="col">
					<div class="col--data">
						<img class="js-overlay-img" src="'.$bgImage.'" width="100%" height="auto">
					</div>
				</div>
				<div class="col">
					<div class="col--data">
						<h1 class="js-overlay-heading heading">'.strip_tags($portfolio[company_name]).'</h1>
						<p class="js-overlay-desc desc">'.strip_tags($portfolio[company_description]).'</p>
						<a href="'.$portfolio[company_url].'" class="js-overlay-link btn btn--green" target="_blank">Visit Website</a>
					</div>
				</div>
			</div>
		';
	}

}

function pull_all_portfolio_flat($masterCategories){

	$page = get_page_by_title('Portfolio');
	$data = get_field('portfolio_items', $page->ID);


	foreach($data as $portfolio){

		$bgImage = $portfolio[company_image];

		echo '
			<div class="full-width portfolio-item">
				<div class="portfolio-image" style="background-image: url('.$bgImage.');">
				</div>
				<h1 class="heading">'.strip_tags($portfolio[company_name]).'</h1>
				<p class="desc">'.strip_tags($portfolio[company_description]).'</p>
				<a href="'.$portfolio[company_url].'" class="btn btn--green" target="_blank">Visit Website</a>
			</div>
		';
	}

}

function pull_all_testimonials($masterCategories){

	$page = get_page_by_title('Testimonials');
	$data = get_field('testimonials', $page->ID);

	foreach($data as $testimonial){

		echo '
			<li class="full-width slide">
				<div class="vertical-center">
					<h3 class="quote">'.$testimonial[testimonial].'</h3>
					<br clear="all">
					<span class="byline">
						<span class="byline-img"><img src="'.$testimonial[headshot].'" width="100%" height="auto" /></span>
						<p class="byline-credits"><strong>'.$testimonial[author].'</strong><br>'.$testimonial[title_and_company].'<br><a target="_blank" href="'.$testimonial[company_url].'">'.'Visit Website >'.'</a></p>
					</span>
				</div>
			</li>
		';
	}

    wp_reset_postdata();
}

function pull_all_bios($masterCategories){

	$page = get_page_by_title('Team');
	$data = get_field('team_members', $page->ID);
  $i = 0;
  $sn = 0;

	foreach($data as $teamMember){

		if($i%6 == 0) {
			echo $i > 0 ? "</div>" : "";
			echo "<div class='full-width slide'>";
		}

		echo '
			<li class="float-left col">
				<a href="/team" class="js-flyout-team-trigger" data-index="'.$sn.'">
					<img src="'.$teamMember[headshot][sizes]['team-thumbnail'].'" width="452" height="452" class="attachment-team-thumbnail size-team-thumbnail wp-post-image"/>
					<h4 class="title">'.strip_tags($teamMember[name]).'</h4><p class="role">'.$teamMember[title].'</p>
					<span class="hover-tip">
						<span class="vertical-center">
							<p>Full Bio &raquo;</p>
						</span>
					</span>
				</a>
			</li>
		';
	$i++;
	$sn++;
	}
}

function pull_all_bios_expanded($masterCategories){

	$page = get_page_by_title('Team');
	$data = get_field('team_members', $page->ID);
  $i = 0;
  $sn = 0;

	foreach($data as $teamMember){
		$bgImage = $teamMember[headshot][sizes]['full'];
		$email = ($teamMember[email_address])? '<a href="mailto:'.$teamMember[email_address].'" class="btn btn--green">Email '.$teamMember[name].' &raquo;</a>' : false;
		$linkedin = ($teamMember[linked_in])? '<a target="_blank" href="'.$teamMember[linked_in].'" class="btn btn--green">View '.$teamMember[name].'\'s LinkedIn &raquo;</a>' : false;
		echo '
			<div class="team-expanded-slide full-width">
				<img src="'.$teamMember[headshot][sizes]['team-thumbnail'].'" width="452" height="452" class="attachment-team-thumbnail size-team-thumbnail wp-post-image" />
				<div class="table-wrap">
					<div class="content">
						<h1 class="heading">'.$teamMember[name].'</h1>
						<h2 class="title">'.$teamMember[title].'</h2>
						<p class="desc">'.$teamMember[bio].'</p>
						<p class="desc">
							'.$email.' &nbsp; '.$linkedin.'
						</p>
					</div>
				</div>
			</div>
		';
	}

}

function pull_all_bios_flat($masterCategories){

	$page = get_page_by_title('Team');
	$data = get_field('team_members', $page->ID);
  $i = 0;
  $sn = 0;

	foreach($data as $teamMember){
		$bgImage = $teamMember[headshot][sizes]['full'];
		$email = ($teamMember[email_address])? '<a href="mailto:'.$teamMember[email_address].'" class="btn btn--green">Email '.$teamMember[name].' &raquo;</a>' : false;
		$linkedin = ($teamMember[linked_in])? '<a target="_blank" href="'.$teamMember[linked_in].'" class="btn btn--green">View '.$teamMember[name].'\'s LinkedIn &raquo;</a>' : false;
		echo '
			<div class="full-width team-cont">
				<img src="'.$teamMember[headshot][sizes]['team-thumbnail'].'" width="452" height="452" class="attachment-team-thumbnail size-team-thumbnail wp-post-image" />
				<h1 class="heading">'.$teamMember[name].'</h1>
				<h2 class="title">'.$teamMember[title].'</h2>
				<p class="desc">
					<a class="btn btn--green" href="/team">Read Bio &raquo;</a>
				</p>
			</div>
		';
	}

}

function truncate_utf8($string, $len, $wordsafe = FALSE, $dots = FALSE) {

  if (strlen($string) <= $len) {
    return $string;
  }

  if ($dots) {
    $len -= 4;
  }

  if ($wordsafe) {
    $string = substr($string, 0, $len + 1); // leave one more character
    if ($last_space = strrpos($string, ' ')) { // space exists AND is not on position 0
      $string = substr($string, 0, $last_space);
    }
    else {
      $string = substr($string, 0, $len);
    }
  }
  else {
    $string = substr($string, 0, $len);
  }

  if ($dots) {
    $string .= ' ...';
  }

  return $string;
}


function pull_all_news($masterCategories){
	$args = array(
        'post_type'=>'post',
        'category'=>$masterCategories['news'],
        'posts_per_page'=>3000,
        'order'=>'DESC',
        'orderby'=>'post_date',
        'post_status'=>'publish'
    );

	$myposts = get_posts( $args );
    $i = 0;

	foreach($myposts as $post){
		if($i%3 == 0) {
			echo $i > 0 ? "</div>" : "";
			echo "<div class='full-width slide'>";
		}
		$date = new DateTime($post->post_date);
		$dateFormatted = $date->format('F j, Y');
		$articleContent = truncate_utf8(strip_tags($post->post_content), 120, $wordsafe = TRUE, $dots = FALSE);
		echo '
			<li class="col">
				<a href="'.$post->guid.'">
					<h4 class="date">'.$dateFormatted.'</h4>
					<div class="body">
						<h3 class="title">'.truncate_utf8(strip_tags($post->post_title), 240, $wordsafe = TRUE, $dots = TRUE).'</h3>
						<p class="desc attr no-pad">
							<i class="bull">•</i> <em>Source: '.pull_custom_field($post->ID, 'article_source').'</em>
						</p>
					</div>
				</a>
			</li>
		';
	$i++;
	}

    wp_reset_postdata();
}

function pull_all_news_flat($masterCategories){
	$args = array(
        'post_type'=>'post',
        'category'=>$masterCategories['news'],
        'posts_per_page'=>3000,
        'order'=>'DESC',
        'orderby'=>'post_date',
        'post_status'=>'publish'
    );

	$myposts = get_posts( $args );
    $i = 0;

	foreach($myposts as $post){
		$date = new DateTime($post->post_date);
		$dateFormatted = $date->format('F j, Y');
		$articleContent = truncate_utf8(strip_tags($post->post_content), 120, $wordsafe = TRUE, $dots = FALSE);
		echo '
			<div class="full-width">
				<a href="'.$post->guid.'">
					<h4 class="date">'.$dateFormatted.'</h4>
					<div class="body">
						<h3 class="title">'.truncate_utf8(strip_tags($post->post_title), 240, $wordsafe = TRUE, $dots = TRUE).'</h3>
						<p class="desc attr no-pad">
							<i class="bull">•</i> <em>Source: '.pull_custom_field($post->ID, 'article_source').'</em>
						</p>
					</div>
				</a>
			</div>
		';
	$i++;
	}

    wp_reset_postdata();
}

function pull_all_gallery($masterCategories){
	$args = array(
        'post_type'=>'post',
        'category'=>$masterCategories['gallery'],
        'posts_per_page'=>3000,
        'order'=>'DESC',
        'orderby'=>'post_date',
        'post_status'=>'publish'
    );

	$myposts = get_posts( $args );
    $i = 0;

	foreach($myposts as $post){
		if($i%8 == 0) {
			echo $i > 0 ? "</div>" : "";
			echo "<div class='all slide'>";
		}
		$isVideo = (pull_custom_field($post->ID, 'youtube_url'))? true : false;
		$videoClass = ($isVideo)? 'video-link' : false;
		$iframe = ($isVideo)? 'fancybox.iframe': false;
		$lightbox=(!$isVideo)? 'fancybox-thumb' : 'fancybox-thumb';

		if (!$isVideo && has_post_thumbnail( $post->ID ) ){
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[0];
		}else{
			$image = pull_custom_field($post->ID, 'youtube_url');
		}

		echo '
			<li class="col">
				<a href="'.$image.'" class="'.$videoClass.' '.$lightbox.' '.$iframe.'"   rel="'.$lightbox.'" title="'.$post->post_title.'">
				'.pull_select_post_image($post->ID, 'gallery-thumbnail').'
				</a>
				<p>'.$post->post_title.'</p>
			</li>
		';
	$i++;
	}

    wp_reset_postdata();
}


function pull_all_gallery_flat($masterCategories){
	$args = array(
        'post_type'=>'post',
        'category'=>$masterCategories['gallery'],
        'posts_per_page'=>3000,
        'order'=>'DESC',
        'orderby'=>'post_date',
        'post_status'=>'publish'
    );

	$myposts = get_posts( $args );
    $i = 0;

	foreach($myposts as $post){
		$isVideo = (pull_custom_field($post->ID, 'youtube_url'))? true : false;
		$videoClass = ($isVideo)? 'video-link' : false;
		$iframe = ($isVideo)? 'fancybox.iframe': false;
		$lightbox=(!$isVideo)? 'fancybox-thumb' : 'fancybox-thumb';

		if (!$isVideo && has_post_thumbnail( $post->ID ) ){
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[0];
		}else{
			$image = pull_custom_field($post->ID, 'youtube_url');
		}

		echo '
			<div class="full-width gallery-item">
				<a href="'.$image.'" class="'.$videoClass.' '.$lightbox.' '.$iframe.'"   rel="'.$lightbox.'" title="'.$post->post_title.'">
				'.pull_select_post_image($post->ID, 'gallery-thumbnail').'
				</a>
				<p>'.$post->post_title.'</p>
			</div>
		';
	$i++;
	}

    wp_reset_postdata();
}



?>
