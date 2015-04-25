<!DOCTYPE html><!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7">
<![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8">
<![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9">
<![endif]-->
<!--[if gt IE 8]><!--><html ng-app="poxy" ng-controller="MainCtrl" ng-init="load()" resize="" class="no-js"><!--<![endif]--><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><title><?php wp_title(); ?></title><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script><script src="<?php bloginfo("template_url"); ?>/scripts/pjax.js"></script><script src="<?php bloginfo("template_url"); ?>/scripts/init.js"></script><meta name="description" content=""><meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no"><meta http-equiv="cleartype" content="on"><meta content="yes" name="apple-mobile-web-app-capable"><meta name="apple-mobile-web-app-status-bar-style" content="black"><link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>"><link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>"><link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"><link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png"><link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png"><link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png"><link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png"><link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png"><link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png"><link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png"><link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png"><link rel="icon" type="image/png" href="/favicon-192x192.png" sizes="192x192"><link rel="icon" type="image/png" href="/favicon-160x160.png" sizes="160x160"><link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96"><link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16"><link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32"><script src="<?php get_bloginfo("url"); ?>/images/modernizr.custom.js"></script><meta name="msapplication-TileColor" content="#da532c"><meta name="msapplication-TileImage" content="/mstile-144x144.png"><link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen"><link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/styles/skin-light.css" type="text/css" media="screen"><script type="text/javascript">(function() {
  var path = '//easy.myfonts.net/v2/js?sid=214451(font-family=Harmonia+Sans+Std+Light)&sid=214453(font-family=Harmonia+Sans+Std+Regular)&sid=214455(font-family=Harmonia+Sans+Std+SemiBold)&key=Rt6eJm96B8',
  protocol = ('https:' == document.location.protocol ? 'https:' : 'http:'),
  trial = document.createElement('script');
  trial.type = 'text/javascript';
  trial.async = true;
  trial.src = protocol + path;
  var head = document.getElementsByTagName("head")[0];
  head.appendChild(trial);
  })();
  
  </script><?php wp_head(); ?></head><body id="fluidDiv" class="rel fs___3 lh___3"><!--[if lt IE 7]><p class="browsehappy">You are using an<strong>outdated</strong> browser. Please<a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]--><div class="logo-color pfxy a15a_15b16b_16c14c_14d18d_18e15e_15"></div><div id="pjax-preloader" class="pfxy z10 fill hide"><div title="0" class="oxy pla__15 plb__15 plc__14"><svg id="loader-1" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px" viewbox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve"><path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946          s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634          c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"></path><path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0          C22.32,8.481,24.301,9.057,26.013,10.047z"><animatetransform attributetype="xml" attributename="transform" type="rotate" from="0 20 20" to="360 20 20" dur="0.5s" repeatcount="indefinite"></animatetransform></path></svg></div></div><?php get_template_part( 'nav-right' ); ?><div id="container-wrapper" class="rel p100 pla__15 plb__16 plc__14"><div id="container"><?php $post_type = get_post_type( get_the_ID() ); ?><?php if (is_archive()) : ?><?php if (is_tax()) : ?><?php $tax_type = $wp_query->tax_query->queries[0]['taxonomy']; ?><?php get_template_part( 'template-taxonomy-'. $tax_type ); ?><?php else : ?><?php get_template_part( 'template-archive' ); ?><?php endif; ?><?php elseif (is_single()) : ?><?php get_template_part( 'template-single-'. $post_type ); ?><?php elseif (is_page()) : ?><?php $slug = poxy_slug(); ?><?php get_template_part( 'template-'. $slug ); ?><?php elseif (is_search()) : ?><?php get_template_part( 'templates/search' ); ?><?php elseif (is_404()) : ?><?php get_template_part( 'template-404' ); ?><?php else : ?><?php get_template_part( 'template-blog' ); ?><?php endif; ?></div></div><script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-3976184-21');
ga('send', 'pageview');
</script><!--[if lt IE 9]><script src="bower_components/es5-shim/es5-shim.js"></script><script src="bower_components/json3/lib/json3.min.js"></script><![endif]--><script src="<?php bloginfo("template_url"); ?>/scripts/vendor.js"></script><script src="<?php bloginfo("template_url"); ?>/scripts/scripts.js"></script><script src="<?php bloginfo("template_url"); ?>/scripts/main.js"></script><script>jQuery( window ).load(function() {
  var myScroll;
  
  //- myScroll = new IScroll('#workScroller', {bounceEasing: 'elastic', bounceTime: 1200, click: true, mouseWheel: true, tap: true, scrollbars: 'custom', interactiveScrollbars: 'true', shrinkScrollbars: 'scale', fadeScrollbars: false });
  
  myScroll = new IScroll('#iscroll', {bounceEasing: 'elastic', bounceTime: 1200, click: true, mouseWheel: true, tap: true, scrollbars: 'custom', interactiveScrollbars: 'true', shrinkScrollbars: 'scale', fadeScrollbars: false });
  
  
  //- document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
  
//- var workScroller;
//- jQuery( window ).load(function() {
//-   workScroller = new IScroll('#workScroller', {
//-   bounceEasing: 'circular',
//-   bounceTime: 600,
//-   mouseWheelSpeed: 30,
//-   mouseWheel: true,
//-   tap: true,
//-   click: true,
//-   scrollbars: 'custom',
//-   interactiveScrollbars: true,
//-   shrinkScrollbars: 'scale',
//-   fadeScrollbars: false
//-   });
  //- document.getElementById('client-chimera').addEventListener('tap', function () { this.style.background = !this.style.background ? '#a00' : ''; }, false);
  
});


</script><?php wp_footer(); ?></body></html>