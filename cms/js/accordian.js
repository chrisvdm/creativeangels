$(document).ready(function() {

  // menu accordian
  $('ul.menu>li').click(function(){

    var trig = $(this);
    $('ul.submenu').not(':hidden').slideUp(function(){

      $('ul.menu>li').removeClass('selected');
    });

    trig.next('ul.submenu').not(':visible').slideDown(function(){
      trig.addClass('selected');
    });
  })


});
