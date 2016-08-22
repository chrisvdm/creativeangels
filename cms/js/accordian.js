$(document).ready(function() {

  var loc = currentPage();

  // menu accordian
  $('ul.menu>li').click(function(){

    var trig = $(this);
    $('ul.submenu')
      .not(':hidden')
      .not(loc)
      .slideUp(function(){

        $('ul.menu>li').removeClass('selected');
    });

    trig.next('ul.submenu').not(':visible').slideDown(function(){
      trig.addClass('selected');
    });
  })



  function currentPage() {
    var urlPath = window.location.href;
    var submenu = "";
    var item = document.querySelectorAll('.submenu li a');

    for (  var i = 0; i < item.length; i++ ) {
      if (item[i] == urlPath) {
        item[i].style.backgroundColor = '#a7bbd6';
        var li = item[i].parentNode;
        submenu = li.parentNode;
      }
    }

    submenu.style.display = 'block';

    return submenu;

  }

});
