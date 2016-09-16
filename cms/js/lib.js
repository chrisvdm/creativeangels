// Custom js library for often used functions without having to load jquery

// ---------------------- DOM MANIPULATION -------------------------------
function newEl(type, parent) {
  var el = document.createElement(type);
  parent.appendChild(el);

  return el;
}

function addText(text, el) {
  text = document.createTextNode(text);
  el.appendChild(text);

  return el;
}

// Take up the remaining viewport height
function fillVH(el) {

  // screenheight - el.offset
  var vH = window.innerHeight;
  var topH = el.offsetTop;

  var elH = vH - topH;

  // set height on el
  el.style.height = elH + 'px';

  window.addEventListener('resize', function(){
    fillVH(el)
  });
}


// --------------------- ANIMATION FUNCTIONS ------------------------------
function unfade(el) {
    var op = 0.1;  // initial opacity
    el.style.display = 'block';
    var timer = setInterval(function () {
        if (op >= 1){
            clearInterval(timer);
        }
        el.style.opacity = op;
        el.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op += op * 0.1;
    }, 10);
}

function fade(el) {
    var op = 1;  // initial opacity
    var timer = setInterval(function () {
        if (op <= 0.1){
            clearInterval(timer);
            el.style.display = 'none';
        }
        el.style.opacity = op;
        el.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op -= op * 0.1;
    }, 50);
}

function _(el){
  return document.querySelector(el);
}
