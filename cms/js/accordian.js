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

    trig.next('ul.submenu')
    .not(':visible')
    .slideDown(function() {
      trig.addClass('selected');

    });

  }); // End of accordian fn

  // Find current page and
  function currentPage() {

    var urlPath = window.location.href;
    var submenu = "";
    var item = document.querySelectorAll('.submenu li a');

    // removes global super array from href in header (kinda)
    if(urlPath.indexOf('?') > 0 ) {

      var kvs = urlPath.indexOf('?');
      urlPath = urlPath.slice(0, kvs);

    } // End of if statement

    for (var i = 0; i < item.length; i++ ) {

      // Compare header href to anchor href
      if (item[i] == urlPath) {

        item[i].style.backgroundColor = '#a7bbd6';

        var li = item[i].parentNode;
        submenu = li.parentNode;

        submenu.style.display = 'block';

        return submenu;

      } // End of if statement

    } // End of for loop

  } // End of currentpage fn

  // TODO: + / - for open and closing fn
  function plusMinus() {
    
  }

}); // End of jquery doc ready
