class Loader

  q: []
  deg: 0

  init: ->
    @.getEls()
    @.setup()
    @.simLoad()
    setInterval =>
      @.render()
    , 1000 / 60

  setup: ->
    @.total = 100
    @.loaded = 0
    setTimeout =>
      @.loader.classList.remove("hidden")
    , 10

  getEls: ->
    @.loader = document.getElementsByClassName("circle-loader")[0]
    q =  @.loader.getElementsByTagName("i")
    i = 0
    while i < q.length
      @.q.push( q[i] )
      i++

  simLoad: =>
    @.loaded += Math.round( Math.random() * 15 )
    if @.loaded > @.total
      setTimeout =>
      	@.loader.classList.add("hidden")
      	setTimeout =>
      		@.total = 100
      		@.loaded = 0
      	, 400
      	setTimeout =>
      		@.setup()
      		@.simLoad()
      	, 1500
      , 1000
    else
      setTimeout =>
        @.simLoad()
      , 250 + Math.random() * 500

  render: ->
    loaded = Math.min(( @.loaded / @.total ) * 4 , 4 )
    add = ( loaded - @.deg ) / 10
    if Math.abs( loaded - @.deg ) < 0.01 then add = 0
    @.deg += add

    i = 0
    while i < @.q.length
      deg = ( Math.min( Math.max( @.deg - i , 0 ) , 1 ) * 90 ) - 90
      @.q[i].style.webkitTransform = "rotate(#{deg}deg)"
      @.q[i].style.mozTransform = "rotate(#{deg}deg)"
      @.q[i].style.msTransform = "rotate(#{deg}deg)"
      @.q[i].style.oTransform = "rotate(#{deg}deg)"
      @.q[i].style.transform = "rotate(#{deg}deg)"
      i++

window.App =
  load: new Loader

App.load.init()
