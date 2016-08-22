// Fetches an array of elements that match the argument
function _all(el) {
  return document.querySelectorAll(el);
}

// Fetches the first instance of an element that matches the argument
function _(el) {
  return document.querySelector(el);
}

function minimiseNav() {
  // Change minimised logo
  _('.site-logo').style.display = 'none';
  _('.mini-logo').classList.remove('hide');

  // Removes 'menu' from hamburger
  _('.menu-words').classList.add('hide');
  _('.mobile-menu').classList.add('ham-move-up');

  // Displays nav on tablet
  _('.wide-nav ul').classList.add('inline');

  // Removes name
  _('.h1-wrapper').classList.add('h1-mini');
  _('.h1-wrapper h1').classList.add('hide');
}

function maximiseNav() {

  // Change minimised logo

  if (window.innerWidth > 320) {
    _('.site-logo').style.display = 'inline-block';
  }

  _('.mini-logo').classList.add('hide');

  // Displays 'menu' from hamburger
  _('.mobile-menu').classList.remove('ham-move-up');
  _('.menu-words').classList.remove('hide');

  // Removes nav on tablet
  _('.wide-nav ul').classList.remove('inline');

  // Shows name
  _('.h1-wrapper').classList.remove('h1-mini');
  _('.h1-wrapper h1').classList.remove('hide');

}

function renderNav() {

  // checks to see how far down the page was scrolled
  if(document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {

    // Shrinks the header
    minimiseNav();

  } else if (document.body.scrollTop < 100 || document.documentElement.scrollTop < 100) {

    // Maximises the header
    maximiseNav();

  }
}

function currentPage() {

  var urlPath = window.location.href;
  var item = _all('.wide-nav li a');

  for (  var i = 0; i < item.length; i++ ) {
    if (item[i] == urlPath) {
      item[i].classList.add('current-page');
    }
  }

}

function getConH(el) {

  var h =  el.parentNode.offsetHeight;

  return h;

}

function sidebarHeight() {

  // Only set height of footer on screens wider than 980px to that of its container. Else sts height to 'auto'
  if (window.innerWidth > 980 || document.documentElement.clientWidth > 980 || document.body.clientWidth > 980) {

    _('.sidebar').style.height = _('.sidebar').parentElement.offsetHeight +'px';

  } else {

    _('.sidebar').style.height = 'auto';

  }
}

function positionHam(win) {

  var pos = _('header').offsetHeight;
  var height = win - pos;

  // This works
  _('.mobile-nav').style.top = pos + 'px';
  _('.mobile-nav').style.height = height + 'px';
}

function ham(state) {

  if(!state) {

    // position on document + header height
    positionHam();

    // TODO: click on hamburger to close

    _('.mobile-nav').style.left = '0';

    return true;

  } else {

    _('.mobile-nav').style.left = '100%';

    return false;
  }

}

function pageSetup() {

  var state = false;



  //hamburger code
  _('.mobile-menu').onclick = function() {

   state = ham(state);

  }

  // changes the header for screen width smaller than 960px
  window.onscroll = function() {

    // maximises and minimises header according to page position
    renderNav();
  };

  // Fires sidebarHeight function
  window.onresize = function() {

    sidebarHeight();

  }

  // container minHeight
  var conH = window.innerHeight - _('footer').offsetHeight;
  _('.content-wrapper').style.minHeight = conH + 'px';

  // Sets sidebar height
  sidebarHeight();

  // Sets styling to anchor tag that matches the page url
  currentPage();
}

pageSetup();
