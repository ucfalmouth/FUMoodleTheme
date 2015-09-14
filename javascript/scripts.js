
+function ($) {
  'use strict';

	// Setup on hover trigger for the navbar dropdown menus
	$('.navbar-nav li.dropdown').hover(function() {
	  $(this).find('.dropdown-menu').stop(true, true).delay(200).show();
	}, function() {
	  $(this).find('.dropdown-menu').stop(true, true).delay(200).hide();
	});

	// USER ROLES
	var currentUserRole = $('#userrole').data( "role" );
	if(currentUserRole == "student") {
	  $('.block_settings').hide();
	  $('#student-email-link').show();
	} else if(currentUserRole == "teacher") {
	  $('.block_settings .commands').hide();
	  $('#staff-email-link').show();
	} else if(currentUserRole == "admin") {
	  $('#toggle-admin-settings').show();
	}

	// Add the view all sections link to the bottom of the course sections list
		// check if we have a link to show all sections - [[returntomaincoursepage]]
		var showAllSections = $('.section-navigation.header.headingblock>a.mdl-right');
		if (showAllSections.length != 0) {
			// this is probably a course page with a specific section loaded
			// http://localhost/moodle/course/view.php?id=164&section=1
			
			showAllSections.text('View all sections').removeClass('mdl-right').addClass('section_link');

			// now build this up so that it fits the correct right bar style
			// li.type_custom item_with_icon > p.tree_item leaf hasicon > a.section_link
			var $li = $("<li>")
				.addClass('type_custom item_with_icon')
				.append( 
					$("<p>")
						.addClass('tree_item leaf hasicon')
						.append( showAllSections )
				)
			;

			$('.block_course_menu .block_tree').append($li);  
			//showAllSections.clone().appendTo( $('.sidr-class-block_navigation') );
		} else {
			var bodyID = document.body.id;
  			if(bodyID != "page-mod-page-view") {
  				var $li = $("<li>")
					.addClass('type_custom item_with_icon current_branch')
					.append( 
						$("<p>")
							.addClass('tree_item leaf hasicon')
							.append( 
								$("<a>").attr("href","#")
									.addClass("section_link active_tree_node")
									.text("View all sections")
							)
					)
				;
    			$('.block_course_menu .block_tree').append($li);
    		}
		}


	// hack links and insert the section=1 parameter where appropriate
	if( ($('.pagelayout-coursecategory').length > 0) || ($('.pagelayout-frontpage').length > 0) || ($('.pagelayout-standard').length > 0)) {
		$("div[role=\"main\"] a").each(function(){
			var href = $(this).attr("href");
			if (href.indexOf("section=") == -1) {
				if (href.indexOf("?") > 0) {
					$(this).attr("href", href + "&section=1");
				} else {
					$(this).attr("href", href + "?section=1");
				}
			}
		});
	}


	$('.unlist').find('.name > a').each(function(){
		var href = $(this).attr("href");
		if (href.indexOf("?") > 0) {
			$(this).attr("href", href + "&section=1");
		} else {
			$(this).attr("href", href + "?section=1");
		}
	});


	/** OFF CANVAS NAVIGATION **/
	var sidebar = $("#block-region-side-post");
	$("#btn-toggle-navbar").click( function(evt) {
		evt.preventDefault();
		sidebar.toggleClass("show");
	});


	/** ABILITY TO HIDE THE SIDEPOST REGION IF REQUIRED **/
	  var $sidepost = $("#block-region-side-post");
	  var $regionmain = $("#region-main");

	  // check we have a sidepost region
	  if ($sidepost.length != 0) {
	    // create a button for show/hide
	    var $btn_toggle_side_post = $("<a>")
	      .attr("id", "btn-toggle-side-post")
	      .html("&raquo;")
	      .click( function(evt) {
	        
	        if ( $regionmain.hasClass('col-md-12') ) {
	          // The main region is currently full width so ...
	          // set it to be normal again
	          $regionmain.removeClass('col-md-12').addClass('col-md-8');
	          $sidepost.show();
	          $btn_toggle_side_post.html("&raquo;");
	        } else {
	          $regionmain.removeClass('col-md-8').addClass('col-md-12');
	          $sidepost.hide();
	          $btn_toggle_side_post.html("&laquo;");
	        }
	      
	      });

	    $btn_toggle_side_post.appendTo( $regionmain.parent() );
	  }


	  // dirty hack for modchooser
	$(".aaronclick").click(function(evt) {
		evt.preventDefault();
		console.log("click");
		$("#section-0 .section-modchooser-link a, #section-0 .section-modchooser-link span").click();
	});
  
}(jQuery);