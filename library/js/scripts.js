/* imgsizer (flexible images for fluid sites) */
var imgSizer={Config:{imgCache:[],spacer:"/path/to/your/spacer.gif"},collate:function(aScope){var isOldIE=(document.all&&!window.opera&&!window.XDomainRequest)?1:0;if(isOldIE&&document.getElementsByTagName){var c=imgSizer;var imgCache=c.Config.imgCache;var images=(aScope&&aScope.length)?aScope:document.getElementsByTagName("img");for(var i=0;i<images.length;i++){images[i].origWidth=images[i].offsetWidth;images[i].origHeight=images[i].offsetHeight;imgCache.push(images[i]);c.ieAlpha(images[i]);images[i].style.width="100%";}
if(imgCache.length){c.resize(function(){for(var i=0;i<imgCache.length;i++){var ratio=(imgCache[i].offsetWidth/imgCache[i].origWidth);imgCache[i].style.height=(imgCache[i].origHeight*ratio)+"px";}});}}},ieAlpha:function(img){var c=imgSizer;if(img.oldSrc){img.src=img.oldSrc;}
var src=img.src;img.style.width=img.offsetWidth+"px";img.style.height=img.offsetHeight+"px";img.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+src+"', sizingMethod='scale')"
img.oldSrc=src;img.src=c.Config.spacer;},resize:function(func){var oldonresize=window.onresize;if(typeof window.onresize!='function'){window.onresize=func;}else{window.onresize=function(){if(oldonresize){oldonresize();}
func();}}}}

// add twitter bootstrap classes and color based on how many times tag is used
function addTwitterBSClass(thisObj) {
  var title = $(thisObj).attr('title');
  if (title) {
    var titles = title.split(' ');
    if (titles[0]) {
      var num = parseInt(titles[0]);
      if (num > 0)
      	$(thisObj).addClass('label');
      if (num == 2)
        $(thisObj).addClass('label label-info');
      if (num > 2 && num < 4)
        $(thisObj).addClass('label label-success');
      if (num >= 5 && num < 10)
        $(thisObj).addClass('label label-warning');
      if (num >=10)
        $(thisObj).addClass('label label-important');
    }
  }
  else
  	$(thisObj).addClass('label');
  return true;
}

