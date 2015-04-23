<section class="rel bg10"><span id="loader" style="display:none;" class="paxy fill z10"><div class="loading rel fill poxy bgs-contain"><div style="background-image: url(<?php bloginfo("url"); ?>/images/loading.gif)" class="_oxya116a_116 _oxyb116b_116 _oxyc18c_18 _oxyd18d_18 _oxye18e_18 bgs-contain"></div></div></span><div class="sw"><div class="cw"><div class="rel poxya14a_116 poxyb14b_116 poxc14c_110 poxd11 poxe11"><h2>Speed Ring Finder</h2></div><figure class="rel poxya14a_116 poxyb14b_116 poxyc14c_110 qoxyd13d_18 poxye11e_18"><select id="opt_make" onchange="loadBrands(this);" name="opt_make" class="fill"><option value="-1">Fixture Type</option><?php $result=SRF_getAllMakes();
if(isset($result) && count($result) > 0) {
  foreach($result as $rows) {
    // if($meta_box_make == $rows->makeId) {
    // 	echo '<option selected=selected value='. $rows->makeId . '>' . $rows->MakeName . '</option>';
    // } else {
      echo '<option value='. $rows->makeId . '>' . $rows->MakeName . '</option>';
    // }
  }
}
 ?></select></figure><figure class="rel poxya14a_116 poxyb14b_116 poxyc14c_110 qoxyd13d_18 poxye11e_18"><select id="opt_model" disabled="disabled" onchange="loadFixtures(this);" name="opt_model" class="fill"><option value="-1">Fixture Brand</option></select></figure><figure class="rel poxya14a_116 poxyb14b_116 poxyc14c_110 qoxyd13d_18 poxye11e_18"><select id="year" disabled="disabled" onchange="loadSpeedRings();" name="year" class="fill"><option value="-1">Select Fixture</option></select></figure></div></div></section><div id="speed-ring-finder-holder"></div>