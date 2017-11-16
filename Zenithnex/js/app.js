


/****
* MAIN NAVIGATION
*/

$(document).ready(function($){

  // Add class .active to current link - AJAX Mode off
  // $.navigation.find('a').each(function(){


  //   if ($($(this))[0].href==cUrl) {
  //     $(this).addClass('active');

  //     $(this).parents('ul').add(this).each(function(){
  //       $(this).parent().addClass('open');
  //     });
  //   }
  // });

  // Dropdown Menu
  // $.navigation.on('click', 'a', function(e){

  //   if ($.ajaxLoad) {
  //     e.preventDefault();
  //   }

  //   if ($(this).hasClass('nav-dropdown-toggle')) {
  //     $(this).parent().toggleClass('open');
  //     resizeBroadcast();
  //   }
  // });

  function resizeBroadcast() {

    var timesRun = 0;
    var interval = setInterval(function(){
      timesRun += 1;
      if(timesRun === 5){
        clearInterval(interval);
      }
      window.dispatchEvent(new Event('resize'));
    }, 62.5);
  }

  /* ---------- Main Menu Open/Close, Min/Full ---------- */
  $('.navbar-toggler').click(function(){

    if ($(this).hasClass('sidebar-toggler')) {
      $('body').toggleClass('sidebar-hidden');
      resizeBroadcast();
    }

    if ($(this).hasClass('sidebar-minimizer')) {
      $('body').toggleClass('sidebar-minimized');
      resizeBroadcast();
    }

    if ($(this).hasClass('aside-menu-toggler')) {
      $('body').toggleClass('aside-menu-hidden');
      resizeBroadcast();
    }

    if ($(this).hasClass('mobile-sidebar-toggler')) {
      $('body').toggleClass('sidebar-mobile-show');
      resizeBroadcast();
    }

  });

  $('.sidebar-close').click(function(){
    $('body').toggleClass('sidebar-opened').parent().toggleClass('sidebar-opened');
  });

  /* ---------- Disable moving to top ---------- */
  $('a[href="#"][data-top!=true]').click(function(e){
    e.preventDefault();
  });

});

