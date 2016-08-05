// Contains code for modal windows

//var randomEl = modal.approve('the bees kness', '<div>');
var modalWindow = {
  approve: function(ucon, utext, done){
    mainModal(ucon, utext, 'approve', done);
  },
  alert: function(ucon, utext){
    mainModal(ucon, utext, 'alert');
  },
  warning: function(ucon, utext){
    mainModal(ucon, utext, 'warning');
  },
  question: function(ucon, utext){
    mainModal(ucon, utext, 'warning');
  }
}

function createObj() {
  return {
    type: null,
    text: null,
    parent: null,
    frame: null
  }
}

function mainModal(ucon, utext, utype, done){
  var modal = createObj();

  modal.type = utype;
  modal.text = utext;
  modal.parent = document.querySelector(ucon);

  var trigger = render(modal, done);

  return modal;
}

// Creates modal windows with styling classes specific to the type
function render(modal, done){

  renderShell(modal);

  switch(modal.type){
    // Confirmation Modal Window
    case 'approve':

    return renderApprovalModal(modal, done);

    break;

    // Warning modal window
    case 'warning':

    break;

    // Alert modal window
    case 'alert':

    break;
  }
}

// create standard shell all modals will need
function renderShell(modal){

  var parent = modal.parent;

  //create shell
  var shell = newElement('div', parent);

  modal.frame = shell;
  var msg = newElement('p', shell);
  addText(modal.text, msg);

  shell.classList.add('modal-large');

}

// To render specific elements for approval type modal windows
function renderApprovalModal(modal, done){

  // Make modal window visible
  modal.frame.style.display = 'block';

  // assigning the confirm class to the modal window
  modal.frame.classList.add('confirm');

  // Creating button set to modal
  var btnSet = newElement('div', modal.frame);
  btnSet.classList.add('button-set');

  // Proceed button
  var btn1 = newElement('button', btnSet);
  addText('Yes', btn1);

  // Cancel button
  var btn2 = newElement('button', btnSet);
  btn2.classList.add('danger-btn');
  addText('No', btn2);


  // Adding events to modal window buttons
  btn1.addEventListener('click', function() {

    //callback function that returns a result of true
    done(true);

  });

  btn2.addEventListener('click', function() {

    // Callback function that returns a result of false
    done(false);

  });

  return { btn1, btn2 };

}


// Generic functions
function newElement(el, parent) {
  el = document.createElement(el);
  parent.appendChild(el);
  return el;
}

function addText(text, parent) {
  text = document.createTextNode(text);
  parent.appendChild(text);
  return text;
}

function attach(child, parent){
  var lastChild = parent.lastChild;
  parent.insertBefore(child, lastChild);
}
