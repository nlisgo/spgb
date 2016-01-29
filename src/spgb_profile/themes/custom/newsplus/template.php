<?php

/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return
 *   A string containing the breadcrumb output.
 */
function newsplus_breadcrumb($variables) {

	$breadcrumb = $variables['breadcrumb'];
	$breadcrumb_separator = theme_get_setting('breadcrumb_separator','newsplus');	
	
	if (!empty($breadcrumb)) {
	$breadcrumb[] = drupal_get_title();
	return '<div>' . implode(' <span class="breadcrumb-separator">' . $breadcrumb_separator . '</span>', $breadcrumb) . '</div>';
	}
	
}

/**
 * Add classes to block.
 */
function newsplus_preprocess_block(&$variables) {

	$variables['title_attributes_array']['class'][] = 'title';
	$variables['classes_array'][]='clearfix';
	
}

/**
 * Override or insert variables into the html template.
 */
function newsplus_preprocess_html(&$variables) {

	$color_scheme = theme_get_setting('color_scheme');
	
	if ($color_scheme != 'default') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/style-' .$color_scheme. '.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

	if (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') {
		$protocol = "/https";
	} else {
		$protocol = "/http";
	}

	if (theme_get_setting('sitename_font_family')=='sff-1'  ||
		theme_get_setting('slogan_font_family')=='slff-1' ||
		theme_get_setting('headings_font_family')=='hff-1' ||
		theme_get_setting('paragraph_font_family')=='pff-1') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/merriweather-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}
	
	if (theme_get_setting('sitename_font_family')=='sff-2'  ||
		theme_get_setting('slogan_font_family')=='slff-2' ||
		theme_get_setting('headings_font_family')=='hff-2' ||
		theme_get_setting('paragraph_font_family')=='pff-2') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/sourcesanspro-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

	if (theme_get_setting('sitename_font_family')=='sff-3'  ||
		theme_get_setting('slogan_font_family')=='slff-3' ||
		theme_get_setting('headings_font_family')=='hff-3' ||
		theme_get_setting('paragraph_font_family')=='pff-3') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/ubuntu-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}
	
	if (theme_get_setting('sitename_font_family')=='sff-4'  ||
		theme_get_setting('slogan_font_family')=='slff-4' ||
		theme_get_setting('headings_font_family')=='hff-4' ||
		theme_get_setting('paragraph_font_family')=='pff-4') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/ptsans-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

	if (theme_get_setting('sitename_font_family')=='sff-5'  ||
		theme_get_setting('slogan_font_family')=='slff-5' ||
		theme_get_setting('headings_font_family')=='hff-5' ||
		theme_get_setting('paragraph_font_family')=='pff-5') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/roboto-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

	if (theme_get_setting('sitename_font_family')=='sff-6'  ||
		theme_get_setting('slogan_font_family')=='slff-6' ||
		theme_get_setting('headings_font_family')=='hff-6' ||
		theme_get_setting('paragraph_font_family')=='pff-6') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/opensans-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}
	
	if (theme_get_setting('sitename_font_family')=='sff-7'  ||
		theme_get_setting('slogan_font_family')=='slff-7' ||
		theme_get_setting('headings_font_family')=='hff-7' ||
		theme_get_setting('paragraph_font_family')=='pff-7') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/lato-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}
	
	if (theme_get_setting('sitename_font_family')=='sff-8'  ||
		theme_get_setting('slogan_font_family')=='slff-8' ||
		theme_get_setting('headings_font_family')=='hff-8' ||
		theme_get_setting('paragraph_font_family')=='pff-8') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/roboto-condensed-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}
	
	if (theme_get_setting('sitename_font_family')=='sff-9'  ||
		theme_get_setting('slogan_font_family')=='slff-9' ||
		theme_get_setting('headings_font_family')=='hff-9' ||
		theme_get_setting('paragraph_font_family')=='pff-9') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/exo-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}
	
	if (theme_get_setting('sitename_font_family')=='sff-10'  ||
		theme_get_setting('slogan_font_family')=='slff-10' ||
		theme_get_setting('headings_font_family')=='hff-10' ||
		theme_get_setting('paragraph_font_family')=='pff-10') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/roboto-slab-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}
	
	if (theme_get_setting('sitename_font_family')=='sff-11'  ||
		theme_get_setting('slogan_font_family')=='slff-11' ||
		theme_get_setting('headings_font_family')=='hff-11' ||
		theme_get_setting('paragraph_font_family')=='pff-11') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/raleway-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}
	
	if (theme_get_setting('sitename_font_family')=='sff-12'  ||
		theme_get_setting('slogan_font_family')=='slff-12' ||
		theme_get_setting('headings_font_family')=='hff-12' ||
		theme_get_setting('paragraph_font_family')=='pff-12') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/josefin-sans-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

	if (theme_get_setting('sitename_font_family')=='sff-14'  ||
		theme_get_setting('slogan_font_family')=='slff-14' ||
		theme_get_setting('headings_font_family')=='hff-14' ||
		theme_get_setting('paragraph_font_family')=='pff-14') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/playfair-display-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}
	
	if (theme_get_setting('sitename_font_family')=='sff-15'  ||
		theme_get_setting('slogan_font_family')=='slff-15' ||
		theme_get_setting('headings_font_family')=='hff-15' ||
		theme_get_setting('paragraph_font_family')=='pff-15') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/philosopher-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}
	
	if (theme_get_setting('sitename_font_family')=='sff-16'  ||
		theme_get_setting('slogan_font_family')=='slff-16' ||
		theme_get_setting('headings_font_family')=='hff-16' ||
		theme_get_setting('paragraph_font_family')=='pff-16') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/cinzel-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}
	
	if (theme_get_setting('sitename_font_family')=='sff-17'  ||
		theme_get_setting('slogan_font_family')=='slff-17' ||
		theme_get_setting('headings_font_family')=='hff-17' ||
		theme_get_setting('paragraph_font_family')=='pff-17') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/oswald-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

	if (theme_get_setting('sitename_font_family')=='sff-18'  ||
		theme_get_setting('slogan_font_family')=='slff-18' ||
		theme_get_setting('headings_font_family')=='hff-18' ||
		theme_get_setting('paragraph_font_family')=='pff-18') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/playfairdisplaysc-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}
    
	if (theme_get_setting('sitename_font_family')=='sff-19'  ||
		theme_get_setting('slogan_font_family')=='slff-19' ||
		theme_get_setting('headings_font_family')=='hff-19' ||
		theme_get_setting('paragraph_font_family')=='pff-19') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/cabin-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}
	
	if (theme_get_setting('sitename_font_family')=='sff-20'  ||
		theme_get_setting('slogan_font_family')=='slff-20' ||
		theme_get_setting('headings_font_family')=='hff-20' ||
		theme_get_setting('paragraph_font_family')=='pff-20') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/notosans-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

	if (theme_get_setting('sitename_font_family')=='sff-22'  ||
		theme_get_setting('slogan_font_family')=='slff-22' ||
		theme_get_setting('headings_font_family')=='hff-22' ||
		theme_get_setting('paragraph_font_family')=='pff-22') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/droidserif-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

	if (theme_get_setting('sitename_font_family')=='sff-23'  ||
		theme_get_setting('slogan_font_family')=='slff-23' ||
		theme_get_setting('headings_font_family')=='hff-23' ||
		theme_get_setting('paragraph_font_family')=='pff-23') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/ptserif-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

	if (theme_get_setting('sitename_font_family')=='sff-24'  ||
		theme_get_setting('slogan_font_family')=='slff-24' ||
		theme_get_setting('headings_font_family')=='hff-24' ||
		theme_get_setting('paragraph_font_family')=='pff-24') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/vollkorn-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

	if (theme_get_setting('sitename_font_family')=='sff-25'  ||
		theme_get_setting('slogan_font_family')=='slff-25' ||
		theme_get_setting('headings_font_family')=='hff-25' ||
		theme_get_setting('paragraph_font_family')=='pff-25') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/alegreya-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}	

	if (theme_get_setting('sitename_font_family')=='sff-26'  ||
		theme_get_setting('slogan_font_family')=='slff-26' ||
		theme_get_setting('headings_font_family')=='hff-26' ||
		theme_get_setting('paragraph_font_family')=='pff-26') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/notoserif-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

	if (theme_get_setting('sitename_font_family')=='sff-27'  ||
		theme_get_setting('slogan_font_family')=='slff-27' ||
		theme_get_setting('headings_font_family')=='hff-27' ||
		theme_get_setting('paragraph_font_family')=='pff-27') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/crimsontext-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

	if (theme_get_setting('sitename_font_family')=='sff-28'  ||
		theme_get_setting('slogan_font_family')=='slff-28' ||
		theme_get_setting('headings_font_family')=='hff-28' ||
		theme_get_setting('paragraph_font_family')=='pff-28') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/gentiumbookbasic-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

	if (theme_get_setting('sitename_font_family')=='sff-29'  ||
		theme_get_setting('slogan_font_family')=='slff-29' ||
		theme_get_setting('headings_font_family')=='hff-29' ||
		theme_get_setting('paragraph_font_family')=='pff-29') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/volkhov-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

	if (theme_get_setting('sitename_font_family')=='sff-31'  ||
		theme_get_setting('slogan_font_family')=='slff-31' ||
		theme_get_setting('headings_font_family')=='hff-31' ||
		theme_get_setting('paragraph_font_family')=='pff-31') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/alegreyasc-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

	if (theme_get_setting('sitename_font_family')=='sff-32'  ||
		theme_get_setting('slogan_font_family')=='slff-32' ||
		theme_get_setting('headings_font_family')=='hff-32' ||
		theme_get_setting('paragraph_font_family')=='pff-32') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/montserrat-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

	if (theme_get_setting('sitename_font_family')=='sff-33'  ||
		theme_get_setting('slogan_font_family')=='slff-33' ||
		theme_get_setting('headings_font_family')=='hff-33' ||
		theme_get_setting('paragraph_font_family')=='pff-33') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/firasans-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	}

	drupal_add_css(path_to_theme() . '/fonts' .$protocol. '/sourcecodepro-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	
	drupal_add_css(path_to_theme() . '/fonts' .$protocol. '/ptsans-font.css', array('group' => CSS_THEME, 'type' => 'file'));

	if (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') {
		drupal_add_css('https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css', array('type' => 'external')); 
	} else {
		drupal_add_css('http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css', array('type' => 'external')); 
	}

	drupal_add_css(path_to_theme() . '/ie9.css', array('group' => CSS_THEME, 'browsers' => array('IE' => '(IE 9)&(!IEMobile)', '!IE' => FALSE), 'preprocess' => FALSE));
    
	/**
	 * Add local.css file for CSS overrides.
	 */
	drupal_add_css(drupal_get_path('theme', 'newsplus') . '/local.css', array('group' => CSS_THEME, 'type' => 'file'));

	/**
	* Add Javascript - Enable/disable Bootstrap 3 Javascript.
	*/
	if (theme_get_setting('bootstrap_js_include', 'newsplus')) {
		drupal_add_js(drupal_get_path('theme', 'newsplus') . '/bootstrap/js/bootstrap.min.js');
	}
	//EOF:Javascript
	
	/**
	 * Add Javascript - Enable/disable scrollTop action.
	 */
	if (theme_get_setting('scrolltop_display')) {
	
		drupal_add_js('jQuery(document).ready(function($) { 
		$(window).scroll(function() {
			if($(this).scrollTop() != 0) {
				$("#toTop").fadeIn();	
			} else {
				$("#toTop").fadeOut();
			}
		});
		
		$("#toTop").click(function() {
			$("body,html").animate({scrollTop:0},800);
		});	
		
		});',
		array('type' => 'inline', 'scope' => 'header'));
	
	}
	//EOF:Javascript
	
	/**
	 * Add Javascript - Google Maps
	 */
	if (theme_get_setting('google_map_js', 'newsplus')) {

		drupal_add_js('jQuery(document).ready(function($) { 

	    var map;
	    var myLatlng;
	    var myZoom;
	    var marker;
		
		});',
		array('type' => 'inline', 'scope' => 'header')
		);
	    
		drupal_add_js('https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false',array('type' => 'external', 'scope' => 'header', 'group' => 'JS_THEME'));

		$google_map_latitude = theme_get_setting('google_map_latitude','newsplus');
        drupal_add_js(array('newsplus' => array('google_map_latitude' => $google_map_latitude)), 'setting');
		$google_map_longitude = theme_get_setting('google_map_longitude','newsplus');
        drupal_add_js(array('newsplus' => array('google_map_longitude' => $google_map_longitude)), 'setting');
		$google_map_zoom = (int) theme_get_setting('google_map_zoom','newsplus');
		$google_map_canvas = theme_get_setting('google_map_canvas','newsplus');
        drupal_add_js(array('newsplus' => array('google_map_canvas' => $google_map_canvas)), 'setting');
		
		drupal_add_js('jQuery(document).ready(function($) { 

		if ($("#'.$google_map_canvas.'").length>0) {
		
			myLatlng = new google.maps.LatLng(Drupal.settings.newsplus[\'google_map_latitude\'], Drupal.settings.newsplus[\'google_map_longitude\']);
			myZoom = '.$google_map_zoom.';
			
			function initialize() {
			
				var mapOptions = {
				zoom: myZoom,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				center: myLatlng,
				scrollwheel: false
				};
				
				map = new google.maps.Map(document.getElementById(Drupal.settings.newsplus[\'google_map_canvas\']),mapOptions);
				
				marker = new google.maps.Marker({
				map:map,
				draggable:true,
				position: myLatlng
				});
				
				google.maps.event.addDomListener(window, "resize", function() {
				map.setCenter(myLatlng);
				});
		
			}
		
			google.maps.event.addDomListener(window, "load", initialize);
			
		}
		
		});',
		array('type' => 'inline', 'scope' => 'header')
		);
		
	}

	$fixed_header = theme_get_setting('fixed_header');
	if ($fixed_header) {

		/**
		 * Add Javascript - Fixed header
		 */
		drupal_add_js('jQuery(document).ready(function($) { 

			var	preHeaderHeight = $("#pre-header").outerHeight(),
			headerTopHeight = $("#header-top").outerHeight(),
			headerHeight = $("#header").outerHeight();
			
			$(window).load(function() {
				if(($(window).width() > 767)) {
					$("body").addClass("fixed-header-enabled");
				} else {
					$("body").removeClass("fixed-header-enabled");
				}
			});

			$(window).resize(function() {
				if(($(window).width() > 767)) {
					$("body").addClass("fixed-header-enabled");
				} else {
					$("body").removeClass("fixed-header-enabled");
				}
			});

			$(window).scroll(function() {
			if(($(this).scrollTop() > preHeaderHeight+headerTopHeight+headerHeight) && ($(window).width() > 767)) {
				$("body").addClass("onscroll");

				if ($("#page-intro").length > 0) { 
 					$("#page-intro").css("marginTop", (headerHeight)+"px");
				} else {
					$("#page").css("marginTop", (headerHeight)+"px");
				}

			} else {
				$("body").removeClass("onscroll");
				$("#page,#page-intro").css("marginTop", (0)+"px");
			}
			});
		
		});',
		array('type' => 'inline', 'scope' => 'header'));
		//EOF:Javascript
		
	}

	$responsive_meanmenu = theme_get_setting('responsive_multilevelmenu_state');

	if ($responsive_meanmenu) {

	drupal_add_css(drupal_get_path('theme', 'newsplus') . '/js/meanmenu/meanmenu.css');
	drupal_add_js(drupal_get_path('theme', 'newsplus') .'/js/meanmenu/jquery.meanmenu.fork.js', array('preprocess' => false));
	
		/**
		 * Add Javascript - Mobile mean menu
		 */
		drupal_add_js('jQuery(document).ready(function($) {

			$("#main-navigation .sf-menu, #main-navigation .content>ul.menu, #main-navigation ul.main-menu").wrap("<div class=\'meanmenu-wrapper\'></div>");
			$("#main-navigation .meanmenu-wrapper").meanmenu({
				meanScreenWidth: "767",
				meanRemoveAttrs: true,
				meanMenuContainer: "#header-inside",
				meanMenuClose: ""
			});	

			if ($("#pre-header .sf-menu").length>0 || $("#pre-header .content>ul.menu").length>0) {
				$("#pre-header .sf-menu, #pre-header .content>ul.menu").wrap("<div class=\'pre-header-meanmenu-wrapper\'></div>");
				$("#pre-header .pre-header-meanmenu-wrapper").meanmenu({
					meanScreenWidth: "767",
					meanRemoveAttrs: true,
					meanMenuContainer: "#pre-header-inside",
					meanMenuClose: ""
				});
			}

			if ($("#header-top .sf-menu").length>0 || $("#header-top .content>ul.menu").length>0) {
				$("#header-top .sf-menu, #header-top .content>ul.menu").wrap("<div class=\'header-top-meanmenu-wrapper\'></div>");
				$("#header-top .header-top-meanmenu-wrapper").meanmenu({
					meanScreenWidth: "767",
					meanRemoveAttrs: true,
					meanMenuContainer: "#header-top-inside",
					meanMenuClose: ""
				});
			}

		});',
		array('type' => 'inline', 'scope' => 'header'));
		//EOF:Javascript	

	} 

	$breaking_effect = theme_get_setting('breaking_effect');
	$breaking_effect_time = (int) theme_get_setting('breaking_effect_time')*1000;

	/**
	* Add Javascript - Breaking news slideshow
	*/
	drupal_add_js('jQuery(document).ready(function($) { 
		if ($(".view-titles .flexslider").length>0) {
			$(window).load(function() {
		        $(".view-titles .flexslider, .view-titles .view-content, .view-titles .more-link").fadeIn("slow");
				$(".view-titles .flexslider").flexslider({
				animation: "'.$breaking_effect.'",             // Select your animation type, "fade" or "slide"
				slideshowSpeed: "'.$breaking_effect_time.'",   // Set the speed of the slideshow cycling, in milliseconds
		        prevText: "",           
		        nextText: "",           
				pauseOnAction: false,
		        useCSS: false,
		        controlNav: false,
				directionNav: false
				});
				
			});
		}
	});',
	array('type' => 'inline', 'scope' => 'header'));

	/**
	* Add Javascript - Affix
	*/
	drupal_add_js('jQuery(document).ready(function($) { 
		if (jQuery("#affix").length>0) {
			$(window).load(function() {

				var affixBottom = $("#footer").outerHeight(true) + $("#subfooter").outerHeight(true),
				affixTop = $("#affix").offset().top;

				if (jQuery(".view-mt-internal-banner").length>0) {
					var pageWidth = $("#page>.container").outerWidth();
					if (pageWidth == 1170) {
						affixTop = $("#affix").offset().top+610;
					} else {
						affixTop = $("#affix").offset().top+506;
					}
				}

				if (jQuery(".fixed-header-enabled").length>0 || jQuery(".logged-in").length>0) {
					$("#affix").affix({
				        offset: {
				          top: affixTop-65,
				          bottom: affixBottom+50
				        }
				    });
				} else {
					$("#affix").affix({
				        offset: {
				          top: affixTop-35,
				          bottom: affixBottom+50
				        }
				    });
				}

			});
		}
	});',
	array('type' => 'inline', 'scope' => 'header'));

	/**
	* Add Javascript - Print button
	*/
	drupal_add_js('
	if (jQuery(".print-button").length>0) {
		function PrintElem() {
		
			var divToPrint = document.getElementById("printArea");
	    	var mywindow = window.open("","_blank","");
		               
	    	mywindow.document.write(divToPrint.innerHTML);
	    
			mywindow.document.close();
			mywindow.focus();
			mywindow.print();
			mywindow.close();
		}
	}',
	array('type' => 'inline', 'scope' => 'header'));

	/**
	* Add Javascript - Increase/decrease font-size buttons
	*/
	drupal_add_js('jQuery(document).ready(function($) {
	if ($("#incfont").length>0 || $("#decfont").length>0 ) {

		(function () {
	    	
	    	$.fn.fontResize = function(options){
	    	
				var self = this;
				var increaseCount = 0;

				options.increaseBtn.on("click", function (e) {
		      	e.preventDefault();
					if(increaseCount < 3) {
					increaseCount++;
					} else {
					return false;
					}
					self.each(function(index, element){
					curSize= parseInt($(element).css("font-size")) * 1.1;
					if(increaseCount < 4) { $(element).css("font-size", curSize); }
					});
					console.log(increaseCount);
					return false;
				});

				options.decreaseBtn.on("click", function (e) {
		      	e.preventDefault();
					if(increaseCount > -2) {
					increaseCount--;
					} else {
					return false;
					}
					self.each(function(index, element){  
					curSize= parseInt($(element).css("font-size")) / 1.1;
					if(increaseCount > -3) { $(element).css("font-size", curSize); }
					});
					console.log(increaseCount);
					return false;
		    	});

			}

		})();

		$(window).load(function() {
			$(".node-content p, .node-content h1, .node-content h2, .node-content h3, .node-content h4, .node-content h5," +
				".node-content h6, .node-content a, .node-content ul, .node-content ol, .node-content input, .comment .submitted," +
				".node-content .node-info").fontResize({
				increaseBtn: $("#incfont"),
				decreaseBtn: $("#decfont")
			});
		});
	}
	});',
	array('type' => 'inline', 'scope' => 'header'));

	/**
	* Add Javascript - Node progress bar
	*/
	drupal_add_js('jQuery(document).ready(function($) {

        $(window).load(function () {
       		if ($(".post-progress").length>0){
	            var s = $(window).scrollTop(),
	            c = $(window).height(),
	            d = $(".node-content").outerHeight(),
	            e = $("#comments").outerHeight(true),
	            f = $(".node-footer").outerHeight(true),
	            g = $(".node-content").offset().top;

				if (jQuery(".view-mt-internal-banner").length>0) {
					var pageWidth = $("#page>.container").outerWidth();
					if (pageWidth == 1170) {
						g = g+610;
					} else {
						g = g+506;
					}
				}

	            var scrollPercent = (s / (d+g-c-e-f)) * 100;
                scrollPercent = Math.round(scrollPercent);

	            if (c >= (d+g-e-f)) { scrollPercent = 100; } else if (scrollPercent < 0) { scrollPercent = 0; } else if (scrollPercent > 100) { scrollPercent = 100; }

	            $(".post-progressbar").css("width", scrollPercent + "%");
	            $(".post-progress-value").html(scrollPercent + "%");
	        }
        });

        $(window).scroll(function () {
            if ($(".post-progress").length>0){
	            var s = $(window).scrollTop(),
	            c = $(window).height(),
	            d = $(".node-content").outerHeight(true),
	            e = $("#comments").outerHeight(true),
	            f = $(".node-footer").outerHeight(true),
	            g = $(".node-content").offset().top;

                var scrollPercent = (s / (d+g-c-e-f)) * 100;
                scrollPercent = Math.round(scrollPercent);
                
                if (c >= (d+g-e-f)) { scrollPercent = 100; }  else if (scrollPercent < 0) { scrollPercent = 0; } else if (scrollPercent > 100) { scrollPercent = 100; }
                
                $(".post-progressbar").css("width", scrollPercent + "%");
                $(".post-progress-value").html(scrollPercent + "%");
            }
        });	

	});',
	array('type' => 'inline', 'scope' => 'header'));

	/**
	* Add Javascript for detect the page number of feed views
	*/
	drupal_add_js('jQuery(document).ready(function($) {
		if ($(".view-feed").length > 0) {
		    if(!(window.location.href.indexOf("page") > 0)) {
    			$(".view-feed .views-row-1").addClass("latest-object");
    		} else {
    			$(".view-feed .view-header").addClass("hide");
    		}
    	}
	});',
	array('type' => 'inline', 'scope' => 'header'));
}

