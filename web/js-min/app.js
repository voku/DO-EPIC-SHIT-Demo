/*
 * OpenRheinRuhr by Lars Moelleken (2014-11-06, 01:28)
 */

$(document).ready(function(){var a=$(".main-navbar");a.affix({offset:{top:$("header").height()-a.height()}}),$("body").scrollspy({target:".main-navbar"}),$(".scroll-top").click(function(a){a.preventDefault(),$("body,html").animate({scrollTop:0},1e3)}),$("body.tpl_index").find(".navbar-nav li>a").click(function(a){a.preventDefault();var b=$(this).attr("href"),c=$(b).offset().top+20;$("body,html").animate({scrollTop:c},700)}),$("#map-canvas--js").append('<object data="http://www.openstreetmap.org/export/embed.html?bbox=6.84631,51.47322,6.85432,51.47813&layer=mapnik&marker=51.47569,6.85032" type="text/html" style="width: 100%; height: 100%;"></object><br /><small><a target="_blank" href="http://www.openstreetmap.org/?lat=51.475675&lon=6.850315&zoom=17&layers=B000FTFTT&mlat=51.47569&mlon=6.85032">Grö&szlig;ere Karte anzeigen</a></small>')});
//# sourceMappingURL=app.js.map