/*
Description:	mr meta box
Version:		0.3
Author:			Miha Rekar
Author URI:		http://mr.si/
*/(function(e,t){function n(){if(e(".mr-meta-box-panel").length){clearTimeout(r);e(".mr-meta-box-panel").css("height","auto");var t=Math.max.apply(null,e(".mr-meta-box-panel").map(function(){return e(this).height()}).get());e(".mr-meta-box-panel").each(function(){var n=e(this);n.height(t);n.width((n.parent().width()-4)/3)});r=setTimeout(n,1e3)}}e(".mr-meta-box").parent().css("margin",0).css("padding",0);var r="";n();if(!t.Modernizr.inputtypes.color){e(".color-picker").each(function(){var t=e(this);e.farbtastic(t).linkTo(t.siblings(".mr-color"))});e(".mr-color").on("focus",function(){e(this).siblings(".color-picker").show("blind",n)}).on("focusout",function(){e(this).siblings(".color-picker").hide("blind",n)})}if(t.Modernizr.inputtypes.range){e(".mr-range").on("change",function(){var t=e(this);t.siblings(".mr-range-text").val(t.val())});e(".mr-range-text").on("change",function(){var t=e(this);t.siblings(".mr-range").val(t.val())})}else{e(".mr-range").each(function(){var t=e(this),n=t.siblings(".mr-range-slider"),r=t.siblings(".mr-range-text");t.hide();n.css("display","inline-block").slider({value:parseFloat(t.attr("value")),step:parseFloat(t.attr("step")),min:parseFloat(t.attr("min")),max:parseFloat(t.attr("max")),slide:function(){r.val(n.slider("value"))}})});e(".mr-range-text").on("change",function(){var t=e(this);t.siblings(".mr-range-slider").slider("value",parseFloat(t.val()))})}e(".mr-date").each(function(){var t=e(this);t.datepicker({dateFormat:t.data("dateformat"),minDate:e(this).data("mindate"),maxDate:e(this).data("maxdate")})});e(".mr-time").each(function(){var t=e(this);t.timepicker({timeOnlyTitle:t.siblings("label").text(),timeFormat:t.data("timeformat"),ampm:t.data("ampm"),showHour:t.data("showhour"),showMinute:t.data("showminute"),showSecond:t.data("showsecond"),showMillisec:t.data("showmillisec"),showTimezone:t.data("showtimezone")})});e(".mr-location").each(function(){var n=e(this),r=n.attr("id"),i=e("#"+r+"_lat"),s=e("#"+r+"_lng"),o=new t.google.maps.LatLng(i.val(),s.val());n.geocomplete({map:"#"+n.attr("id")+"_map",location:o,markerOptions:{draggable:!0,position:o}});n.on("geocode:result",function(e,t){i.val(t.geometry.location.lat());s.val(t.geometry.location.lng())});n.on("geocode:dragged",function(e,t){i.val(t.lat());s.val(t.lng())})});e(".mr-image").click(function(t){t.preventDefault();e(this).parent().siblings(".mr-image-button").click()});e(".mr-image-button").click(function(n){n.preventDefault();var r=e(this);tbframe_interval=setInterval(function(){jQuery("#TB_iframeContent").contents().find(".savesend .button").val("Use This Image")},2e3);t.tb_show(r.val(),"media-upload.php?post_id="+r.data("post")+"&type=image&TB_iframe=true");t.send_to_editor=function(n){var i=e("img",n).attr("class").match(/wp\-image\-([0-9]+)/);r.parent().find(".mr-image").attr("src",e("img",n).attr("src")).show("blind");r.siblings(".mr-image-hidden").val(i[1]);r.siblings(".mr-image-delete").show();t.tb_remove()}});e(".mr-image-delete").click(function(t){t.preventDefault();var r=e(this);r.siblings(".mr-image-hidden").val("");r.parent().find(".mr-image").attr("src","").hide("blind",n);r.hide()})})(jQuery,window);