/**
 * Override or insert variables into the html template.
 */
function newsplus_process_html(&$vars) {

	$layout = theme_get_setting('three_columns_grid_layout');
	if (($layout == "grid_4_6_2") || ($layout == "grid_2_6_4")) {
		$layout_body_class = "narrow-sidebar";
	} else {
		$layout_body_class = "wide-sidebar";
	}

	$classes = explode(' ', $vars['classes']);
	$classes[] = theme_get_setting('sitename_font_family');
	$classes[] = theme_get_setting('slogan_font_family');
	$classes[] = theme_get_setting('headings_font_family');
	$classes[] = theme_get_setting('paragraph_font_family');
	$classes[] = $layout_body_class;
	$vars['classes'] = trim(implode(' ', $classes));

}

/**
 * Preprocess variables for page template.
 */
function newsplus_preprocess_page(&$variables) {
	
	$three_columns_grid_layout = theme_get_setting('three_columns_grid_layout', 'newsplus');
	$sidebar_first = $variables['page']['sidebar_first'];
	$sidebar_second = $variables['page']['sidebar_second'];
	$footer_first = $variables['page']['footer_first'];
	$footer_second = $variables['page']['footer_second'];
	$footer_third = $variables['page']['footer_third'];
	$footer_fourth = $variables['page']['footer_fourth'];
	$pre_header_left = $variables['page']['pre_header_left'];
	$pre_header_right = $variables['page']['pre_header_right'];
	$header = $variables['page']['header'];
	$header_top_right = $variables['page']['header_top_right'];	

	/**
	 * Insert variables into the page template.
	 */
	if (drupal_is_front_page() || isset($variables['node']) && ($variables['node']->type == 'blog' || $variables['node']->type == 'article' || $variables['node']->type == 'mt_post')) {
		if (isset($variables['node']) && $variables['node']->type != 'page' ) { 
			if($sidebar_first && $sidebar_second) { 
				if ($three_columns_grid_layout == 'grid_3_6_3') {
					$variables['main_grid_class'] = 'col-md-6';
					$variables['sidebar_first_grid_class'] = 'col-md-3';
					$variables['sidebar_second_grid_class'] = 'col-md-3';
				} elseif ($three_columns_grid_layout == 'grid_2_6_4') {
					$variables['main_grid_class'] = 'col-md-6';
					$variables['sidebar_first_grid_class'] = 'col-md-2';
					$variables['sidebar_second_grid_class'] = 'col-md-4';
				} elseif ($three_columns_grid_layout == 'grid_4_6_2') {
					$variables['main_grid_class'] = 'col-md-6';
					$variables['sidebar_first_grid_class'] = 'col-md-4';
					$variables['sidebar_second_grid_class'] = 'col-md-2';
				}
			} elseif ($sidebar_first && !$sidebar_second) {
				$variables['main_grid_class'] = 'col-md-7';
				$variables['sidebar_first_grid_class'] = 'col-md-4';
			} elseif (!$sidebar_first && $sidebar_second) {
				$variables['main_grid_class'] = 'col-md-8';
				$variables['sidebar_second_grid_class'] = 'col-md-4';		
			} else {
				$variables['main_grid_class'] = 'col-md-8 col-md-offset-2';
				$variables['sidebar_first_grid_class'] = '';	
				$variables['sidebar_second_grid_class'] = '';			
			}
		} else {
			if($sidebar_first && $sidebar_second) { 
				if ($three_columns_grid_layout == 'grid_3_6_3') {
					$variables['main_grid_class'] = 'col-md-6';
					$variables['sidebar_first_grid_class'] = 'col-md-3';
					$variables['sidebar_second_grid_class'] = 'col-md-3';
				} elseif ($three_columns_grid_layout == 'grid_2_6_4') {
					$variables['main_grid_class'] = 'col-md-6';
					$variables['sidebar_first_grid_class'] = 'col-md-2';
					$variables['sidebar_second_grid_class'] = 'col-md-4';
				} elseif ($three_columns_grid_layout == 'grid_4_6_2') {
					$variables['main_grid_class'] = 'col-md-6';
					$variables['sidebar_first_grid_class'] = 'col-md-4';
					$variables['sidebar_second_grid_class'] = 'col-md-2';
				}
			} elseif ($sidebar_first && !$sidebar_second) {
				$variables['main_grid_class'] = 'col-md-8';
				$variables['sidebar_first_grid_class'] = 'col-md-4';
			} elseif (!$sidebar_first && $sidebar_second) {
				$variables['main_grid_class'] = 'col-md-8';
				$variables['sidebar_second_grid_class'] = 'col-md-4';		
			} else {
				$variables['main_grid_class'] = 'col-md-12';
				$variables['sidebar_first_grid_class'] = '';	
				$variables['sidebar_second_grid_class'] = '';			
			}
		}
	} else {
		if (isset($variables['node']) && $variables['node']->type != 'page' ) { 
			if($sidebar_first && $sidebar_second) { 
				if ($three_columns_grid_layout == 'grid_3_6_3') {
					$variables['main_grid_class'] = 'col-md-6';
					$variables['sidebar_first_grid_class'] = 'col-md-3';
					$variables['sidebar_second_grid_class'] = 'col-md-3';
				} elseif ($three_columns_grid_layout == 'grid_2_6_4') {
					$variables['main_grid_class'] = 'col-md-6';
					$variables['sidebar_first_grid_class'] = 'col-md-2';
					$variables['sidebar_second_grid_class'] = 'col-md-4';
				} elseif ($three_columns_grid_layout == 'grid_4_6_2') {
					$variables['main_grid_class'] = 'col-md-6';
					$variables['sidebar_first_grid_class'] = 'col-md-4';
					$variables['sidebar_second_grid_class'] = 'col-md-2';
				}
			} elseif ($sidebar_first && !$sidebar_second) {
				$variables['main_grid_class'] = 'col-md-7';
				$variables['sidebar_first_grid_class'] = 'col-md-4';
			} elseif (!$sidebar_first && $sidebar_second) {
				$variables['main_grid_class'] = 'col-md-7 col-md-offset-1';
				$variables['sidebar_second_grid_class'] = 'col-md-4';		
			} else {
				$variables['main_grid_class'] = 'col-md-8 col-md-offset-2';
				$variables['sidebar_first_grid_class'] = '';	
				$variables['sidebar_second_grid_class'] = '';			
			}
		} else {
			if($sidebar_first && $sidebar_second) { 
				if ($three_columns_grid_layout == 'grid_3_6_3') {
					$variables['main_grid_class'] = 'col-md-6';
					$variables['sidebar_first_grid_class'] = 'col-md-3';
					$variables['sidebar_second_grid_class'] = 'col-md-3';
				} elseif ($three_columns_grid_layout == 'grid_2_6_4') {
					$variables['main_grid_class'] = 'col-md-6';
					$variables['sidebar_first_grid_class'] = 'col-md-2';
					$variables['sidebar_second_grid_class'] = 'col-md-4';
				} elseif ($three_columns_grid_layout == 'grid_4_6_2') {
					$variables['main_grid_class'] = 'col-md-6';
					$variables['sidebar_first_grid_class'] = 'col-md-4';
					$variables['sidebar_second_grid_class'] = 'col-md-2';
				}
			} elseif ($sidebar_first && !$sidebar_second) {
				$variables['main_grid_class'] = 'col-md-7';
				$variables['sidebar_first_grid_class'] = 'col-md-4';
			} elseif (!$sidebar_first && $sidebar_second) {
				$variables['main_grid_class'] = 'col-md-7 col-md-offset-1';
				$variables['sidebar_second_grid_class'] = 'col-md-4';		
			} else {
				$variables['main_grid_class'] = 'col-md-12';
				$variables['sidebar_first_grid_class'] = '';	
				$variables['sidebar_second_grid_class'] = '';			
			}
		}	
	}

	if ($pre_header_left && $pre_header_right) { 
		$variables['pre_header_left_grid_class'] = 'col-md-8';
		$variables['pre_header_right_grid_class'] = 'col-md-4';
	} else { 
		$variables['pre_header_left_grid_class'] = 'col-md-12';
		$variables['pre_header_right_grid_class'] = 'col-md-12';
	}

	if ($header) { 
		$variables['header_inside_left_grid_class'] = 'col-md-8';
	} else { 
		$variables['header_inside_left_grid_class'] = 'col-md-12';
	}

	if ($header_top_right) { 
		$variables['header_top_inside_left_grid_class'] = 'col-md-6';
	} else { 
		$variables['header_top_inside_left_grid_class'] = 'col-md-12';
	}	

	if ($footer_first && $footer_second && $footer_third && $footer_fourth) { 
		$variables['footer_grid_class'] = 'col-sm-3';
	} elseif ((!$footer_first && $footer_second && $footer_third && $footer_fourth) || ($footer_first && !$footer_second && $footer_third && $footer_fourth) 
	|| ($footer_first && $footer_second && !$footer_third && $footer_fourth) || ($footer_first && $footer_second && $footer_third && !$footer_fourth)) { 
		$variables['footer_grid_class'] = 'col-sm-4';
	} elseif ((!$footer_first && !$footer_second && $footer_third && $footer_fourth) || (!$footer_first && $footer_second && !$footer_third && $footer_fourth) 
	|| (!$footer_first && $footer_second && $footer_third && !$footer_fourth) || ($footer_first && !$footer_second && !$footer_third && $footer_fourth)
	|| ($footer_first && !$footer_second && $footer_third && !$footer_fourth) || ($footer_first && $footer_second && !$footer_third && !$footer_fourth)) {
		$variables['footer_grid_class'] = 'col-sm-6';		
	} else { 
		$variables['footer_grid_class'] = 'col-sm-12';
	}

}

