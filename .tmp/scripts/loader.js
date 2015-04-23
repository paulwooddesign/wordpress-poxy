(function() {
  var Loader,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  Loader = (function() {
    function Loader() {
      this.simLoad = __bind(this.simLoad, this);
    }

    Loader.prototype.q = [];

    Loader.prototype.deg = 0;

    Loader.prototype.init = function() {
      var _this = this;
      this.getEls();
      this.setup();
      this.simLoad();
      return setInterval(function() {
        return _this.render();
      }, 1000 / 60);
    };

    Loader.prototype.setup = function() {
      var _this = this;
      this.total = 100;
      this.loaded = 0;
      return setTimeout(function() {
        return _this.loader.classList.remove("hidden");
      }, 10);
    };

    Loader.prototype.getEls = function() {
      var i, q, _results;
      this.loader = document.getElementsByClassName("circle-loader")[0];
      q = this.loader.getElementsByTagName("i");
      i = 0;
      _results = [];
      while (i < q.length) {
        this.q.push(q[i]);
        _results.push(i++);
      }
      return _results;
    };

    Loader.prototype.simLoad = function() {
      var _this = this;
      this.loaded += Math.round(Math.random() * 15);
      if (this.loaded > this.total) {
        return setTimeout(function() {
          _this.loader.classList.add("hidden");
          setTimeout(function() {
            _this.total = 100;
            return _this.loaded = 0;
          }, 400);
          return setTimeout(function() {
            _this.setup();
            return _this.simLoad();
          }, 1500);
        }, 1000);
      } else {
        return setTimeout(function() {
          return _this.simLoad();
        }, 250 + Math.random() * 500);
      }
    };

    Loader.prototype.render = function() {
      var add, deg, i, loaded, _results;
      loaded = Math.min((this.loaded / this.total) * 4, 4);
      add = (loaded - this.deg) / 10;
      if (Math.abs(loaded - this.deg) < 0.01) {
        add = 0;
      }
      this.deg += add;
      i = 0;
      _results = [];
      while (i < this.q.length) {
        deg = (Math.min(Math.max(this.deg - i, 0), 1) * 90) - 90;
        this.q[i].style.webkitTransform = "rotate(" + deg + "deg)";
        this.q[i].style.mozTransform = "rotate(" + deg + "deg)";
        this.q[i].style.msTransform = "rotate(" + deg + "deg)";
        this.q[i].style.oTransform = "rotate(" + deg + "deg)";
        this.q[i].style.transform = "rotate(" + deg + "deg)";
        _results.push(i++);
      }
      return _results;
    };

    return Loader;

  })();

  window.App = {
    load: new Loader
  };

  App.load.init();

}).call(this);

/*
//@ sourceMappingURL=loader.js.map
*/