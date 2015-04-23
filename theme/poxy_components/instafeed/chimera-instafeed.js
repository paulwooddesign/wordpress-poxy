jQuery(document).ready(function(){
	var instaFeed = new Instafeed({
    get: 'user',
    userId: 982406709,
    accessToken: '34139106.467ede5.2e8f6b6a9cf846f6bd23169b624aca22',
    target: 'instafeed',
    sortBy: 'most-recent',
		// template: '<a class="animation" href="{{link}}"><img src="{{image}}" /></a>',
		template: '<figure class="poxya110a_110poxyb110b_110poxyc18c_18poxyd18d_18poxye16e16 mr1 rel mb0"><a target="_blank" href="{{link}}"><div class="paxy fill" style="background-image: url({{image}})"></div></a></figure>',
    limit: 9,
    resolution: 'low_resolution'
	});
	instaFeed.run();
});


// figure.poxya110a_110.mr1.rel.mb0
// 	a(href="#/single-product")
// 		.paxy.fill(style='background-image: url(images/instagram.jpg);')= n++


jQuery(".video-container").fitVids();
