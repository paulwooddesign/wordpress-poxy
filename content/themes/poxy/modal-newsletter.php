<div modal="showModal"></div><script type="text/ng-template" id="modal.html"><div ng-show="modal" class="modal-overlay" ng-click="close()">
  <div class="modal a12 b12" ng-click="$event.stopPropagation()">
    <span ng-transclude></span>
    <div ng-click="close()" class="modal-close rel qoxya124a_124 z5 qoxyb124b_124 qoxyc118c_118 qoxyd116d_116 qoxye18e_18">
      <svg-icon p="close">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
          <path d="M4 8 L8 4 L16 12 L24 4 L28 8 L20 16 L28 24 L24 28 L16 20 L8 28 L4 24 L12 16 z"></path>
        </svg>
      </svg-icon>
    </div>
  </div>
</div></script>