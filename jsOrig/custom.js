
/* Recent posts carousel */


$(window).load(function(){
  $('.rps-carousel').carouFredSel({
    responsive: true,
    width: '100%',
    pauseOnHover : true,
    auto : false,
    circular  : true,
    infinite  : false,
    prev : {
      button  : "#car_prev",
      key   : "left",
    },
    next : {
      button  : "#car_next",
      key   : "right",
    },
    swipe: {
      onMouse: true,
      onTouch: true
    },
    items: {
      visible: {
        min: 1,
        max: 3
      }
    }
  }); 
});

/* Support */

$("#slist a").click(function(e){
   e.preventDefault();
   $(this).next('p').toggle(200);
});

/* Navigation */

$(document).ready(function(){

  $(window).resize(function()
  {
    if($(window).width() >= 765){
      $(".sidebar #nav").slideDown(350);
    }
    else{
      $(".sidebar #nav").slideUp(350); 
    }
  });


  $("#nav > li > a").on('click',function(e){
      if($(this).parent().hasClass("has_sub")) {
        e.preventDefault();
      }   

      if(!$(this).hasClass("subdrop")) {
        // hide any open menus and remove all other classes
        $("#nav li ul").slideUp(350);
        $("#nav li a").removeClass("subdrop");
        
        // open our new menu and add the open class
        $(this).next("ul").slideDown(350);
        $(this).addClass("subdrop");
      }
      
      else if($(this).hasClass("subdrop")) {
        $(this).removeClass("subdrop");
        $(this).next("ul").slideUp(350);
      } 
      
  });
});

$(document).ready(function(){
  $(".sidebar-dropdown a").on('click',function(e){
      e.preventDefault();

      if(!$(this).hasClass("open")) {
        // hide any open menus and remove all other classes
        $(".sidebar #nav").slideUp(350);
        $(".sidebar-dropdown a").removeClass("open");
        
        // open our new menu and add the open class
        $(".sidebar #nav").slideDown(350);
        $(this).addClass("open");
      }
      
      else if($(this).hasClass("open")) {
        $(this).removeClass("open");
        $(".sidebar #nav").slideUp(350);
      }
  });

});


/* Home widget */


$('.slide-box-button').click(function() {
    var $slidebtn=$(this);
    var $slidebox=$(this).parent().parent();
    if($slidebox.css('right')=="-252px"){
      $slidebox.animate({
        right:0
      },500);
      $slidebtn.children("i").removeClass().addClass("icon-chevron-right");
    }
    else{
      $slidebox.animate({
        right:-252
      },500);
      $slidebtn.children("i").removeClass().addClass("icon-chevron-left");
    }
}); 

/* Contact slider */

$(document).ready(function(){
  $(".cslider-btn").on('click',function(e){
      e.preventDefault();

      if(!$(this).prev().hasClass("open")) {
        $(".cslider").slideDown(300);
        $(".cslider").addClass("open");
        $(this).children("i").removeClass().addClass("icon-angle-up");
      }
      
      else if($(this).prev().hasClass("open")) {
        $(".cslider").removeClass("open");
        $(".cslider").slideUp(300);
        $(this).children("i").removeClass().addClass("icon-angle-down");
      }
  });

});

/* Tab */

$('#myTab a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
})

/* Flex Slider */

$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "fade",
    controlNav: false,
    pauseOnHover: true,
    slideshowSpeed: 5000,
    animationSpeed: 2000
  });
});


/* Coming soon page twitter */

jQuery(function($){
   $(".ctweet").tweet({
      username: "ashokramesh90",
      join_text: "auto",
      avatar_size: 0,
      count: 1,
      auto_join_text_default: "we said,",
      auto_join_text_ed: "we",
      auto_join_text_ing: "we were",
      auto_join_text_reply: "we replied to",
      auto_join_text_url: "we were checking out",
      loading_text: "loading tweets...",
      template: "{text}"
   });
}); 

/* prettyPhoto Gallery */

jQuery(".prettyphoto").prettyPhoto({
overlay_gallery: false, social_tools: false
});


/* Isotype */

// cache container
var $container = $('#portfolio');
// initialize isotope
$container.isotope({
  // options...
});

// filter items when filter link is clicked
$('#filters a').click(function(){
  var selector = $(this).attr('data-filter');
  $container.isotope({ filter: selector });
  return false;
});

/* Scroll to Top */

$(document).ready(function(){
  $(".totop").hide();

  $(function(){
    $(window).scroll(function(){
      if ($(this).scrollTop()>600)
      {
        $('.totop').slideDown();
      } 
      else
      {
        $('.totop').slideUp();
      }
    });

    $('.totop a').click(function (e) {
      e.preventDefault();
      $('body,html').animate({scrollTop: 0}, 500);
    });

  });
});
