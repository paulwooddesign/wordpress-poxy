<section class="rel bg10">
	<span id="loader" class="paxy fill z10" style='display:none;'>
		<div class="loading rel fill poxy bgs-contain">
			<div class="_oxya116a_116 _oxyb116b_116 bgs-contain" style="background-image: url(<?php bloginfo("url"); ?>/images/loading.gif);"></div>
		</div>
	</span>
	<div class="sw">
		<div class="cw">
			<div class="rel poxya14a_116 poxyb14b_116 poxyc12c_14 poxyd12d_12 poxye11e_18">
				<h2>Speed Ring Finder</h2>
			</div>

		  <figure class="rel poxya14a_116 poxyb14b_116 poxyc12c_116 qoxyd12d_18 poxye11e_18">
		    <select class="fill" onchange="loadBrands(this);"  id="opt_make" name="opt_make">
		      <option value="-1">Fixture Type</option>
		      <?php
						$result=SRF_getAllMakes();
						if(isset($result) && count($result) > 0) {
							foreach($result as $rows) {
								// if($meta_box_make == $rows->makeId) {
								// 	echo '<option selected=selected value='. $rows->makeId . '>' . $rows->MakeName . '</option>';
								// } else {
									echo '<option value='. $rows->makeId . '>' . $rows->MakeName . '</option>';
								// }
							}
						}
					?>
		    </select>
		  </figure>

		  <figure class="rel poxya14a_116 poxyb14b_116 poxyc12c_116 qoxyd12d_18 poxye11e_18">
		    <select class="fill" disabled="disabled"  onchange="loadFixtures(this);" name="opt_model" id="opt_model">
		      <option value="-1">Fixture Brand</option>
		    </select>
		  </figure>

		  <figure class="rel poxya14a_116 poxyb14b_116 poxyc12c_116 qoxyd12d_18 poxye11e_18">
		    <select class="fill" disabled="disabled" onchange="loadSpeedRings();" id="year"  name="year">
		      <option value="-1">Select Fixture</option>
		    </select>
		  </figure>


		</div>
	</div>
</section>
<div id="speed-ring-finder-holder"></div>
