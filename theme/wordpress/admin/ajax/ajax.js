function loadProject(projectCatSlug) {
	// Scroll to the top of the projects
	jQuery("#ajax-cat-loader").load(
			MyAjax.ajaxurl,
			{
					action : 'myajax-submit',
					slug : projectCatSlug
			},
			function( success ) {

				onCompletion();


			}
	);
}

function onCompletion () {
  // Update here your DOM
  // setTimeout(function () {
  //     myScroll.refresh();
  // }, 200);
	// alert('iscroll reset 2');

	// var myScroll;
	// myScroll = new IScroll('#iscroll', {bounceEasing: 'elastic', bounceTime: 1200, click: true, mouseWheel: true, tap: true, scrollbars: 'custom', interactiveScrollbars: 'true', shrinkScrollbars: 'scale', fadeScrollbars: false });
	// // alert('iscroll added');

	pjax.connect('container', 'pjax');

};