/**
 * Preprocess variables for node template.
 */
function newsplus_preprocess_node(&$variables) {
	$variables['posted_ago'] = format_interval((time() - $variables['created']), 1);
	$variables['changed_ago'] = format_interval((time() - $variables['changed']), 1);
}

/**
* Implements hook_preprocess_maintenance_page().
*/
function newsplus_preprocess_maintenance_page(&$variables) {

	$color_scheme = theme_get_setting('color_scheme');
	if ($color_scheme != 'default') {
		drupal_add_css(drupal_get_path('theme', 'newsplus') . '/style-' .$color_scheme. '.css', array('group' => CSS_THEME, 'type' => 'file'));
	}
	
	if (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') {
		$protocol = '/https';
	} else {
		$protocol = '/http';
	}
	drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/roboto-font.css', array('group' => CSS_THEME, 'type' => 'file'));
	drupal_add_css(drupal_get_path('theme', 'newsplus') . '/fonts' .$protocol. '/montserrat-font.css', array('group' => CSS_THEME, 'type' => 'file'));

}

function newsplus_page_alter($page) {

	$mobileoptimized = array(
		'#type' => 'html_tag',
		'#tag' => 'meta',
		'#attributes' => array(
		'name' =>  'MobileOptimized',
		'content' =>  'width'
		)
	);
	$handheldfriendly = array(
		'#type' => 'html_tag',
		'#tag' => 'meta',
		'#attributes' => array(
		'name' =>  'HandheldFriendly',
		'content' =>  'true'
		)
	);
	$viewport = array(
		'#type' => 'html_tag',
		'#tag' => 'meta',
		'#attributes' => array(
		'name' =>  'viewport',
		'content' =>  'width=device-width, initial-scale=1'
		)
	);
	drupal_add_html_head($mobileoptimized, 'MobileOptimized');
	drupal_add_html_head($handheldfriendly, 'HandheldFriendly');
	drupal_add_html_head($viewport, 'viewport');
	
}

function newsplus_form_alter(&$form, &$form_state, $form_id) {
	
	if ($form_id == 'search_block_form') {
	unset($form['search_block_form']['#title']);
	$form['search_block_form']['#title_display'] = 'invisible';
	$form_default = t('Enter terms then hit Search...');
	$form['search_block_form']['#default_value'] = $form_default;

	$form['actions']['submit']['#attributes']['value'][] = '';

	$form['search_block_form']['#attributes'] = array('onblur' => "if (this.value == '') {this.value = '{$form_default}';}", 'onfocus' => "if (this.value == '{$form_default}') {this.value = '';}" );
	}

}

?>