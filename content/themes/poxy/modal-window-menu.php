<div modal="showModal"></div><script type="text/ng-template" id="modal.html"><div ng-show="modal" class="modal-overlay" ng-click="close()">
  <div style="overflow: scroll;" class="modal-menu paxy fill" ng-click="$event.stopPropagation()">
    <span ng-transclude></span>
    <section>
      <div class="sw">
        <div id="overlay-menu" class="cw tx-u tx-c rel">
          <div ng-click="close()" class="modal-close qaxya124a_124 z5 qaxyb124b_124 qaxyc118c_118 qaxyd116d_116 qaxye18e_18">X</div>
          <div class="txa-8">
            <a ng-click="close()" class="m2 poxya11 poxyb11 poxyc11 poxyd11 poxye11" href="<?php bloginfo("url"); ?>">Home</a>
            <a ng-click="close()" class="m2 poxya11 poxyb11 poxyc11 poxyd11 poxye11" href="<?php bloginfo("url"); ?>/work">Work</a>
            <a ng-click="close()" class="m2 poxya11 poxyb11 poxyc11 poxyd11 poxye11" href="<?php bloginfo("url"); ?>/about">About</a>
            <a ng-click="close()" class="m2 poxya11 poxyb11 poxyc11 poxyd11 poxye11" href="<?php bloginfo("url"); ?>/clients">Clients</a>
            <a ng-click="close()" class="m2 poxya11 poxyb11 poxyc11 poxyd11 poxye11" href="<?php bloginfo("url"); ?>/journal">Journal</a>
          </div>
        </div>
      </div>
    </section>
  </div>
</div></script>