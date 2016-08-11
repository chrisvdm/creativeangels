// Contains code for modal windows

// ------------------------------ MODAL WINDOW OBJECT -------------------------
var modalWindow = {
  approve: function(parent, text, done){
    this.fn.init(parent, text, 'approve', 'l', done);
  },
  alert: function(parent, text){
    this.fn.init(parent, text, 'alert', 'l');
  },
  warning: function(parent, text, done){
    this.fn.init(parent, text, 'warning', 'l', done);
  },
  question: function(parent, text, done){
    this.fn.init(parent, text, 'warning', 'l', done);
  },
  notificationWarning: function(parent, text){
    this.fn.init(parent, text, 'warning', 's');
  },
  notificationSuccess: function(parent, text){
    this.fn.init(parent, text, 'warning', 's');
  },

  // ----------------------- FUNCTIONS FOR MODAL WINDOWS ---------------------
  fn: {

    // Initiates modal window
    init: function(parent, text, type, size, done) {

      var modal = modalWindow.fn.createObj();

      modal.type = type;
      modal.text = text;
      modal.parent = document.querySelector(parent);
      modal.size = size;

      var trigger = modalWindow.fn.render(modal, done);

      return modal;
    },
    // Creates modal object
    createObj: function(){
      return {
        type: null,
        text: null,
        parent: null,
        frame: null,
        size: null
      };
    },
    //---------------------------- RENDER FUNCTIONS ----------------------------

    // Renders modal Window
    render: function(modal, done){

        modalWindow.fn.renderShell(modal);

        switch(modal.type){

          // Confirmation Modal Window
          case 'approve':
          return modalWindow.fn.renderApproveModal(modal, done);
          break;

          // Warning modal window
          case 'warning':
          return modalWindow.fn.renderWarningModal(modal, done);
          break;

          // Question modal Window similiar to 'prompt'
          case 'question':
          return modalWindow.fn.renderQuestionModal(modal, done);
          break;

          // Alert modal window
          case 'alert':

          break;
        } // end switch
    },

    // creates generic shell for modal windows
    renderShell: function(modal) {
      var parent = modal.parent;

      //create shell
      var shell = newElement('div', parent);
      shell.classList.add('mw-modal');

      modal.frame = shell;
      var msg = newElement('p', shell);
      addText(modal.text, msg);

      // determines size of the shell
      if(modal.size === 'l'){
        // large modal in center of parent
        shell.classList.add('mw-large');
      } else if (modal.size === 's') {
        // small notofication in corner of parent
        shell.classList.add('mw-small');
      }
    }, // end renderShell

    // -----------------FUNCTIONS FOR DIFFERENT TYPES OF MODALS ----------------

    // Approve type modal
    renderApproveModal: function(modal, done) {

      // assigning the confirm class to the modal window
      modal.frame.classList.add('mw-confirm');

      // Render layout for closed questions (yes/no questions)
      modal.overlay = modalWindow.fn.renderOverlay(modal);
      modal.overlay.appendChild(modal.frame);

      // Creating button set to modal
      var btnSet = newElement('div', modal.frame);
      btnSet.classList.add('mw-button-set');

      // Proceed button
      var btn1 = newElement('button', btnSet);
      addText('Yes', btn1);

      // Cancel button
      var btn2 = newElement('button', btnSet);
      btn2.classList.add('danger-btn');
      addText('No', btn2);


      // Adding events to modal window buttons
      btn1.addEventListener('click', function() {

        modalWindow.fn.killModal(modal.overlay, modal.parent);

        //callback function that returns a result of true
        done(true);

      });

      btn2.addEventListener('click', function() {
        modalWindow.fn.killModal(modal.overlay, modal.parent);

        // Callback function that returns a result of false
        done(false);

      });

      return { btn1, btn2 };
    },
    renderWarningModal: function(modal, done){
      // assigning the confirm class to the modal window
      modal.frame.classList.add('mw-warning');

      // Render layout for closed questions (yes/no questions)
      modal.overlay = modalWindow.fn.renderOverlay(modal);
      modal.overlay.appendChild(modal.frame);

      // Creating button set to modal
      var btnSet = newElement('div', modal.frame);
      btnSet.classList.add('mw-button-set');

      // Proceed button
      var btn1 = newElement('button', btnSet);
      btn1.classList.add('danger-btn');
      addText('Yes', btn1);

      // Cancel button
      var btn2 = newElement('button', btnSet);
      addText('No', btn2);

      // Adding events to modal window buttons
      btn1.addEventListener('click', function() {

        modalWindow.fn.killModal(modal.overlay, modal.parent);

        //callback function that returns a result of true
        done(true);

      });

      btn2.addEventListener('click', function() {
        modalWindow.fn.killModal(modal.overlay, modal.parent);

        // Callback function that returns a result of false
        done(false);

      });

      return { btn1, btn2 };
    },
    renderQuestionModal: function() {

      
    },
    renderOverlay: function(modal){

      // create overlay element
      var el = newElement('div', modal.parent);
      el.classList.add('mw-overlay');

      setFullHeight(el);

      return el;
    },
    killModal: function(child, parent) {
      parent.removeChild(child);
    }
  } // end of fn object
} // end of modalWindow object

// --------------------------- GENERIC FUNCTIONS ----------------------------

// sets the height of an element dynamically
function setFullHeight(el) {
  // set height
  var topPos = el.offsetTop;
  var viewportHeight = window.innerHeight;
  var overlayHeight = viewportHeight - topPos;

  el.style.height = overlayHeight + 'px';

  window.addEventListener('resize', function(){
    setFullHeight(el);
  });

}

// creates a new element and appends it to a parent
function newElement(el, parent) {
  el = document.createElement(el);
  parent.appendChild(el);
  return el;
}

// adds a textnode to a parent element
function addText(text, parent) {
  text = document.createTextNode(text);
  parent.appendChild(text);
  return text;
}
