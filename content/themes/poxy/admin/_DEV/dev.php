

<div class="cbp-vm-options">
<ul class="cbp-vimenu cbp-vm-options">
	<li>
		<a href="<?php echo bloginfo('wpurl'); ?>/wp-admin" class="icon-logo">
			<div id="cols4">4X</div>
			<div id="cols4_p5">4.5X</div>
			<div id="cols5">5X</div>
			<div id="cols5_p5">5.5X</div>
			<div id="cols6">6X</div>
			<div id="cols6_p5">6.5X</div>
			<div id="cols7">7X</div>
			<div id="cols8">8X</div>
			<div id="cols9">9X</div>
			<div id="cols10">10X</div>
			<div id="cols11">11X</div>
			<div id="cols12">12X</div>
			<div id="cols13">13X</div>
			<div id="cols14">14X</div>
			<div id="cols15">15X</div>
			<div id="cols16">16X</div>
			<div id="cols17">17X</div>
			<div id="cols18">18X</div>
			<div id="cols19">19X</div>
			<div id="cols20">20X</div>
			<div id="cols21">21X</div>
			<div id="cols22">22X</div>
			<div id="cols23">20X</div>
			<div id="cols24">24X</div>
			<div id="cols25">25X</div>
			<div id="cols26">26X</div>
			<div id="cols27">27X</div>
			<div id="cols28">28X</div>
			<div id="cols29">29X</div>
			<div id="cols30" style="">30X</div>
		</a>
	</li>

	<li><a href="#"  onclick="cookie_left_fixed();" data-view="left_fixed" id="icon-left_fixed" class="icon-left-fixed cbp-vm-grid">Left Fixed</a></li>
	<li><a href="#" onclick="cookie_top_fixed();" data-view="top_fixed" id="icon-top_fixed" class="icon-top-fixed">Top Fixed</a></li>
	<li><a href="#" onclick="cookie_top_nav();" data-view="top_nav"  id="icon-top_nav" class="icon-top-absolute">Top</a></li>

	<!-- Example for active item:
	<li class="cbp-vicurrent"><a href="#" class="icon-pencil">Pencil</a></li>
	-->
	<!-- <li><a href="#" class="icon-location">Location</a></li>
	<li><a href="#" class="icon-images">Images</a></li>
	<li><a href="#" class="icon-download">Download</a></li> -->
</ul>
</div>


<!-- Development -->
<a href="<?php echo bloginfo('wpurl'); ?>/wp-admin">
<div id="browser-size" style="display:none;">
<?php $main_nav = json_decode(base64_decode($_COOKIE['nav'], true)); ?>
<?php echo $main_nav->name; ?>

	<div id="cols4">4X</div>
	<div id="cols4_p5">4.5X</div>
	<div id="cols5">5X</div>
	<div id="cols5_p5">5.5X</div>
	<div id="cols6">6X</div>
	<div id="cols6_p5">6.5X</div>
	<div id="cols7">7X</div>
	<div id="cols8">8X</div>
	<div id="cols9">9X</div>
	<div id="cols10">10X</div>
	<div id="cols11">11X</div>
	<div id="cols12">12X</div>
	<div id="cols13">13X</div>
	<div id="cols14">14X</div>
	<div id="cols15">15X</div>
	<div id="cols16">16X</div>
	<div id="cols17">17X</div>
	<div id="cols18">18X</div>
	<div id="cols19">19X</div>
	<div id="cols20">20X</div>
	<div id="cols21">21X</div>
	<div id="cols22">22X</div>
	<div id="cols23">20X</div>
	<div id="cols24">24X</div>
	<div id="cols25">25X</div>
	<div id="cols26">26X</div>
	<div id="cols27">27X</div>
	<div id="cols28">28X</div>
	<div id="cols29">29X</div>
	<div id="cols30">30X</div>

		<div class="cbp-vm-options">
			<a href="#" onclick='cookie_left_fixed();' style="float:left;" class=" cbp-vm-icon cbp-vm-grid cbp-vm-selected" data-view="left_fixed">Fixed Left</a>
			<div class="clearboth"></div>
			<a href="#" onclick='cookie_top_nav();' style="float:left;" class=" cbp-vm-icon" data-view="top_nav">Top</a>
			<div class="clearboth"></div>
			<a href="#" onclick='cookie_top_fixed();' style="float:left;" class=" cbp-vm-icon" data-view="top_fixed">Fixed top</a>
		</div>
</div>
</a>

<?php $main_nav_layout = json_decode(base64_decode($_COOKIE['nav'], true)); ?>
<script type="text/javascript">
//<![CDATA[
document.getElementById("icon-<?php echo $main_nav_layout->name; ?>").className += " cbp-vm-selected";
//]]>
</script>
<!-- /Development -->












