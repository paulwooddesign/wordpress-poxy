(function ($) {
  // skel.init({
  // 	reset: 'full',
  // 	breakpoints: {
  // 		global: { href: '/content/themes/paulwood/styles/main.css' },
  // 		// xlarge: { media: '(max-width: 1680px)', href: '/content/themes/paulwood/styles/poxy-a.css' },
  // 		xlarge: { media: '(min-width: 1680px)', href: '/content/themes/paulwood/styles/poxy-a.css' },
  // 		// large: { media: '(max-width: 1140px)', href: '/content/themes/paulwood/styles/poxy-b.css' },
  // 		large: { media: '(max-width: 1680px)', href: '/content/themes/paulwood/styles/poxy-b.css' },
  // 		// medium: { media: '(max-width: 980px)', href: '/content/themes/paulwood/styles/poxy-c.css' },
  //
  // 		zoneA17: { media: '(max-width: 1308px)', href: '/content/themes/paulwood/styles/poxy-a-17.css' },
  // 		zoneA16: { media: '(max-width: 1392px)', href: '/content/themes/paulwood/styles/poxy-a-16.css' },
  // 		// small: { media: '(max-width: 736px)', href: '/content/themes/paulwood/styles/poxy-d.css' },
  //
  // 		medium: { media: '(max-width: 1024px)', href: '/content/themes/paulwood/styles/poxy-c.css' },
  // 		// small: { media: '(max-width: 736px)', href: '/content/themes/paulwood/styles/poxy-d.css' },
  // 		small: { media: '(max-width: 696px)', href: '/content/themes/paulwood/styles/poxy-d.css' },
  // 		xsmall: { media: '(max-width: 480px)', href: '/content/themes/paulwood/styles/poxy-e.css' }
  // 		// xxsmall: { media: '(max-width: 320px)', href: 'css/style-xxsmall.css' }
  // 	}
  // });
  var gridPath = '/content/themes/poxy/styles/';
  // var gridPath = '/grids/'
  skel.init({
    reset: 'full',
    breakpoints: {
      global: { href: '/content/themes/poxy/styles/main.css' },
      zoneA26: {
        media: '(min-width: 2590px)',
        href: gridPath + 'poxy-a-22.css'
      },
      zoneA25: {
        media: '(min-width: 2462px) and (max-width: 2589px)',
        href: gridPath + 'poxy-a-21.css'
      },
      zoneA24: {
        media: '(min-width: 2334px) and (max-width: 2461px)',
        href: gridPath + 'poxy-a-20.css'
      },
      zoneA23: {
        media: '(min-width: 2206px) and (max-width: 2333px)',
        href: gridPath + 'poxy-a-19.css'
      },
      zoneA22: {
        media: '(min-width: 2078px) and (max-width: 2205px)',
        href: gridPath + 'poxy-a-18.css'
      },
      zoneA21: {
        media: '(min-width: 1950px) and (max-width: 2077px)',
        href: gridPath + 'poxy-a-17.css'
      },
      zoneA20: {
        media: '(min-width: 1822px) and (max-width: 1949px)',
        href: gridPath + 'poxy-a-16.css'
      },
      zoneA19: {
        media: '(min-width: 1694px) and (max-width: 1821px)',
        href: gridPath + 'poxy-a-15.css'
      },
      zoneA18: {
        media: '(min-width: 1568px) and (max-width: 1693px)',
        href: gridPath + 'poxy-a-14.css'
      },
      zoneA17: {
        media: '(min-width: 1438px) and (max-width: 1567px)',
        href: gridPath + 'poxy-a-13.css'
      },
      zoneA16: {
        media: '(min-width: 1309px) and (max-width: 1437px)',
        href: gridPath + 'poxy-a-12.css'
      },
      zoneB12: {
        media: '(min-width: 1260px) and (max-width: 1308px)',
        href: gridPath + 'poxy-b-11.css'
      },
      zoneB11: {
        media: '(min-width: 1152px) and (max-width: 1260px)',
        href: gridPath + 'poxy-b-10.css'
      },
      zoneB10: {
        media: '(min-width: 1081px) and (max-width: 1152px)',
        href: gridPath + 'poxy-b-9.css'
      },
      zoneC1: {
        media: '(min-width: 937px) and (max-width: 1080px)',
        href: gridPath + 'poxy-c-10.css'
      },
      zoneC2: {
        media: '(min-width: 829px) and (max-width: 936px)',
        href: gridPath + 'poxy-c-9.css'
      },
      zoneD1: {
        media: '(min-width: 721px) and (max-width: 828px)',
        href: gridPath + 'poxy-d-10.css'
      },
      zoneD2: {
        media: '(min-width: 656px) and (max-width: 720px)',
        href: gridPath + 'poxy-d-9.css'
      },
      zoneD3: {
        media: '(min-width: 561px) and (max-width: 655px)',
        href: gridPath + 'poxy-d-8.css'
      },
      zoneE1: {
        media: '(min-width: 521px) and (max-width: 560px)',
        href: gridPath + 'poxy-e-8.css'
      },
      zoneE2: {
        media: '(min-width: 451px) and (max-width: 520px)',
        href: gridPath + 'poxy-e-7.css'
      },
      zoneE3: {
        media: '(min-width: 376px) and (max-width: 450px)',
        href: gridPath + 'poxy-e-6.css'
      },
      zoneE4: {
        media: '(min-width: 308px) and (max-width: 375px)',
        href: gridPath + 'poxy-e-5.css'
      }
    }
  });
  $(function () {
    var $window = $(window), $body = $('body');
    // Disable animations/transitions until the page has loaded.
    $body.addClass('is-loading');
    $window.on('load', function () {
      window.setTimeout(function () {
        $body.removeClass('is-loading');
      }, 250);
    });
  });
  var ngRefresh = function () {
    var scope = angular.element('#container').scope();
    var compile = angular.element('#container').injector().get('$compile');
    compile($('#container').contents())(scope);
    scope.$apply();
  };
  // var pauseVideo = function() {
  // 	if (!document.getElementById("vid")) {
  // 		var vid = document.getElementById("vid");
  // 		vid.pause();
  // 		alert('pause video');
  // 	}
  // }
  //
  // var setVideo = function() {
  // 	if (!document.getElementById("vid")) {
  // 		var vid = document.getElementById("vid");
  // 		// vid.pause();
  // 		// alert('video');
  // 	}
  // }
  pjax.connect({
    'container': 'container',
    'beforeSend': function (e) {
      // document.getElementById('container').className = 'qoxyap80qoxybp80 static shadow-right-inset fade-out';
      $('body').removeClass('loaded');
      $('body').addClass('loading');
      document.getElementById('container').className = 'fade-out';
      document.getElementById('pjax-preloader').className = 'pfxy z10 fill';
      // document.getElementById('pjax-loader').className = 'pjax-loader pjax-loader-animate';
      // document.getElementById('container__preloader').className = 'paxy z10 fill fade-in';
      // setTimeout(function () { document.getElementById('container__preloader').className = 'paxy z10 fill fade-in'; }, 300);
      jQuery('#pjax-preloader').fadeIn();  // pauseVideo();
                                           // alert("beforeSend");
    },
    'complete': function (e) {
      $('body').removeClass('loading');
      $('body').addClass('loaded');
      // document.getElementById('container').className = 'qoxyap80qoxybp80 static shadow-right-inset fade-in';
      document.getElementById('container').className = 'fade-in';
      document.getElementById('pjax-preloader').className = 'pfxy z10 fill hide';
      // document.getElementById('container__preloader').className = 'paxy z10 fill fade-out hide';
      // document.getElementById('pjax-loader').className = 'pjax-loader';
      // jQuery(".video-container").fitVids();
      // jQuery( "#pjax-preloader" ).fadeOut();
      // setTimeout(function () { containerScroller.refresh(); }, 0);
      //- This is a Hack to get the waypoints to refreash with pjax. NEED BETTER WAY. NO TIME
      ngRefresh();  // setTimeout( function () { ngRefresh(); }, 10 );
                    //- alert("Pjax Complete 2!");
    }  //- 'complete': function(e){ console.log("done!"); },
  });
}(jQuery));