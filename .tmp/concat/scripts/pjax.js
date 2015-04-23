/**
 * PJAX- Standalone
 *
 * A standalone implementation of Pushstate AJAX, for non-jQuery web pages.
 * jQuery are recommended to use the original implementation at: http://github.com/defunkt/jquery-pjax
 * 
 * @version 0.6.0
 * @author Carl
 * @source https://github.com/thybag/PJAX-Standalone
 * @license MIT
 */
(function () {
  // Object to store private values/methods.
  var internal = {
      'firstrun': true,
      'is_supported': window.history && window.history.pushState && window.history.replaceState && !navigator.userAgent.match(/((iPod|iPhone|iPad).+\bOS\s+[1-4]|WebApps\/.+CFNetwork)/)
    };
  // If PJAX isn't supported we can skip setting up the library all together
  // So as not to break any code expecting PJAX to be there, return a shell object containing
  // IE7 + compatible versions of connect (which needs to do nothing) and invoke ( which just changes the page)
  if (!internal.is_supported) {
    // PJAX shell, so any code expecting PJAX will work
    var pjax_shell = {
        'connect': function () {
          return;
        },
        'invoke': function () {
          var url = arguments.length === 2 ? arguments[0] : arguments.url;
          document.location = url;
          return;
        }
      };
    // AMD support
    if (typeof define === 'function' && define.amd) {
      define(function () {
        return pjax_shell;
      });
    } else {
      window.pjax = pjax_shell;
    }
    return;
  }
  /**
	 * AddEvent
	 *
	 * @scope private
	 * @param obj Object to listen on
	 * @param event Event to listen for.
	 * @param callback Method to run when event is detected.
	 */
  internal.addEvent = function (obj, event, callback) {
    obj.addEventListener(event, callback, false);
  };
  /**
	 * Clone
	 * Util method to create copies of the options object (so they do not share references)
	 * This allows custom settings on different links.
	 *
	 * @scope private
	 * @param obj
	 * @return obj
	 */
  internal.clone = function (obj) {
    object = {};
    // For every option in object, create it in the duplicate.
    for (var i in obj) {
      object[i] = obj[i];
    }
    return object;
  };
  /**
	 * triggerEvent
	 * Fire an event on a given object (used for callbacks)
	 *
	 * @scope private
	 * @param node. Objects to fire event on
	 * @return event_name. type of event
	 */
  internal.triggerEvent = function (node, event_name, data) {
    // Good browsers
    evt = document.createEvent('HTMLEvents');
    evt.initEvent(event_name, true, true);
    // If additional data was provided, add it to event
    if (typeof data !== 'undefined')
      evt.data = data;
    node.dispatchEvent(evt);
  };
  /**
	 * popstate listener
	 * Listens for back/forward button events and updates page accordingly.
	 */
  internal.addEvent(window, 'popstate', function (st) {
    if (st.state !== null) {
      var opt = {
          'url': st.state.url,
          'container': st.state.container,
          'title': st.state.title,
          'history': false
        };
      // Merge original in original connect options
      if (typeof internal.options !== 'undefined') {
        for (var a in internal.options) {
          if (typeof opt[a] === 'undefined')
            opt[a] = internal.options[a];
        }
      }
      // Convert state data to PJAX options
      var options = internal.parseOptions(opt);
      // If something went wrong, return.
      if (options === false)
        return;
      // If there is a state object, handle it as a page load.
      internal.handle(options);
    }
  });
  /**
	 * attach
	 * Attach PJAX listeners to a link.
	 * @scope private
	 * @param link_node. link that will be clicked.
	 * @param content_node. 
	 */
  internal.attach = function (node, options) {
    // Ignore external links.
    if (node.protocol !== document.location.protocol || node.host !== document.location.host) {
      return;
    }
    // Ignore anchors on the same page
    if (node.pathname === location.pathname && node.hash.length > 0) {
      return true;
    }
    // Add link HREF to object
    options.url = node.href;
    // If PJAX data is specified, use as container
    if (node.getAttribute('data-pjax')) {
      options.container = node.getAttribute('data-pjax');
    }
    // If data-title is specified, use as title.
    if (node.getAttribute('data-title')) {
      options.title = node.getAttribute('data-title');
    }
    // Check options are valid.
    options = internal.parseOptions(options);
    if (options === false)
      return;
    // Attach event.
    internal.addEvent(node, 'click', function (event) {
      // Allow middle click (pages in new windows)
      if (event.which > 1 || event.metaKey || event.ctrlKey)
        return;
      // Don't fire normal event
      if (event.preventDefault) {
        event.preventDefault();
      } else {
        event.returnValue = false;
      }
      // Take no action if we are already on said page?
      if (document.location.href === options.url)
        return false;
      // handle the load.
      internal.handle(options);
    });
  };
  /**
	 * parseLinks
	 * Parse all links within a DOM node, using settings provided in options.
	 * @scope private
	 * @param dom_obj. Dom node to parse for links.
	 * @param options. Valid Options object.
	 */
  internal.parseLinks = function (dom_obj, options) {
    if (typeof options.useClass !== 'undefined') {
      // Get all nodes with the provided class name.
      nodes = dom_obj.getElementsByClassName(options.useClass);
    } else {
      // If no class was provided, just get all the links
      nodes = dom_obj.getElementsByTagName('a');
    }
    // For all returned nodes
    for (var i = 0, tmp_opt; i < nodes.length; i++) {
      node = nodes[i];
      if (typeof options.excludeClass !== 'undefined') {
        if (node.className.indexOf(options.excludeClass) !== -1)
          continue;
      }
      // Override options history to true, else link parsing could be triggered by back button (which runs in no-history mode)
      tmp_opt = internal.clone(options);
      tmp_opt.history = true;
      internal.attach(node, tmp_opt);
    }
    // Fire ready event once all links are connected
    if (internal.firstrun)
      internal.triggerEvent(internal.get_container_node(options.container), 'ready');
  };
  /**
	 * SmartLoad
	 * Smartload checks the returned HTML to ensure PJAX ready content has been provided rather than
	 * a full HTML page. If a full HTML has been returned, it will attempt to scan the page and extract
	 * the correct HTML to update our container with in order to ensure PJAX still functions as expected.
	 *
	 * @scope private
	 * @param HTML (HTML returned from AJAX)
	 * @param options (Options object used to request page)
	 * @return HTML to append to our page.
	 */
  internal.smartLoad = function (html, options) {
    // Create tmp node (So we can interact with it via the DOM)
    var tmp = document.createElement('div');
    // Add HTML
    tmp.innerHTML = html;
    // Grab the title if there is one
    var title = tmp.getElementsByTagName('title')[0].innerHTML;
    if (title)
      document.title = title;
    // Look through all returned divs.
    tmpNodes = tmp.getElementsByTagName('div');
    for (var i = 0; i < tmpNodes.length; i++) {
      if (tmpNodes[i].id === options.container.id) {
        // If our container div is within the returned HTML, we both know the returned content is
        // not PJAX ready, but instead likely the full HTML content. in Addition we can also guess that
        // the content of this node is what we want to update our container with.
        // Thus use this content as the HTML to append in to our page via PJAX.
        return tmpNodes[i].innerHTML;
      }
    }
    // If our container was not found, HTML will be returned as is.
    return html;
  };
  /**
	 * handle
	 * Handle requests to load content via PJAX.
	 * @scope private
	 * @param url. Page to load.
	 * @param node. Dom node to add returned content in to.
	 * @param addtohistory. Does this load require a history event.
	 */
  internal.handle = function (options) {
    // Fire beforeSend Event.
    internal.triggerEvent(options.container, 'beforeSend', options);
    // Do the request
    internal.request(options.url, function (html) {
      // Fail if unable to load HTML via AJAX
      if (html === false) {
        internal.triggerEvent(options.container, 'complete', options);
        internal.triggerEvent(options.container, 'error', options);
        return;
      }
      // Ensure we have the correct HTML to apply to our container.
      if (options.smartLoad)
        html = internal.smartLoad(html, options);
      // If no title was provided
      if (typeof options.title === 'undefined') {
        // Use current doc title (this will be updated via smart load if its enabled)
        options.title = document.title;
        // Attempt to grab title from non-smart loaded page contents 
        if (!options.smartLoad) {
          var tmpTitle = options.container.getElementsByTagName('title');
          if (tmpTitle.length !== 0)
            options.title = tmpTitle[0].innerHTML;
        }
      }
      // Update the DOM with the new content
      options.container.innerHTML = html;
      // Do we need to add this to the history?
      if (options.history) {
        // If this is the first time pjax has run, create a state object for the current page.
        if (internal.firstrun) {
          window.history.replaceState({
            'url': document.location.href,
            'container': options.container.id,
            'title': document.title
          }, document.title);
          internal.firstrun = false;
        }
        // Update browser history
        window.history.pushState({
          'url': options.url,
          'container': options.container.id,
          'title': options.title
        }, options.title, options.url);
      }
      // Initialize any new links found within document (if enabled).
      if (options.parseLinksOnload) {
        internal.parseLinks(options.container, options);
      }
      // Fire Events
      internal.triggerEvent(options.container, 'complete', options);
      internal.triggerEvent(options.container, 'success', options);
      // Don't track if page isn't part of history, or if autoAnalytics is disabled
      if (options.autoAnalytics && options.history) {
        // If autoAnalytics is enabled and a Google analytics tracker is detected push 
        // a trackPageView, so PJAX loaded pages can be tracked successfully.
        if (window._gaq)
          _gaq.push(['_trackPageview']);
        if (window.ga)
          ga('send', 'pageview', {
            'page': options.url,
            'title': options.title
          });
      }
      // Set new title
      document.title = options.title;
      // Scroll page to top on new page load
      if (options.returnToTop) {
        window.scrollTo(0, 0);
      }
    });
  };
  /**
	 * Request
	 * Performs AJAX request to page and returns the result..
	 *
	 * @scope private
	 * @param location. Page to request.
	 * @param callback. Method to call when a page is loaded.
	 */
  internal.request = function (location, callback) {
    // Create xmlHttpRequest object.
    var xmlhttp;
    try {
      xmlhttp = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    } catch (e) {
      console.log('Unable to create XMLHTTP Request');
      return;
    }
    // Add state listener.
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
        // Success, Return HTML
        callback(xmlhttp.responseText);
      } else if (xmlhttp.readyState === 4 && (xmlhttp.status === 404 || xmlhttp.status === 500)) {
        // error (return false)
        callback(false);
      }
    };
    // Secret pjax ?get param so browser doesn't return pjax content from cache when we don't want it to
    // Switch between ? and & so as not to break any URL params (Based on change by zmasek https://github.com/zmasek/)
    xmlhttp.open('GET', location + (!/[?&]/.test(location) ? '?_pjax' : '&_pjax'), true);
    // Add headers so things can tell the request is being performed via AJAX.
    xmlhttp.setRequestHeader('X-PJAX', 'true');
    // PJAX header
    xmlhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    // Standard AJAX header.
    xmlhttp.send(null);
  };
  /**
	 * parseOptions
	 * Validate and correct options object while connecting up any listeners.
	 *
	 * @scope private
	 * @param options
	 * @return false | valid options object
	 */
  internal.parseOptions = function (options) {
    /**  Defaults parse options. (if something isn't provided)
		 *
		 * - history: track event to history (on by default, set to off when performing back operation)
		 * - parseLinksOnload: Enabled by default. Process pages loaded via PJAX and setup PJAX on any links found.
		 * - smartLoad: Tries to ensure the correct HTML is loaded. If you are certain your back end 
		 *		will only return PJAX ready content this can be disabled for a slight performance boost.
		 * - autoAnalytics: Automatically attempt to log events to google analytics (if tracker is available)
		 * - returnToTop: Scroll user back to top of page, when new page is opened by PJAX
		 */
    var defaults = {
        'history': true,
        'parseLinksOnload': true,
        'smartLoad': true,
        'autoAnalytics': true,
        'returnToTop': true
      };
    // Ensure a URL and container have been provided.
    if (typeof options.url === 'undefined' || typeof options.container === 'undefined' || options.container === null) {
      console.log('URL and Container must be provided.');
      return false;
    }
    // Check required options are defined, if not, use default
    for (var o in defaults) {
      if (typeof options[o] === 'undefined')
        options[o] = defaults[o];
    }
    // Ensure history setting is a boolean.
    options.history = options.history === false ? false : true;
    // Get container (if its an id, convert it to a DOM node.)
    options.container = internal.get_container_node(options.container);
    // Events
    var events = [
        'ready',
        'beforeSend',
        'complete',
        'error',
        'success'
      ];
    // If everything went okay thus far, connect up listeners
    for (var e in events) {
      var evt = events[e];
      if (typeof options[evt] === 'function') {
        internal.addEvent(options.container, evt, options[evt]);
      }
    }
    // Return valid options
    return options;
  };
  /**
	 * get_container_node
	 * Returns container node
	 *
	 * @param container - (string) container ID | container DOM node.
	 * @return container DOM node | false
	 */
  internal.get_container_node = function (container) {
    if (typeof container === 'string') {
      container = document.getElementById(container);
      if (container === null) {
        console.log('Could not find container with id:' + container);
        return false;
      }
    }
    return container;
  };
  /**
	 * connect
	 * Attach links to PJAX handlers.
	 * @scope public
	 *
	 * Can be called in 3 ways.
	 * Calling as connect(); 
	 *		Will look for links with the data-pjax attribute.
	 *
	 * Calling as connect(container_id)
	 *		Will try to attach to all links, using the container_id as the target.
	 *
	 * Calling as connect(container_id, class_name)
	 *		Will try to attach any links with the given class name, using container_id as the target.
	 *
	 * Calling as connect({	
	 *						'url':'somepage.php',
	 *						'container':'somecontainer',
	 *						'beforeSend': function(){console.log("sending");}
	 *					})
	 *		Will use the provided JSON to configure the script in full (including callbacks)
	 */
  this.connect = function () {
    // connect();
    var options = {};
    // connect(container, class_to_apply_to)
    if (arguments.length === 2) {
      options.container = arguments[0];
      options.useClass = arguments[1];
    }
    // Either JSON or container id
    if (arguments.length === 1) {
      if (typeof arguments[0] === 'string') {
        //connect(container_id)
        options.container = arguments[0];
      } else {
        //Else connect({url:'', container: ''});
        options = arguments[0];
      }
    }
    // Delete history and title if provided. These options should only be provided via invoke();
    delete options.title;
    delete options.history;
    internal.options = options;
    if (document.readyState === 'complete') {
      internal.parseLinks(document, options);
    } else {
      //Don't run until the window is ready.
      internal.addEvent(window, 'load', function () {
        //Parse links using specified options
        internal.parseLinks(document, options);
      });
    }
  };
  /**
	 * invoke
	 * Directly invoke a pjax page load.
	 * invoke({url: 'file.php', 'container':'content'});
	 *
	 * @scope public
	 * @param options  
	 */
  this.invoke = function () {
    // url, container
    if (arguments.length === 2) {
      options = {};
      options.url = arguments[0];
      options.container = arguments[1];
    } else {
      options = arguments[0];
    }
    // Process options
    options = internal.parseOptions(options);
    // If everything went okay, activate pjax.
    if (options !== false)
      internal.handle(options);
  };
  // Make object usable
  var pjax_obj = this;
  if (typeof define === 'function' && define.amd) {
    // Register pjax as AMD module
    define(function () {
      return pjax_obj;
    });
  } else {
    // Make PJAX object accessible in global name space
    window.pjax = pjax_obj;
  }
}.call({}));
/* skel.js v2.2.1 | (c) n33 | getskel.com | MIT licensed */
/*

	Credits:

		CSS Resets (meyerweb.com/eric/tools/css/reset | Eric Meyer | Public domain)
		DOMReady method (github.com/ded/domready | (c) Dustin Diaz 2014 | MIT license)
		matchMedia() polyfill (github.com/paulirish/matchMedia.js | (c) 2012 Scott Jehl, Paul Irish, Nicholas Zakas, David Knight | Dual MIT/BSD license)
		Normalize (git.io/normalize | Nicolas Gallagher, Jonathan Neal | MIT License)
		UMD Wrapper (github.com/umdjs/umd/blob/master/returnExports.js | @umdjs + @nason)

*/
var skel = function () {
    /**************************************************************************/
    /* skel Object                                                            */
    /**************************************************************************/
    var _ = {
        breakpoints: [],
        breakpointList: [],
        cache: {
          elements: {},
          states: {},
          stateElements: {}
        },
        config: {
          breakpoints: {
            '*': {
              href: false,
              media: ''
            }
          },
          containers: 1140,
          defaultState: null,
          events: {},
          grid: {
            level: 1,
            collapse: false,
            gutters: [
              40,
              0
            ]
          },
          lock: {
            path: false,
            permanent: true
          },
          plugins: {},
          pollOnce: false,
          preload: false,
          reset: 'normalize',
          RTL: false,
          viewport: {
            width: 'device-width',
            height: '',
            scalable: true
          }
        },
        css: {
          bm: '*,*:before,*:after{-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box}',
          n: 'html{font-family:sans-serif;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}body{margin:0}article,aside,details,figcaption,figure,footer,header,hgroup,main,menu,nav,section,summary{display:block}audio,canvas,progress,video{display:inline-block;vertical-align:baseline}audio:not([controls]){display:none;height:0}[hidden],template{display:none}a{background-color:transparent}a:active,a:hover{outline:0}abbr[title]{border-bottom:1px dotted}b,strong{font-weight:700}dfn{font-style:italic}h1{font-size:2em;margin:.67em 0}mark{background:#ff0;color:#000}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sup{top:-.5em}sub{bottom:-.25em}img{border:0}svg:not(:root){overflow:hidden}figure{margin:1em 40px}hr{-moz-box-sizing:content-box;box-sizing:content-box;height:0}pre{overflow:auto}code,kbd,pre,samp{font-family:monospace,monospace;font-size:1em}button,input,optgroup,select,textarea{color:inherit;font:inherit;margin:0}button{overflow:visible}button,select{text-transform:none}button,html input[type=button],input[type=reset],input[type=submit]{-webkit-appearance:button;cursor:pointer}button[disabled],html input[disabled]{cursor:default}button::-moz-focus-inner,input::-moz-focus-inner{border:0;padding:0}input{line-height:normal}input[type=checkbox],input[type=radio]{box-sizing:border-box;padding:0}input[type=number]::-webkit-inner-spin-button,input[type=number]::-webkit-outer-spin-button{height:auto}input[type=search]{-webkit-appearance:textfield;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;box-sizing:content-box}input[type=search]::-webkit-search-cancel-button,input[type=search]::-webkit-search-decoration{-webkit-appearance:none}fieldset{border:1px solid silver;margin:0 2px;padding:.35em .625em .75em}legend{border:0;padding:0}textarea{overflow:auto}optgroup{font-weight:700}table{border-collapse:collapse;border-spacing:0}td,th{padding:0}',
          r: 'html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:\'\';content:none}table{border-collapse:collapse;border-spacing:0}body{-webkit-text-size-adjust:none}',
          gc: function (x) {
            return '.\\31 2u' + x + ',.\\31 2u\\24' + x + '{width:100%;clear:none;margin-left:0}' + '.\\31 1u' + x + ',.\\31 1u\\24' + x + '{width:91.6666666667%;clear:none;margin-left:0}' + '.\\31 0u' + x + ',.\\31 0u\\24' + x + '{width:83.3333333333%;clear:none;margin-left:0}' + '.\\39 u' + x + ',.\\39 u\\24' + x + '{width:75%;clear:none;margin-left:0}' + '.\\38 u' + x + ',.\\38 u\\24' + x + '{width:66.6666666667%;clear:none;margin-left:0}' + '.\\37 u' + x + ',.\\37 u\\24' + x + '{width:58.3333333333%;clear:none;margin-left:0}' + '.\\36 u' + x + ',.\\36 u\\24' + x + '{width:50%;clear:none;margin-left:0}' + '.\\35 u' + x + ',.\\35 u\\24' + x + '{width:41.6666666667%;clear:none;margin-left:0}' + '.\\34 u' + x + ',.\\34 u\\24' + x + '{width:33.3333333333%;clear:none;margin-left:0}' + '.\\33 u' + x + ',.\\33 u\\24' + x + '{width:25%;clear:none;margin-left:0}' + '.\\32 u' + x + ',.\\32 u\\24' + x + '{width:16.6666666667%;clear:none;margin-left:0}' + '.\\31 u' + x + ',.\\31 u\\24' + x + '{width:8.3333333333%;clear:none;margin-left:0}' + '.\\31 2u\\24' + x + '+*,' + '.\\31 1u\\24' + x + '+*,' + '.\\31 0u\\24' + x + '+*,' + '.\\39 u\\24' + x + '+*,' + '.\\38 u\\24' + x + '+*,' + '.\\37 u\\24' + x + '+*,' + '.\\36 u\\24' + x + '+*,' + '.\\35 u\\24' + x + '+*,' + '.\\34 u\\24' + x + '+*,' + '.\\33 u\\24' + x + '+*,' + '.\\32 u\\24' + x + '+*,' + '.\\31 u\\24' + x + '+*{' + 'clear:left;' + '}' + '.\\-11u' + x + '{margin-left:91.6666666667%}' + '.\\-10u' + x + '{margin-left:83.3333333333%}' + '.\\-9u' + x + '{margin-left:75%}' + '.\\-8u' + x + '{margin-left:66.6666666667%}' + '.\\-7u' + x + '{margin-left:58.3333333333%}' + '.\\-6u' + x + '{margin-left:50%}' + '.\\-5u' + x + '{margin-left:41.6666666667%}' + '.\\-4u' + x + '{margin-left:33.3333333333%}' + '.\\-3u' + x + '{margin-left:25%}' + '.\\-2u' + x + '{margin-left:16.6666666667%}' + '.\\-1u' + x + '{margin-left:8.3333333333%}';
          }
        },
        defaults: {
          breakpoint: {
            config: null,
            elements: null,
            test: null
          },
          config_breakpoint: {
            containers: '100%',
            grid: {},
            href: false,
            media: '',
            viewport: {}
          }
        },
        events: [],
        forceDefaultState: false,
        gridLevelMap: {
          k: {},
          v: {}
        },
        gridLevelMax: 1,
        isInit: false,
        isStatic: false,
        locations: {
          body: null,
          head: null,
          html: null
        },
        lcn: '_skel_lock',
        me: null,
        plugins: {},
        sd: '/',
        stateId: '',
        vars: {},
        DOMReady: null,
        getElementsByClassName: null,
        indexOf: null,
        isArray: null,
        iterate: null,
        matchesMedia: null,
        extend: function (x, y) {
          var k;
          _.iterate(y, function (k) {
            if (_.isArray(y[k])) {
              if (!_.isArray(x[k]))
                x[k] = [];
              _.extend(x[k], y[k]);
            } else if (typeof y[k] == 'object') {
              if (typeof x[k] != 'object')
                x[k] = {};
              _.extend(x[k], y[k]);
            } else
              x[k] = y[k];
          });
        },
        getArray: function (x) {
          if (_.isArray(x))
            return x;
          return [x];
        },
        parseMeasurement: function (x) {
          var a, tmp;
          // Not a string? Just assume it's in px.
          if (typeof x !== 'string')
            a = [
              x,
              'px'
            ];  // Fluid shortcut?
          else if (x == 'fluid')
            a = [
              100,
              '%'
            ];  // Okay, hard way it is ...
          else {
            var tmp;
            tmp = x.match(/([0-9\.]+)([^\s]*)/);
            // Missing units? Assume it's in px.
            if (tmp.length < 3 || !tmp[2])
              a = [
                parseFloat(x),
                'px'
              ];  // Otherwise, we have a winrar.
            else
              a = [
                parseFloat(tmp[1]),
                tmp[2]
              ];
          }
          return a;
        },
        canUseProperty_element: null,
        canUse: function (k) {
          return _.breakpoints[k] && _.breakpoints[k].test();
        },
        canUseProperty: function (p) {
          if (!_.canUseProperty_element)
            _.canUseProperty_element = document.createElement('div');
          var e = _.canUseProperty_element.style, up = p.charAt(0).toUpperCase() + p.slice(1);
          return p in e || 'Moz' + up in e || 'Webkit' + up in e || 'O' + up in e || 'ms' + up in e;
        },
        hasActive: function (a) {
          var result = false;
          _.iterate(a, function (i) {
            result = result || _.isActive(a[i]);
          });
          return result;
        },
        isActive: function (k) {
          return _.indexOf(_.stateId, _.sd + k) !== -1;
        },
        isLocked: function () {
          return !!_.vars.lock && _.isArray(_.vars.lock);
        },
        lock: function (w, h) {
          // Set var.
          _.vars.lock = [
            w,
            h
          ];
          // Set cookie.
          document.cookie = _.lcn + '=' + _.vars.lock.join('_') + (_.config.lock.path ? ';path=' + _.config.lock.path : '') + (_.config.lock.permanent ? ';expires=Tue, 19 Jan 2038 03:14:07 GMT' : '');
          console.log('[skel] locking to ' + _.vars.lock);
          // Reload.
          window.location.reload();
        },
        unlock: function () {
          // Clear var.
          _.vars.lock = null;
          // Clear cookie.
          document.cookie = _.lcn + '=' + (_.config.lock.path ? ';path=' + _.config.lock.path : '') + ';expires=Thu, 01 Jan 1970 01:02:03 GMT';
          console.log('[skel] unlocking');
          // Reload.
          window.location.reload();
        },
        useActive: function (x) {
          if (typeof x !== 'object')
            return x;
          var v = null;
          _.iterate(x, function (i) {
            if (v !== null)
              return;
            if (_.isActive(i))
              v = x[i];
          });
          return v;
        },
        wasActive: function (k) {
          return _.indexOf(_.vars.lastStateId, _.sd + k) !== -1;
        },
        applyRowTransforms: function (state) {
          // RTL: Performs a few adjustments to get things working nicely on RTL.
          if (_.config.RTL) {
            // Unreverse all rows.
            _.unreverseRows();
            // (Deprecated) Collapse enabled? Reverse rows.
            if (state.config.grid.collapse)
              _.reverseRows();
          }
          // Shifts cells marked as "important" to the front of their respective rows.
          var key = '_skel_important', cells = [], i, a;
          // Get "important" cells.
          // Via responsive level.
          for (i = 1; i <= _.gridLevelMax; i++) {
            a = _.getElementsByClassName('important(' + _.gridLevelMap.k[i] + ')');
            _.iterate(a, function (k) {
              cells.push(a[k]);
            });
          }
          // (Deprecated) Via collapse.
          a = _.getElementsByClassName('important(collapse)');
          _.iterate(a, function (k) {
            cells.push(a[k]);
          });
          // Step through cells.
          _.iterate(cells, function (i) {
            // Just in case.
            if (i === 'length')
              return;
            var cell = cells[i], parent = cell.parentNode, placeholder, mode = false, k, l;
            // No parent? Bail.
            if (!parent)
              return;
            // Not moved? Move it.
            if (!cell.hasOwnProperty(key) || cell[key] === false) {
              // Determine mode.
              // (Deprecated) Collapse?
              if (state.config.grid.collapse && cell.className.match(/important\(collapse\)/))
                mode = 'c';  // Responsive level?
              else if (cell.className.match(/important\((.+)\)/) && (l = parseInt(_.gridLevelMap.v[RegExp.$1])) <= state.config.grid.level)
                mode = 'l';
              // No valid mode? Bail.
              if (!mode)
                return;
              // Get placeholder node (which will serve as our point of reference for when this cell needs to move back).
              k = _.config.RTL ? 'nextSibling' : 'previousSibling';
              placeholder = cell[k];
              while (placeholder && placeholder.nodeName == '#text')
                placeholder = placeholder[k];
              // Couldn't find anything? Means this cell's already at the front, so bail.
              if (!placeholder)
                return;
              // Move cell to front.
              console.log('[skel] important: moving to front of row (' + i + ')');
              parent.insertBefore(cell, _.config.RTL && mode == 'l' ? parent.lastChild : parent.firstChild);
              // Mark cell as moved.
              cell[key] = {
                placeholder: placeholder,
                mode: mode,
                level: l
              };
            }  // Moved already?
            else {
              placeholder = cell[key].placeholder;
              mode = cell[key].mode;
              // Cell doesn't need to move? Bail.
              if (mode == 'c' && state.config.grid.collapse || mode == 'l' && cell[key].level <= state.config.grid.level)
                return;
              // Move cell back to its original location (using our placeholder).
              console.log('[skel] important: moving back (' + i + ')');
              parent.insertBefore(cell, _.config.RTL && mode == 'l' ? placeholder.previousSibling : placeholder.nextSibling);
              // Unmark cell as moved.
              cell[key] = false;
            }
          });
        },
        reverseRows: function () {
          var x = _.getElementsByClassName('row');
          _.iterate(x, function (i) {
            if (i === 'length')
              return;
            var row = x[i];
            // If the row has already been reversed, bail.
            if (row._skel_isReversed)
              return;
            // Reverse the row.
            var children = row.children, j;
            for (j = 1; j < children.length; j++)
              row.insertBefore(children[j], children[0]);
            // Mark it as reversed.
            row._skel_isReversed = true;
          });
        },
        unreverseRows: function () {
          var x = _.getElementsByClassName('row');
          _.iterate(x, function (i) {
            if (i === 'length')
              return;
            var row = x[i];
            // If the row hasn't been reversed, bail.
            if (!row._skel_isReversed)
              return;
            // Unreverse the row.
            var children = row.children, j;
            for (j = 1; j < children.length; j++)
              row.insertBefore(children[j], children[0]);
            // Mark it as unreversed.
            row._skel_isReversed = false;
          });
        },
        bind: function (name, f) {
          return _.on(name, f);
        },
        on: function (names, f) {
          var a = names.split(/[\s]+/);
          _.iterate(a, function (i) {
            var name = a[i];
            // Manually trigger event if applicable.
            if (_.isInit) {
              // Init.
              if (name == 'init') {
                // Trigger event.
                f();
                // This only gets called once, so there's no need to actually
                // register it.
                return;
              }  // Change.
              else if (name == 'change') {
                // Trigger event.
                f();
              }  // Activate.
              else if (name.charAt(0) == '+' && _.isActive(name.substring(1))) {
                // Trigger event.
                f();
              }  // Not.
              else if (name.charAt(0) == '!' && !_.isActive(name.substring(1))) {
                // Trigger event.
                f();
                // This only gets called once, so there's no need to actually
                // register it.
                return;
              }
            }
            // No previous events of this type registered? Set up its array.
            if (!_.events[name])
              _.events[name] = [];
            // Register event.
            _.events[name].push(f);
          });
        },
        change: function (f) {
          _.on('change', f);
        },
        ready: function (f) {
          _.on('ready', f);
        },
        trigger: function (name) {
          if (!_.events[name] || _.events[name].length == 0)
            return;
          var k;
          _.iterate(_.events[name], function (k) {
            _.events[name][k]();
          });
        },
        registerLocation: function (id, object) {
          if (id == 'head')
            object._skel_attach = function (x, prepend) {
              if (prepend)
                this.insertBefore(x, this.firstChild);
              else {
                // If "me" is in <head>, insert x before "me".
                if (this === _.me.parentNode)
                  this.insertBefore(x, _.me);  // Otherwise, just append it.
                else
                  this.appendChild(x);
              }
            };
          else
            object._skel_attach = function (x, prepend) {
              if (prepend)
                this.insertBefore(x, this.firstChild);
              else
                this.appendChild(x);
            };
          _.locations[id] = object;
        },
        addCachedElementToBreakpoint: function (breakpointId, o) {
          if (_.breakpoints[breakpointId]) {
            console.log('[skel] ' + o.id + ': added to breakpoint (' + breakpointId + ')');
            _.breakpoints[breakpointId].elements.push(o);
          }
        },
        addCachedElementToState: function (stateId, o) {
          console.log('[skel] ' + o.id + ': added to state (' + stateId + ')');
          if (!_.cache.stateElements[stateId])
            _.cache.stateElements[stateId] = [o];
          else
            _.cache.stateElements[stateId].push(o);
        },
        attachElement: function (e) {
          var l, id = e.location, prepend = false;
          // Already attached? Bail.
          if (e.attached)
            return true;
          // Prepend?
          if (id[0] == '^') {
            id = id.substring(1);
            prepend = true;
          }
          // If the location doesn't exist, fail out.
          if (!(id in _.locations))
            return false;
          // Get the element's location.
          l = _.locations[id];
          // Attach object.
          l._skel_attach(e.object, prepend);
          // Mark as attached.
          e.attached = true;
          // Trigger onAttach.
          if (e.onAttach)
            e.onAttach();
          console.log('[skel] ' + e.id + ': attached');
          return true;
        },
        attachElements: function (list) {
          var a = [], w = [], k, l, x;
          // Reorganize elements into priority "buckets".
          _.iterate(list, function (k) {
            if (!a[list[k].priority])
              a[list[k].priority] = [];
            a[list[k].priority].push(list[k]);
          });
          // Step through bucket list (heh).
          _.iterate(a, function (k) {
            // Nothing in this one? Skip it.
            if (a[k].length == 0)
              return;
            // Step through bucket contents.
            _.iterate(a[k], function (x) {
              // Attach the element. If doing so fails, save it in our DOMReady bucket.
              if (!_.attachElement(a[k][x])) {
                console.log('[skel] ' + a[k][x].id + ': postponing attachment');
                w.push(a[k][x]);
              }
            });
          });
          // Walk through our DOMReady bucket.
          if (w.length > 0) {
            _.DOMReady(function () {
              _.iterate(w, function (k) {
                _.attachElement(w[k]);
              });
            });
          }
        },
        cacheElement: function (x) {
          // Add to elements.
          _.cache.elements[x.id] = x;
          return x;
        },
        cacheNewElement: function (id, object, location, priority) {
          var x;
          // Detach object if it's already attached.
          if (object.parentNode)
            object.parentNode.removeChild(object);
          // Create element.
          x = _.newElement(id, object, location, priority);
          return _.cacheElement(x);
        },
        detachAllElements: function (exclude) {
          var k, x, l = {};
          // Build exclusion list (for faster lookups).
          _.iterate(exclude, function (k) {
            l[exclude[k].id] = true;
          });
          _.iterate(_.cache.elements, function (id) {
            // In our exclusion list? Bail.
            if (id in l)
              return;
            // Attempt to detach.
            _.detachElement(id);
          });
        },
        detachElement: function (id) {
          var e = _.cache.elements[id], x;
          // Detached already? Bail.
          if (!e.attached)
            return;
          // Get object.
          x = e.object;
          // No parent? Guess it's already detached so we can bail.
          if (!x.parentNode || x.parentNode && !x.parentNode.tagName)
            return;
          // Detach it.
          console.log('[skel] ' + id + ': detached');
          x.parentNode.removeChild(x);
          // Mark as detached.
          e.attached = false;
          // Trigger onDetach.
          if (e.onDetach)
            e.onDetach();
        },
        getCachedElement: function (id) {
          if (_.cache.elements[id])
            return _.cache.elements[id];
          return null;
        },
        newElement: function (id, object, location, priority) {
          return {
            'id': id,
            'object': object,
            'location': location,
            'priority': priority,
            'attached': false
          };
        },
        removeCachedElementFromBreakpoint: function (breakpointId, id) {
          _.iterate(_.breakpoints[breakpointId].elements, function (k) {
            if (_.breakpoints[breakpointId].elements[k].id == id) {
              delete _.breakpoints[breakpointId].elements[k];
              console.log('[skel] ' + id + ': removed from breakpoint (' + breakpointId + ')');
            }
          });
          return true;
        },
        removeCachedElementFromState: function (stateId, id) {
          _.iterate(_.cache.stateElements[stateId], function (k) {
            if (_.cache.stateElements[stateId][k].id == id) {
              delete _.cache.stateElements[stateId][k];
              console.log('[skel] ' + id + ': removed from state (' + stateId + ')');
            }
          });
          return true;
        },
        uncacheElement: function (id) {
          // Doesn't exist? Bail.
          if (!(id in _.cache.elements))
            return false;
          // Remove from elements.
          delete _.cache.elements[id];
          return true;
        },
        changeState: function (newStateId) {
          var breakpointIds, location, state, a, x, i, id, s1, s2;
          // 1. Set last state var.
          _.vars.lastStateId = _.stateId;
          // 2. Change state ID.
          _.stateId = newStateId;
          console.log('[skel] new state detected (id: "' + _.stateId + '")');
          // 3. Get state.
          if (!_.cache.states[_.stateId]) {
            console.log('[skel] - not cached. building ...');
            // 3.1. Build state.
            _.cache.states[_.stateId] = {
              config: {},
              elements: [],
              values: {}
            };
            state = _.cache.states[_.stateId];
            // 3.2. Build composite configuration.
            if (_.stateId === _.sd)
              breakpointIds = [];
            else
              breakpointIds = _.stateId.substring(1).split(_.sd);
            // Extend config by basic breakpoint config.
            _.extend(state.config, _.defaults.config_breakpoint);
            // Then layer on each active breakpoint's config.
            _.iterate(breakpointIds, function (k) {
              _.extend(state.config, _.breakpoints[breakpointIds[k]].config);
            });
            // 3.3. Add state-dependent elements.
            // ELEMENT: Viewport <meta> tag.
            id = 'mV' + _.stateId;
            // 'content' property set? Use it.
            if (state.config.viewport.content)
              s1 = state.config.viewport.content;  // Lock in effect?
            else if (_.isLocked()) {
              a = [];
              // Scalable.
              a.push('user-scalable=yes');
              // Width.
              if (_.vars.lock[0])
                a.push('width=' + _.vars.lock[0]);
              // Height.
              if (_.vars.lock[1])
                a.push('height=' + _.vars.lock[1]);
              s1 = a.join(',');
              // Force a quick poll in case we didn't catch the locked width and/or height
              // the first time around.
              window.setTimeout(function () {
                _.poll();
              }, 0);
            }  // Otherwise, parse individual options.
            else {
              a = [];
              // Scalable.
              a.push('user-scalable=' + (state.config.viewport.scalable ? 'yes' : 'no'));
              // Width.
              if (state.config.viewport.width)
                a.push('width=' + state.config.viewport.width);
              // Height.
              if (state.config.viewport.height)
                a.push('height=' + state.config.viewport.height);
              // Set initial scale if we're using device-width.
              if (state.config.viewport.width == 'device-width')
                a.push('initial-scale=1');
              s1 = a.join(',');
            }
            // Get element
            if (!(x = _.getCachedElement(id)))
              x = _.cacheNewElement(id, _.newMeta('viewport', s1), '^head', 4);
            // Push to state
            console.log('[skel] -- ' + id);
            state.elements.push(x);
            // ELEMENT: (CSS) Containers.
            var C, Cu, CLocked = false;
            // Determine width, units, and id.
            // Split "containers" into width and units.
            a = _.parseMeasurement(state.config.containers);
            C = a[0];
            Cu = a[1];
            // Set "containers" state value (needed for later).
            state.values.containers = C + Cu;
            // Set id.
            id = 'iC' + state.values.containers;
            // Locked?
            if (Cu.substr(-1) == '!') {
              CLocked = true;
              Cu = Cu.substr(0, Cu.length - 1);
            }
            // Get element.
            if (!(x = _.getCachedElement(id))) {
              // Build element.
              x = _.cacheNewElement(id, _.newInline('.container{margin-left:auto;margin-right:auto;width:' + C * 1 + Cu + (CLocked ? '!important;' + 'max-width:none!important;' + 'min-width:0!important' + '}' : '}' + '.container.\\31 25\\25{width:100%;max-width:' + C * 1.25 + Cu + ';min-width:' + C + Cu + '}' + '.container.\\37 5\\25{width:' + C * 0.75 + Cu + '}' + '.container.\\35 0\\25{width:' + C * 0.5 + Cu + '}' + '.container.\\32 5\\25{width:' + C * 0.25 + Cu + '}')), 'head', 3);
            }
            // Push to state.
            console.log('[skel] -- ' + id);
            state.elements.push(x);
            // ELEMENT: (CSS) Grid / Rows / Gutters.
            id = 'iGG' + state.config.grid.gutters[0] + '_' + state.config.grid.gutters[1];
            // Get element.
            if (!(x = _.getCachedElement(id))) {
              // Vertical.
              var V, Vu;
              // Split into size and units.
              a = _.parseMeasurement(state.config.grid.gutters[0]);
              V = a[0];
              Vu = a[1];
              // Horizontal.
              var H, Hu;
              // Split into size and units.
              a = _.parseMeasurement(state.config.grid.gutters[1]);
              H = a[0];
              Hu = a[1];
              // Build element.
              x = _.cacheNewElement('iGG' + state.config.grid.gutters[0] + '_' + state.config.grid.gutters[1], _.newInline('.row>*{padding:' + H * 1 + Hu + ' 0 0 ' + V * 1 + Vu + '}' + '.row{margin:' + H * -1 + Hu + ' 0 -1px ' + V * -1 + Vu + '}' + '.row.uniform>*{padding:' + V * 1 + Vu + ' 0 0 ' + V * 1 + Vu + '}' + '.row.uniform{margin:' + V * -1 + Vu + ' 0 -1px ' + V * -1 + Vu + '}' + '.row.\\32 00\\25>*{padding:' + H * 2 + Hu + ' 0 0 ' + V * 2 + Vu + '}' + '.row.\\32 00\\25{margin:' + H * -2 + Hu + ' 0 -1px ' + V * -2 + Vu + '}' + '.row.uniform.\\32 00\\25>*{padding:' + V * 2 + Vu + ' 0 0 ' + V * 2 + Vu + '}' + '.row.uniform.\\32 00\\25{margin:' + V * -2 + Vu + ' 0 -1px ' + V * -2 + Vu + '}' + '.row.\\31 50\\25>*{padding:' + H * 1.5 + Hu + ' 0 0 ' + V * 1.5 + Vu + '}' + '.row.\\31 50\\25{margin:' + H * -1.5 + Hu + ' 0 -1px ' + V * -1.5 + Vu + '}' + '.row.uniform.\\31 50\\25>*{padding:' + V * 1.5 + Vu + ' 0 0 ' + V * 1.5 + Vu + '}' + '.row.uniform.\\31 50\\25{margin:' + V * -1.5 + Vu + ' 0 -1px ' + V * -1.5 + Vu + '}' + '.row.\\35 0\\25>*{padding:' + H * 0.5 + Hu + ' 0 0 ' + V * 0.5 + Vu + '}' + '.row.\\35 0\\25{margin:' + H * -0.5 + Hu + ' 0 -1px ' + V * -0.5 + Vu + '}' + '.row.uniform.\\35 0\\25>*{padding:' + V * 0.5 + Vu + ' 0 0 ' + V * 0.5 + Vu + '}' + '.row.uniform.\\35 0\\25{margin:' + V * -0.5 + Vu + ' 0 -1px ' + V * -0.5 + Vu + '}' + '.row.\\32 5\\25>*{padding:' + H * 0.25 + Hu + ' 0 0 ' + V * 0.25 + Vu + '}' + '.row.\\32 5\\25{margin:' + H * -0.25 + Hu + ' 0 -1px ' + V * -0.25 + Vu + '}' + '.row.uniform.\\32 5\\25>*{padding:' + V * 0.25 + Vu + ' 0 0 ' + V * 0.25 + Vu + '}' + '.row.uniform.\\32 5\\25{margin:' + V * -0.25 + Vu + ' 0 -1px ' + V * -0.25 + Vu + '}' + '.row.\\30 \\25>*{padding:0}' + '.row.\\30 \\25{margin:0 0 -1px 0}'), 'head', 3);
            }
            // Push to state.
            console.log('[skel] -- ' + id);
            state.elements.push(x);
            // ELEMENT: (CSS) Grid / Responsive Level.
            if (state.config.grid.level > 1) {
              id = 'igZ' + state.config.grid.level;
              if (!(x = _.getCachedElement(id))) {
                // Generate CSS.
                s1 = '';
                for (i = 2; i <= state.config.grid.level; i++)
                  s1 += _.css.gc('\\28 ' + _.gridLevelMap.k[i] + '\\29');
                // Build Element.
                x = _.cacheNewElement(id, _.newInline(s1), 'head', 3);
              }
              // Push to state.
              console.log('[skel] -- ' + id);
              state.elements.push(x);
            }
            // (Deprecated) ELEMENT: (CSS) Grid / Collapse.
            if (state.config.grid.collapse) {
              id = 'igC' + state.config.containers;
              if (!(x = _.getCachedElement(id))) {
                // Build Element.
                x = _.cacheNewElement(id, _.newInline('.row:not(.no-collapse)>*{' + 'width:100%!important;' + 'margin-left:0!important' + '}'), 'head', 3);
              }
              // Push to state.
              console.log('[skel] -- ' + id);
              state.elements.push(x);
            }
            // ELEMENT: Conditionals.
            if (!_.isStatic) {
              id = 'iCd' + _.stateId;
              if (!(x = _.getCachedElement(id))) {
                s1 = [];
                s2 = [];
                // Get element.
                _.iterate(_.breakpoints, function (k) {
                  if (_.indexOf(breakpointIds, k) !== -1)
                    s1.push('.not-' + k);
                  else
                    s2.push('.only-' + k);
                });
                var s = (s1.length > 0 ? s1.join(',') + '{display:none!important}' : '') + (s2.length > 0 ? s2.join(',') + '{display:none!important}' : '');
                x = _.cacheNewElement(id, _.newInline(s.replace(/\.([0-9])/, '.\\3$1 ')), 'head', 3);
                // Push to state.
                console.log('[skel] -- ' + id);
                state.elements.push(x);
              }
            }
            // ELEMENT: Breakpoint-specific.
            _.iterate(breakpointIds, function (k) {
              // styleSheet*
              if (_.breakpoints[breakpointIds[k]].config.href) {
                id = 'ss' + breakpointIds[k];
                // Get element.
                if (!(x = _.getCachedElement(id)))
                  x = _.cacheNewElement(id, _.newStyleSheet(_.breakpoints[breakpointIds[k]].config.href), 'head', 5);
                // Push to state.
                console.log('[skel] -- ' + id);
                state.elements.push(x);
              }
              // Elements.
              if (_.breakpoints[breakpointIds[k]].elements.length > 0) {
                // Push elements to state.
                _.iterate(_.breakpoints[breakpointIds[k]].elements, function (x) {
                  console.log('[skel] -- ' + _.breakpoints[breakpointIds[k]].elements[x].id + ': added (via breakpoint)');
                  state.elements.push(_.breakpoints[breakpointIds[k]].elements[x]);
                });
              }
            });
            // 3.4. Add pending state elements.
            if (_.cache.stateElements[_.stateId]) {
              // Add elements to state cache.
              _.iterate(_.cache.stateElements[_.stateId], function (i) {
                state.elements.push(_.cache.stateElements[_.stateId][i]);
              });
              // Empty bucket.
              _.cache.stateElements[_.stateId] = [];
            }
          } else {
            state = _.cache.states[_.stateId];
            console.log('[skel] - found cached');
          }
          // 4. Detach all elements (excluding the ones we're about to attach).
          console.log('[skel] - detaching all elements ...');
          _.detachAllElements(state.elements);
          // 5. Apply state.
          console.log('[skel] - attaching state elements ... ');
          _.attachElements(state.elements);
          // 6. Apply row transforms.
          _.DOMReady(function () {
            _.applyRowTransforms(state);
          });
          // 7. Set state and stateId vars.
          _.vars.state = _.cache.states[_.stateId];
          _.vars.stateId = _.stateId;
          // 8. Trigger change event.
          _.trigger('change');
          // 9. Trigger activate/deactivate events.
          _.iterate(_.breakpoints, function (k) {
            // Breakpoint is now active ...
            if (_.isActive(k)) {
              // ... and it wasn't active before? Trigger activate event.
              if (!_.wasActive(k))
                _.trigger('+' + k);
            }  // Breakpoint is not active ...
            else {
              // ... but it was active before? Trigger deactivate event.
              if (_.wasActive(k))
                _.trigger('-' + k);
            }
          });
        },
        getStateId: function () {
          if (_.forceDefaultState && _.config.defaultState)
            return _.config.defaultState;
          var stateId = '';
          _.iterate(_.breakpoints, function (k) {
            if (_.breakpoints[k].test())
              stateId += _.sd + k;
          });
          return stateId;
        },
        poll: function () {
          var newStateId = '';
          // Determine new state.
          newStateId = _.getStateId();
          if (newStateId === '')
            newStateId = _.sd;
          // State changed?
          if (newStateId !== _.stateId) {
            // Static mode? Just change state.
            if (_.isStatic)
              _.changeState(newStateId);  // Otherwise, change state and apply <html> classes.
            else {
              // Remove previous breakpoint classes from <html>
              _.locations.html.className = _.locations.html.className.replace(_.stateId.substring(1).replace(new RegExp(_.sd, 'g'), ' '), '');
              // Change state.
              _.changeState(newStateId);
              // Apply new breakpoint classes to <html>
              _.locations.html.className = _.locations.html.className + ' ' + _.stateId.substring(1).replace(new RegExp(_.sd, 'g'), ' ');
              // Clean up className.
              if (_.locations.html.className.charAt(0) == ' ')
                _.locations.html.className = _.locations.html.className.substring(1);
            }
          }
        },
        updateState: function () {
          var a, b, k, j, list = [];
          if (_.stateId == _.sd)
            return;
          // Breakpoint elements.
          // Get active breakpoint IDs.
          a = _.stateId.substring(1).split(_.sd);
          // Step through active state's breakpoints.
          _.iterate(a, function (k) {
            b = _.breakpoints[a[k]];
            // No elements? Skip it.
            if (b.elements.length == 0)
              return;
            // Add the breakpoint's elements to the state's cache.
            _.iterate(b.elements, function (j) {
              //console.log('- added new breakpoint element ' + b.elements[j].id + ' to state ' + _.stateId);
              _.cache.states[_.stateId].elements.push(b.elements[j]);
              list.push(b.elements[j]);
            });
          });
          // Pending state elements.
          if (_.cache.stateElements[_.stateId]) {
            // Add the pending elements to the state's cache.
            _.iterate(_.cache.stateElements[_.stateId], function (i) {
              _.cache.states[_.stateId].elements.push(_.cache.stateElements[_.stateId][i]);
              list.push(_.cache.stateElements[_.stateId][i]);
            });
            // Empty pending bucket.
            _.cache.stateElements[_.stateId] = [];
          }
          // If new elements were detected, go ahead and attach them.
          if (list.length > 0) {
            console.log('[skel] updating state ... ');
            _.attachElements(list);
          }
        },
        newDiv: function (s) {
          var o = document.createElement('div');
          o.innerHTML = s;
          return o;
        },
        newInline: function (s) {
          var o;
          o = document.createElement('style');
          o.type = 'text/css';
          o.innerHTML = s;
          return o;
        },
        newMeta: function (name, content) {
          var o = document.createElement('meta');
          o.name = name;
          o.content = content;
          return o;
        },
        newStyleSheet: function (href) {
          var o = document.createElement('link');
          o.rel = 'stylesheet';
          o.type = 'text/css';
          o.href = href;
          return o;
        },
        initPlugin: function (plugin, config) {
          // Extend defaults with user config (if it exists).
          if (typeof config == 'object')
            _.extend(plugin.config, config);
          // Call init.
          if (plugin.init)
            plugin.init();
        },
        registerPlugin: function (id, plugin) {
          if (!plugin) {
            console.log('[skel] FAILED to register plugin ' + id);
            return false;
          }
          // Register this plugin.
          _.plugins[id] = plugin;
          // Attach skel object to plugin.
          plugin._ = this;
          // Log it.
          console.log('[skel] registered plugin ' + id);
          // Call register.
          if (plugin.register)
            plugin.register();
        },
        init: function (config, pluginConfig) {
          console.log('[skel] starting init ...');
          // Initialize config.
          _.initConfig(config);
          // Initialize elements.
          _.initElements();
          // Initialize events.
          _.initEvents();
          // Do initial poll.
          _.poll();
          // Initializes plugins.
          // (Deprecated) If pluginConfig is provided as a second param to init() and it's
          // an object, copy it to config.plugins (where plugin configs are supposed to go).
          if (pluginConfig && typeof pluginConfig == 'object')
            _.config.plugins = pluginConfig;
          _.iterate(_.plugins, function (id) {
            _.initPlugin(_.plugins[id], id in _.config.plugins ? _.config.plugins[id] : null);
          });
          // Mark as initialized.
          _.isInit = true;
          // Trigger init event.
          _.trigger('init');
        },
        initAPI: function () {
          var x, a, ua = navigator.userAgent;
          // Vars.
          // IE version (set to 99 for non-IE).
          _.vars.IEVersion = 99;
          // Browser.
          x = 'other';
          if (ua.match(/Firefox/))
            x = 'firefox';
          else if (ua.match(/Chrome/))
            x = 'chrome';
          else if (ua.match(/Safari/) && !ua.match(/Chrome/))
            x = 'safari';
          else if (ua.match(/(OPR|Opera)/))
            x = 'opera';
          else if (ua.match(/MSIE ([0-9]+)/)) {
            x = 'ie';
            _.vars.IEVersion = RegExp.$1;
          } else if (ua.match(/Trident\/.+rv:([0-9]+)/)) {
            x = 'ie';
            _.vars.IEVersion = RegExp.$1;
          }
          _.vars.browser = x;
          // Device type.
          _.vars.deviceType = 'other';
          a = {
            ios: '(iPad|iPhone|iPod)',
            android: 'Android',
            mac: 'Macintosh',
            wp: 'Windows Phone',
            windows: 'Windows NT'
          };
          _.iterate(a, function (k) {
            if (ua.match(new RegExp(a[k], 'g')))
              _.vars.deviceType = k;
          });
          // Device version.
          switch (_.vars.deviceType) {
          case 'ios':
            ua.match(/([0-9_]+) like Mac OS X/);
            x = parseFloat(RegExp.$1.replace('_', '.').replace('_', ''));
            break;
          case 'android':
            ua.match(/Android ([0-9\.]+)/);
            x = parseFloat(RegExp.$1);
            break;
          case 'mac':
            ua.match(/Mac OS X ([0-9_]+)/);
            x = parseFloat(RegExp.$1.replace('_', '.').replace('_', ''));
            break;
          case 'wp':
            ua.match(/IEMobile\/([0-9\.]+)/);
            x = parseFloat(RegExp.$1);
            break;
          case 'windows':
            ua.match(/Windows NT ([0-9\.]+)/);
            x = parseFloat(RegExp.$1);
            break;
          default:
            x = 99;
            break;
          }
          _.vars.deviceVersion = x;
          // isTouch.
          _.vars.isTouch = _.vars.deviceType == 'wp' ? navigator.msMaxTouchPoints > 0 : !!('ontouchstart' in window);
          // isMobile.
          _.vars.isMobile = _.vars.deviceType == 'wp' || _.vars.deviceType == 'android' || _.vars.deviceType == 'ios';
          // Lock.
          x = document.cookie.split(';');
          _.iterate(x, function (i) {
            var y = x[i].split('=');
            if (y[0].replace(/^\s+|\s+$/g, '') == _.lcn && y[1].length > 0) {
              _.vars.lock = y[1].split('_');
              return;
            }
          });
        },
        initConfig: function (config) {
          var fArgs = [], preloads = [], i;
          // If no config is provided, or if one is provided without any breakpoints defined,
          // switch to static mode.
          if (!config || !('breakpoints' in config)) {
            _.isStatic = true;
            // Override viewport defaults. Prevents "width=device-width" and "height=device-height"
            // from being applied to the viewport (neither of which are needed in static mode).
            _.config.viewport.width = '';
            _.config.viewport.height = '';
            _.config.viewport.scalable = true;
          }
          // Set up config.
          // Check for a valid user config.
          if (typeof config == 'object') {
            // Clear default breakpoints.
            if (config.breakpoints)
              _.config.breakpoints = {};
            // Extend defaults with user config.
            _.extend(_.config, config);
          }
          // Grid config.
          // Gutters.
          if ('grid' in _.config && 'gutters' in _.config.grid && !_.isArray(_.config.grid.gutters))
            _.config.grid.gutters = [
              _.config.grid.gutters,
              _.config.grid.gutters
            ];
          // Extend base breakpoint config.
          _.extend(_.defaults.config_breakpoint.grid, _.config.grid);
          // Update maximum grid responsive level.
          _.gridLevelMax = Math.max(_.gridLevelMax, _.config.grid.level);
          // Viewport config.
          // Extend base breakpoint config.
          _.extend(_.defaults.config_breakpoint.viewport, _.config.viewport);
          // Set base breakpoint config's containers to config's containers.
          _.defaults.config_breakpoint.containers = _.config.containers;
          // Process breakpoints config.
          _.iterate(_.config.breakpoints, function (id) {
            var b, c = {}, s, m;
            // Apply defaults to non-inheritable options.
            _.extend(c, _.config.breakpoints[id]);
            // href.
            if (!('href' in c))
              c.href = _.defaults.config_breakpoint.href;
            // media.
            if (!('media' in c))
              c.media = _.defaults.config_breakpoint.media;
            // (Deprecated) range.
            if ('range' in c) {
              s = c.range;
              // Wildcard? Always succeed.
              if (s == '*')
                m = '';  // Less than or equal (-X)
              else if (s.charAt(0) == '-')
                m = '(max-width: ' + parseInt(s.substring(1)) + 'px)';  // Greater than or equal (X-)
              else if (s.charAt(s.length - 1) == '-')
                m = '(min-width: ' + parseInt(s.substring(0, s.length - 1)) + 'px)';  // Range (X-Y)
              else if (_.indexOf(s, '-') != -1) {
                s = s.split('-');
                m = '(min-width: ' + parseInt(s[0]) + 'px) and (max-width: ' + parseInt(s[1]) + 'px)';
              }
              c.media = m;
            }
            // grid.
            if ('grid' in c) {
              // Gutters.
              if ('gutters' in c.grid && !_.isArray(c.grid.gutters))
                c.grid.gutters = [
                  c.grid.gutters,
                  c.grid.gutters
                ];
              // (Deprecated) Zoom level.
              if ('zoom' in c.grid)
                c.grid.level = c.grid.zoom;
              // Update maximum grid responsive level.
              if ('level' in c.grid)
                _.gridLevelMax = Math.max(_.gridLevelMax, c.grid.level);
            }
            _.config.breakpoints[id] = c;
            // Build breakpoint.
            b = {};
            _.extend(b, _.defaults.breakpoint);
            b.config = _.config.breakpoints[id];
            b.test = function () {
              return _.matchesMedia(c.media);
            };
            b.elements = [];
            // Preload stylesheet.
            if (_.config.preload && b.config.href)
              preloads.push(b.config.href);
            // Replace original.
            _.breakpoints[id] = b;
            // Add to list.
            _.breakpointList.push(id);
          });
          // If a grid responsive level greater than 1 has been explicitly defined or we're in static mode,
          // update map accordingly.
          if (_.gridLevelMax > 1 || _.isStatic) {
            for (i = 2; i <= _.gridLevelMax; i++)
              _.gridLevelMap.k[i] = _.gridLevelMap.v[i] = i;
          }  // Otherwise, automatically assign responsive levels to each breakpoint.
          else {
            _.iterate(_.config.breakpoints, function (id) {
              var c = _.config.breakpoints[id];
              _.gridLevelMax++;
              if (!('grid' in c))
                c.grid = {};
              // Set responsive level.
              c.grid.level = _.gridLevelMax;
              // Update map (breakpoint ID => responsive level)
              _.gridLevelMap.k[_.gridLevelMax] = id;
              _.gridLevelMap.v[id] = _.gridLevelMax;
            });
          }
          // Process events config.
          _.iterate(_.config.events, function (k) {
            _.on(k, _.config.events[k]);
          });
          // Handle stylesheet preloads if we have them (and we're not working locally).
          if (preloads.length > 0 && window.location.protocol != 'file:') {
            _.DOMReady(function () {
              var k, h = document.getElementsByTagName('head')[0], x = new XMLHttpRequest();
              _.iterate(preloads, function (k) {
                console.log('[skel] ' + preloads[k] + ': preloaded');
                x.open('GET', preloads[k], false);
                x.send('');
              });
            });
          }
        },
        initElements: function () {
          var a = [];
          // ELEMENT: Initial viewport META tag.
          a.push(_.newElement('mV', _.newMeta('viewport', 'initial-scale=1'), '^head', 1));
          // ELEMENT: Full reset -or- Normalize.
          switch (_.config.reset) {
          case 'full':
            a.push(_.newElement('iR', _.newInline(_.css.r), '^head', 2));
            break;
          case 'normalize':
            a.push(_.newElement('iN', _.newInline(_.css.n), '^head', 2));
            break;
          }
          // ELEMENT: Box Model.
          a.push(_.newElement('iBM', _.newInline(_.css.bm), '^head', 1));
          // ELEMENT: (CSS) Grid.
          a.push(_.newElement('iG', _.newInline('.row{border-bottom:solid 1px transparent}' + '.row>*{float:left}' + '.row:after,.row:before{content:"";display:block;clear:both;height:0}' + '.row.uniform>*>:first-child{margin-top:0}' + '.row.uniform>*>:last-child{margin-bottom:0}' + _.css.gc('')), 'head', 3));
          _.attachElements(a);
        },
        initEvents: function () {
          var o;
          // pollOnce disabled *and* we're not in static mode? Set up polling events.
          if (!_.config.pollOnce && !_.isStatic) {
            // On resize.
            _.on('resize', function () {
              _.poll();
            });
            // On orientation change.
            _.on('orientationChange', function () {
              _.poll();
            });
          }
          // Hack: Fix stupid iOS orientation/input placeholder bug.
          if (_.vars.deviceType == 'ios') {
            _.DOMReady(function () {
              _.on('orientationChange', function () {
                // Get all inputs.
                var inputs = document.getElementsByTagName('input');
                // Temporarily clear placeholders.
                _.iterate(inputs, function (i) {
                  inputs[i]._skel_placeholder = inputs[i].placeholder;
                  inputs[i].placeholder = '';
                });
                // Then, after a short delay, put them back.
                window.setTimeout(function () {
                  _.iterate(inputs, function (i) {
                    inputs[i].placeholder = inputs[i]._skel_placeholder;
                  });
                }, 100);
              });
            });
          }
          // Wrap "ready" event.
          _.DOMReady(function () {
            _.trigger('ready');
          });
          // Non-destructively register skel events to window.
          if (window.onresize)
            _.on('resize', window.onresize);
          window.onresize = function () {
            _.trigger('resize');
          };
          if (window.onorientationchange)
            _.on('orientationChange', window.onorientationchange);
          window.onorientationchange = function () {
            _.trigger('orientationChange');
          };
        },
        initUtilityMethods: function () {
          // _.DOMReady (based on github.com/ded/domready by @ded; domready (c) Dustin Diaz 2014 - License MIT)
          // Hack: Use older version for browsers that don't support addEventListener (*cough* IE8).
          if (!document.addEventListener)
            !function (e, t) {
              _.DOMReady = t();
            }('domready', function (e) {
              function p(e) {
                h = 1;
                while (e = t.shift())
                  e();
              }
              var t = [], n, r = !1, i = document, s = i.documentElement, o = s.doScroll, u = 'DOMContentLoaded', a = 'addEventListener', f = 'onreadystatechange', l = 'readyState', c = o ? /^loaded|^c/ : /^loaded|c/, h = c.test(i[l]);
              return i[a] && i[a](u, n = function () {
                i.removeEventListener(u, n, r), p();
              }, r), o && i.attachEvent(f, n = function () {
                /^c/.test(i[l]) && (i.detachEvent(f, n), p());
              }), e = o ? function (n) {
                self != top ? h ? n() : t.push(n) : function () {
                  try {
                    s.doScroll('left');
                  } catch (t) {
                    return setTimeout(function () {
                      e(n);
                    }, 50);
                  }
                  n();
                }();
              } : function (e) {
                h ? e() : t.push(e);
              };
            });  // And everyone else.
          else
            !function (e, t) {
              _.DOMReady = t();
            }('domready', function () {
              function s(t) {
                i = 1;
                while (t = e.shift())
                  t();
              }
              var e = [], t, n = document, r = 'DOMContentLoaded', i = /^loaded|^c/.test(n.readyState);
              return n.addEventListener(r, t = function () {
                n.removeEventListener(r, t), s();
              }), function (t) {
                i ? t() : e.push(t);
              };
            });
          // _.getElementsByClassName
          // Wrap existing method if it exists.
          if (document.getElementsByClassName)
            _.getElementsByClassName = function (className) {
              return document.getElementsByClassName(className);
            }  // Otherwise, polyfill.
;
          else
            _.getElementsByClassName = function (className) {
              var d = document;
              if (d.querySelectorAll)
                return d.querySelectorAll(('.' + className.replace(' ', ' .')).replace(/\.([0-9])/, '.\\3$1 '));
              else
                return [];
            };
          // _.indexOf
          // Wrap existing method if it exists.
          if (Array.prototype.indexOf)
            _.indexOf = function (x, b) {
              return x.indexOf(b);
            };  // Otherwise, polyfill.
          else
            _.indexOf = function (x, b) {
              if (typeof x == 'string')
                return x.indexOf(b);
              var c, a = b ? b : 0, e;
              if (!this) {
                throw new TypeError();
              }
              e = this.length;
              if (e === 0 || a >= e) {
                return -1;
              }
              if (a < 0) {
                a = e - Math.abs(a);
              }
              for (c = a; c < e; c++) {
                if (this[c] === x) {
                  return c;
                }
              }
              return -1;
            };
          // _.isArray
          // Wrap existing method if it exists.
          if (Array.isArray)
            _.isArray = function (x) {
              return Array.isArray(x);
            };  // Otherwise, polyfill.
          else
            _.isArray = function (x) {
              return Object.prototype.toString.call(x) === '[object Array]';
            };
          // _.iterate
          // Use Object.keys if it exists (= better performance).
          if (Object.keys)
            _.iterate = function (a, f) {
              if (!a)
                return [];
              var i, k = Object.keys(a);
              for (i = 0; k[i]; i++)
                f(k[i]);
            };  // Otherwise, fall back on hasOwnProperty (= slower, but works on older browsers).
          else
            _.iterate = function (a, f) {
              if (!a)
                return [];
              var i;
              for (i in a)
                if (Object.prototype.hasOwnProperty.call(a, i))
                  f(i);
            };
          // _.matchesMedia
          // Default: Use matchMedia (all modern browsers)
          if (window.matchMedia)
            _.matchesMedia = function (query) {
              if (query == '')
                return true;
              return window.matchMedia(query).matches;
            };  // Polyfill 1: Use styleMedia/media (IE9, older Webkit) (derived from github.com/paulirish/matchMedia.js)
          else if (window.styleMedia || window.media)
            _.matchesMedia = function (query) {
              if (query == '')
                return true;
              var styleMedia = window.styleMedia || window.media;
              return styleMedia.matchMedium(query || 'all');
            };  // Polyfill 2: Use getComputed Style (???) (derived from github.com/paulirish/matchMedia.js)
          else if (window.getComputedStyle)
            _.matchesMedia = function (query) {
              if (query == '')
                return true;
              var style = document.createElement('style'), script = document.getElementsByTagName('script')[0], info = null;
              style.type = 'text/css';
              style.id = 'matchmediajs-test';
              script.parentNode.insertBefore(style, script);
              info = 'getComputedStyle' in window && window.getComputedStyle(style, null) || style.currentStyle;
              var text = '@media ' + query + '{ #matchmediajs-test { width: 1px; } }';
              if (style.styleSheet)
                style.styleSheet.cssText = text;
              else
                style.textContent = text;
              return info.width === '1px';
            };  // Polyfill 3: Manually parse (IE<9)
          else {
            // Force default state (if one is specified).
            _.forceDefaultState = true;
            _.matchesMedia = function (query) {
              // Empty query? Always succeed.
              if (query == '')
                return true;
              // Parse query.
              var s, a, b, k, values = {
                  'min-width': null,
                  'max-width': null
                }, found = false;
              a = query.split(/\s+and\s+/);
              for (k in a) {
                s = a[k];
                // Operator (key: value)
                if (s.charAt(0) == '(') {
                  s = s.substring(1, s.length - 1);
                  b = s.split(/:\s+/);
                  if (b.length == 2) {
                    values[b[0].replace(/^\s+|\s+$/g, '')] = parseInt(b[1]);
                    found = true;
                  }
                }
              }
              // No matches? Query likely contained something unsupported so we automatically fail.
              if (!found)
                return false;
              // Check against viewport.
              var w = document.documentElement.clientWidth, h = document.documentElement.clientHeight;
              if (values['min-width'] !== null && w < values['min-width'] || values['max-width'] !== null && w > values['max-width'] || values['min-height'] !== null && h < values['min-height'] || values['max-height'] !== null && h > values['max-height'])
                return false;
              return true;
            };
          }
        },
        preInit: function () {
          // Only needed when testing the unminified source on IE<9.
          //if (!window.console)
          //	window.console = { log: function() { } };
          console.log('[skel] preinitializing.');
          // Initialize 'me'.
          var x = document.getElementsByTagName('script');
          _.me = x[x.length - 1];
          // Initialize API.
          _.initUtilityMethods();
          _.initAPI();
          // Register locations.
          _.registerLocation('html', document.getElementsByTagName('html')[0]);
          _.registerLocation('head', document.getElementsByTagName('head')[0]);
          _.DOMReady(function () {
            _.registerLocation('body', document.getElementsByTagName('body')[0]);
          });
          // Hack: IE viewport fix.
          if (_.vars.browser == 'ie' && _.vars.IEVersion >= 10)
            _.attachElement(_.newElement('msie-viewport-fix', _.newInline('@-ms-viewport{width:device-width}'), '^head', 1));
        }
      };
    // Preinitialize.
    _.preInit();
    // Apply IE<9 fixes.
    if (_.vars.IEVersion < 9) {
      // applyRowTransforms.
      // Row transforms don't work (RTL stuff), so we eliminate them entirely.
      _.applyRowTransforms = function (state) {
      };
      // newInline.
      // Can't create <style> elements on the fly, but this <span> workaround does the trick.
      _.newInline = function (s) {
        var o;
        o = document.createElement('span');
        o.innerHTML = '&nbsp;<style type="text/css">' + s + '</style>';
        return o;
      };
    }
    // Expose object.
    return _;
  }();
// UMD Wrapper (github.com/umdjs/umd/blob/master/returnExports.js | @umdjs + @nason)
(function (root, factory) {
  // AMD.
  if (typeof define === 'function' && define.amd)
    define([], factory);  // Node.
  else if (typeof exports === 'object')
    module.exports = factory();  // Browser global.
  else
    root.skel = factory();
}(this, function () {
  return skel;
}));