// as the page loads, cal these scripts
$(document).ready(function() {

	// modify tag cloud links to match up with twitter bootstrap
	$("#tag-cloud a").each(function() {
	    addTwitterBSClass(this);
	    return true;
	});
	
	$("p.tags a").each(function() {
		addTwitterBSClass(this);
		return true;
	});
	
	$("ol.commentlist a.comment-reply-link").each(function() {
		$(this).addClass('btn btn-success btn-mini');
		return true;
	});
	
	$('#cancel-comment-reply-link').each(function() {
		$(this).addClass('btn btn-danger btn-mini');
		return true;
	});
	
	$('article.post').hover(function(){
		$('a.edit-post').show();
	},function(){
		$('a.edit-post').hide();
	});
	
	// Input placeholder text fix for IE
	$('[placeholder]').focus(function() {
	  var input = $(this);
	  if (input.val() == input.attr('placeholder')) {
		input.val('');
		input.removeClass('placeholder');
	  }
	}).blur(function() {
	  var input = $(this);
	  if (input.val() == '' || input.val() == input.attr('placeholder')) {
		input.addClass('placeholder');
		input.val(input.attr('placeholder'));
	  }
	}).blur();
	
	// Prevent submission of empty form
	$('[placeholder]').parents('form').submit(function() {
	  $(this).find('[placeholder]').each(function() {
		var input = $(this);
		if (input.val() == input.attr('placeholder')) {
		  input.val('');
		}
	  })
	});
	
	$('#s').focus(function(){
		if( $(window).width() < 940 ){
			$(this).animate({ width: '200px' });
		}
	});
	
	$('#s').blur(function(){
		if( $(window).width() < 940 ){
			$(this).animate({ width: '100px' });
		}
	});
			
	$('.alert-message').alert();
	
	$('.dropdown-toggle').dropdown();
	
	// carousel demo
    $('#myCarousel').carousel()
	$('[data-toggle=collapse]').click(function(){
    	$(this).find("i").toggleClass("icon-plus icon-minus");
	});
	//
	// Toggle Student Info Panels
	// ------------------------------------------
	
	$('.info-panel').collapse({
  		toggle: false
	});
	$('#student-menu a.toggle').click(function(){
		$(this).parent().siblings().children().removeClass('active');
 		$(this).toggleClass('active');
		$('#student-menu a.toggle i').removeClass('icon-chevron-down');
		$('#student-menu a.toggle i').addClass('icon-chevron-right');
		if($(this).hasClass('active')){
			$(this).children('i').removeClass('icon-chevron-right');
			$(this).children('i').addClass('icon-chevron-down');
			$(this).children('div').children('i').removeClass('icon-chevron-right');
			$(this).children('div').children('i').addClass('icon-chevron-down');
		} 
        var target = $(this).attr("href");
		$mynames = getNames();
		for ( var i = 0; i < $mynames.length; i++ ) {
  			$myname = $mynames[i];
			$myname = "#"+$myname;
			if ($($myname).not(target).hasClass('in')){
				$($myname).collapse('toggle');
			}
		}
		//var $div = $($(this).attr('href'));
   			$target.collapse('toggle');
    	return false;
	});
	
	/**/
	// Fluid Width Videos 
	// By Chris Coyier & tweaked by Mathias Bynens

	// Find all YouTube videos
	var $allVideos = $("iframe[src^='http://www.youtube.com']"),

	    // The element that is fluid width
	    $fluidEl = $(".video-player");

	// Figure out and save aspect ratio for each video
	$allVideos.each(function() {

		$(this)
			.data('aspectRatio', this.height / this.width)
			
			// and remove the hard coded width/height
			.removeAttr('height')
			.removeAttr('width');

	});

	// When the window is resized
	// (You'll probably want to debounce this)
	$(window).resize(function() {

		var newWidth = $fluidEl.width();
		
		// Resize all videos according to their own aspect ratio
		$allVideos.each(function() {

			var $el = $(this);
			$el
				.width(newWidth)
				.height(newWidth * $el.data('aspectRatio'));

		});

	// Kick off one resize to fix all videos on page load
	}).resize();
	
	// Hide Fields in input windows
	/*! jQuery script to hide certain form fields */
 
    //Hide the field initially
    $("#hide1").hide();
	//Show the text field only when the third option is chosen - this doesn't
    $('#campus').click(function(){
    	if (true) {
        	$("#hide1").toggle();
         } else if (false) {
            $("#hide1").toggle();
         }
	});

	// Add HTML <i> class to links in "list-links" class
	// -------------------------------------------------
	$(".list-links li a").before("<i class='icon-chevron-right blue'></i>");
	
	// Add HTML <i> class to links in "list-links" class
	// -------------------------------------------------
	function getNames (args){
	var names = [];
	$('#panels').children('.info-panel').each(function(){
      		names.push($(this).attr('id')); 
	});
	return names;
	};
	
	// Fit Google Maps
	$("#main").fitMaps( {w: '100%', h:'400px'} );
	
	// Auto Add Google Analytics to files, email links... etc
	// -------------------------------------------------
	var filetypes = /\.(zip|exe|pdf|doc*|xls*|ppt*|mp3)$/i;
        var baseHref = '';
        if (jQuery('base').attr('href') != undefined)
            baseHref = jQuery('base').attr('href');
        jQuery('a').each(function() {
            var href = jQuery(this).attr('href');
            if (href && (href.match(/^https?\:/i)) && (!href.match(document.domain))) {
                jQuery(this).click(function() {
                    var extLink = href.replace(/^https?\:\/\//i, '');
                    _gaq.push(['_trackEvent', 'External', 'Click', extLink]);
                    if (jQuery(this).attr('target') != undefined && jQuery(this).attr('target').toLowerCase() != '_blank') {
                        setTimeout(function() { location.href = href; }, 200);
                        return false;
                    }
                });
            }
            else if (href && href.match(/^mailto\:/i)) {
                jQuery(this).click(function() {
                    var mailLink = href.replace(/^mailto\:/i, '');
                    _gaq.push(['_trackEvent', 'Email', 'Click', mailLink]);
                });
            }
            else if (href && href.match(filetypes)) {
                jQuery(this).click(function() {
                    var extension = (/[.]/.exec(href)) ? /[^.]+$/.exec(href) : undefined;
                    var filePath = href;
                    _gaq.push(['_trackEvent', 'Download', 'Click-' + extension, filePath]);
                    if (jQuery(this).attr('target') != undefined && jQuery(this).attr('target').toLowerCase() != '_blank') {
                        setTimeout(function() { location.href = baseHref + href; }, 200);
                        return false;
                    }
                });
            }
        });
	$('#calendar').fullCalendar({
		// Hollow Feed
		events: 'http://www.google.com/calendar/feeds/4ladaqvvrqmhb9cumua63i7vkc%40group.calendar.google.com/public/basic',
		eventClick: function(event) {
		// opens events in a popup window
			window.open(event.url, 'gcalevent', 'width=800,height=600');
			return false;
		},
		loading: function(bool) {
			if (bool) {
				$('#loading').show();
			}else{
				$('#loading').hide();
			}
		}
	});
}); /* end of as page load scripts */
    