
<div>
<ul id="gn-menu" class="gn-menu-main">
	<li class="gn-trigger">
		<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
		<nav class="gn-menu-wrapper">
			<div class="gn-scroller">
				<ul class="gn-menu">

				<!-- 	<li class="gn-search-item">
						<input placeholder="Search" type="search" class="gn-search">
						<a class="gn-icon gn-icon-search"><span>Search</span></a>
					</li>

					<li>
						<a class="gn-icon gn-icon-download">Downloads</a>
						<ul class="gn-submenu">
							<li><a class="gn-icon gn-icon-illustrator">Vector Illustrations</a></li>
							<li><a class="gn-icon gn-icon-photoshop">Photoshop files</a></li>
						</ul>
					</li> -->

					<!-- <li><a class="gn-icon gn-icon-cog">Settings</a></li>
					<li><a class="gn-icon gn-icon-help">Help</a></li> -->
					<li>
					<a class="gn-icon gn-icon-archive">Navigation</a>
					<div class="layout-options">
					<!-- <ul class="gn-submenu">
						<li><a onclick="cookie_top_fixed();" data-view="top_fixed" id="icon-top_fixed" class="gn-icon icon-top-fixed">Top Fixed</a></li>
						<li><a onclick="cookie_top_nav();" data-view="top_nav"  id="icon-top_nav" class="gn-icon icon-top-absolute">Top</a></li>
						<li><a onclick="cookie_left_fixed();" data-view="left_fixed" id="icon-left_fixed" class="icon-left-fixed gn-icon">Left Fixed</a></li>
						<li><a onclick="cookie_hso_menu();" data-view="hso_menu" id="icon-hso_menu" class="icon-hso-menu gn-icon">Horizontal Slide Out</a></li>
						<li><a onclick="cookie_hdd_menu();" data-view="hdd_menu" id="icon-hdd_menu" class="icon-hdd-menu gn-icon">Horizontal Drop</a></li>
					</ul> -->
				</div>
			</li>
		</ul>
	</div><!-- /gn-scroller -->
	</nav>
	</li>
	<li>
		<a href="#" class="icon-logo">
			<span id="cols4">4X</span>
			<span id="cols4_p5">4.5X</span>
			<span id="cols5">5X</span>
			<span id="cols5_p5">5.5X</span>
			<span id="cols6">6X</span>
			<span id="cols6_p5">6.5X</span>
			<span id="cols7">7X</span>
			<span id="cols8">8X</span>
			<span id="cols9">9X</span>
			<span id="cols10">10X</span>
			<span id="cols11">11X</span>
			<span id="cols12">12X</span>
			<span id="cols13">13X</span>
			<span id="cols14">14X</span>
			<span id="cols15">15X</span>
			<span id="cols16">16X</span>
			<span id="cols17">17X</span>
			<span id="cols18">18X</span>
			<span id="cols19">19X</span>
			<span id="cols20">20X</span>
			<span id="cols21">21X</span>
			<span id="cols22">22X</span>
			<span id="cols23">20X</span>
			<span id="cols24">24X</span>
			<span id="cols25">25X</span>
			<span id="cols26">26X</span>
			<span id="cols27">27X</span>
			<span id="cols28">28X</span>
			<span id="cols29">29X</span>
			<span id="cols30" style="">30X</span>
		</a>
	</li>
	<li><a href="<?php echo bloginfo('wpurl'); ?>/wp-admin">Dashboard</a></li>
	<li><a class="codrops-icon codrops-icon-prev" href="<?php echo get_edit_post_link(); ?> "><span>Edit Page</span></a></li>
	<li><a class="codrops-icon codrops-icon-drop" href="<?php echo bloginfo('wpurl'); ?>/wp-admin/themes.php?page=options-framework"><span>Theme Options</span></a></li>
	<li><a class="codrops-icon codrops-icon-drop" href="<?php echo bloginfo('wpurl'); ?>/wp-admin/nav-menus.php"><span>Menu</span></a></li>
	<li>
		<a href="#" class="icon-logo">
			<span id="cols4">4X</span>
			<span id="cols4_p5">4.5X</span>
			<span id="cols5">5X</span>
			<span id="cols5_p5">5.5X</span>
			<span id="cols6">6X</span>
			<span id="cols6_p5">6.5X</span>
			<span id="cols7">7X</span>
			<span id="cols8">8X</span>
			<span id="cols9">9X</span>
			<span id="cols10">10X</span>
			<span id="cols11">11X</span>
			<span id="cols12">12X</span>
			<span id="cols13">13X</span>
			<span id="cols14">14X</span>
			<span id="cols15">15X</span>
			<span id="cols16">16X</span>
			<span id="cols17">17X</span>
			<span id="cols18">18X</span>
			<span id="cols19">19X</span>
			<span id="cols20">20X</span>
			<span id="cols21">21X</span>
			<span id="cols22">22X</span>
			<span id="cols23">20X</span>
			<span id="cols24">24X</span>
			<span id="cols25">25X</span>
			<span id="cols26">26X</span>
			<span id="cols27">27X</span>
			<span id="cols28">28X</span>
			<span id="cols29">29X</span>
			<span id="cols30" style="">30X</span>
		</a>
	</li>
</ul>
</div>

<?php /*/ ?>
<?php //$main_nav_layout = json_decode(base64_decode($_COOKIE['nav'], true)); ?>
<script type="text/javascript">
//<![CDATA[
//document.getElementById("icon-<?php echo $main_nav_layout->name; ?>").className += " cbp-vm-selected";

//]]>
</script>
<!-- /Development -->

<script>
jQuery(document).ready(function(){
new gnMenu( document.getElementById( 'gn-menu' ) );
});
</script>

<?php //*/ ?>


