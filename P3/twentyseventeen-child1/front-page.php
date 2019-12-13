<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php
		// Show the selected front page content.
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/page/content', 'front-page' );
			endwhile;
		else :
			get_template_part( 'template-parts/post/content', 'none' );
		endif;
		?>

		<?php
		// Get each of our panels and show the post data.
		if ( 0 !== twentyseventeen_panel_count() || is_customize_preview() ) : // If we have pages to show.

			/**
			 * Filter number of front page sections in Twenty Seventeen.
			 *
			 * @since Twenty Seventeen 1.0
			 *
			 * @param int $num_sections Number of front page sections.
			 */
			$num_sections = apply_filters( 'twentyseventeen_front_page_sections', 4 );
			global $twentyseventeencounter;

			// Create a setting and control for each of the sections available in the theme.
			for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
				$twentyseventeencounter = $i;
				twentyseventeen_front_page_section( null, $i );
			}

	endif; // The if ( 0 !== twentyseventeen_panel_count() ) ends here.
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php if ( is_active_sidebar( 'custom-side-bar' ) ) : ?>
    <?php dynamic_sidebar( 'custom-side-bar' ); ?>
<?php endif; ?>




<div id="sidebar-primary" class="sidebar2">
    <?php dynamic_sidebar( 'primary' ); ?>
    <div style="width:15%; float:right"><p></p></div>
    <div style="width:40%; float:right">
    <aside>
 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24455.515714601082!2d-0.06557257362753323!3d39.98745813269478!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5ffe2bb82bc197%3A0xbf89204be1c64f49!2sCastell%C3%B3n%20de%20la%20Plana%2C%20Castell%C3%B3n!5e0!3m2!1ses!2ses!4v1573838660132!5m2!1ses!2ses" style="border:0;" allowfullscreen="" width="600" height="450" frameborder="0"></iframe>
 <p>
  <a class="menu-principal-container" href="https://www.google.es/maps/place/Castell%C3%B3n+de+la+Plana,+Castell%C3%B3n/@39.9874581,-0.0655726,14z/data=!3m1!4b1!4m5!3m4!1s0xd5ffe2bb82bc197:0xbf89204be1c64f49!8m2!3d39.9863563!4d-0.0513246?hl=es" style="color:#0000FF">&nbsp; Ampliar el mapa &nbsp;</a>
 </p>

 <iframe src="https://www.meteoblue.com/en/weather/widget/three/castell%c3%b3n-de-la-plana_spain_2519752?geoloc=fixed&nocurrent=0&noforecast=0&days=4&tempunit=CELSIUS&windunit=KILOMETER_PER_HOUR&layout=image&location_url=https%3A%2F%2Fwww.meteoblue.com%2Fen%2Fweather%2Fwidget%2Fthree%2Fcastell%25c3%25b3n-de-la-plana_spain_2519752&location_mainUrl=https%3A%2F%2Fwww.meteoblue.com%2Fen%2Fweather%2Fweek%2Fcastell%25c3%25b3n-de-la-plana_spain_2519752&nolocation_url=https%3A%2F%2Fwww.meteoblue.com%2Fen%2Fweather%2Fwidget%2Fthree&nolocation_mainUrl=https%3A%2F%2Fwww.meteoblue.com%2Fen%2Fweather%2Fweek%2Findex&dailywidth=115&tracking=%3Futm_source%3Dweather_widget%26utm_medium%3Dlinkus%26utm_content%3Dthree%26utm_campaign%3DWeather%252BWidget"  frameborder="0" scrolling="NO" allowtransparency="true" sandbox="allow-same-origin allow-scripts allow-popups allow-popups-to-escape-sandbox" style="width: 600px;height: 490px"></iframe><div>

</aside>
</div>
</div>




<?php
get_footer();
