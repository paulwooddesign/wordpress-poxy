jQuery(document).ready(function($){
	//toggle 3d navigation
	$('.cd-3d-nav-trigger').on('click', function(){
		toggle3dBlock(!$('.cd-header').hasClass('nav-is-visible'));
	});

	//select a new item from the 3d navigation
	$('.cd-3d-nav a').on('click', function(){
		var selected = $(this);
		selected.parent('li').addClass('cd-selected').siblings('li').removeClass('cd-selected');
		updateSelectedNav('close');
	});

	$(window).on('resize', function(){
		window.requestAnimationFrame(updateSelectedNav);
	});

	function toggle3dBlock(addOrRemove) {
		if(typeof(addOrRemove)==='undefined') addOrRemove = true;
		$('.cd-header').toggleClass('nav-is-visible', addOrRemove);
		$('main').toggleClass('nav-is-visible', addOrRemove);
		$('.cd-3d-nav-container').toggleClass('nav-is-visible', addOrRemove);
	}

	//this function update the .cd-marker position
	function updateSelectedNav(type) {
		var selectedItem = $('.cd-selected'),
			selectedItemPosition = selectedItem.index() + 1,
			leftPosition = selectedItem.offset().left,
			backgroundColor = selectedItem.data('color');

		$('.cd-marker').removeClassPrefix('color').addClass('color-'+ selectedItemPosition).css({
			'left': leftPosition,
		});
		if( type == 'close') {
			$('.cd-marker').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				toggle3dBlock(false);
			});
		}
	}

	$.fn.removeClassPrefix = function(prefix) {
	    this.each(function(i, el) {
	        var classes = el.className.split(" ").filter(function(c) {
	            return c.lastIndexOf(prefix, 0) !== 0;
	        });
	        el.className = $.trim(classes.join(" "));
	    });
	    return this;
	};
});






$(document).ready(function(){
  var mouseX, mouseY;
  var ww = $( window ).width();
  var wh = $( window ).height();
  var traX, traY;
  $(document).mousemove(function(e){
     mouseX = e.pageX;
     mouseY = e.pageY;
    console.log(mouseX + " e mouseY" + mouseY);
    console.log(ww + " e wh" + wh);
    traX = ((4 * mouseX) / 570) + 40;
    traY = ((4 * mouseY) / 570) + 50;
    console.log(traX);
    $(".title").css({"background-position": traX + "%" + traY + "%"});
  });
});





(function($) {
  var speed = 900;
  var container =  $('.thumbs');
  container.each(function() {
    var elements = $(this).children();
    elements.each(function() {
      var elementOffset = $(this).offset();
      var offset = elementOffset.left*0.8 + elementOffset.top;
      var delay = parseFloat(offset/speed).toFixed(2);
      $(this)
        .css("-webkit-transition-delay", delay+'s')
        .css("-o-transition-delay", delay+'s')
        .css("transition-delay", delay+'s')
        .addClass('animated');
    });
  });
})(jQuery);




var start = 10;
var end = 57;
var imgs = [];

for (var i = start; i <= end; i++) {
  imgs.push('https://s3-us-west-2.amazonaws.com/s.cdpn.io/2361/alcyone'+i+'.jpg');
}



var preload = [];
for (i = 0; i < imgs.length; i++) {
  preload[i] = new Image()
  preload[i].src = imgs[i]
}



$(window).load(function() {

$.fn.glitch = function(imgs, min, max) {
  return this.each(function() {
    var $obj = $(this);
    var count = 0;
    var total = imgs.length;
    function fglitch() {
      var interval = Math.random()*(max-min)+min;
      setTimeout(function() {
        $obj.css('background-image', 'url(\''+imgs[count]+'\'), url(\''+imgs[0]+'\')');
        if (count < total) {
          count++;
        } else {
          count = 0;
        }
        fglitch(imgs[count]);
      }, interval);
    };
    fglitch();
  });
};

$('.screen').glitch(imgs, 100, 500);

});
