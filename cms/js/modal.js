// Contains code for modal windows

// ------------------------------ MODAL WINDOW OBJECT -------------------------
var modalWindow = {
  approve: function(parent, text, done){
    this.fn.init(parent, text, 'approve', 'l', done);
  },
  alert: function(parent, text){
    this.fn.init(parent, text, 'alert', 'l');
  },
  warning: function(parent, text,l){
    this.fn.init(parent, text, 'warning', 'l');
  },
  question: function(parent, text){
    this.fn.init(parent, text, 'warning', 'l');
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

          return modalWindow.fn.renderApprovalModal(modal, done);

          break;

          // Warning modal window
          case 'warning':

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

      modal.frame = shell;
      var msg = newElement('p', shell);
      addText(modal.text, msg);

      // determines size of the shell
      if(modal.size === 'l'){
        // large modal in center of parent
        shell.classList.add('modal-large');
      } else if (modal.size === 's') {
        // small notofication in corner of parent
        shell.classList.add('modal-small');
      }
    }, // end renderShell

    // -----------------FUNCTIONS FOR DIFFERENT TYPES OF MODALS ----------------

    // Approve type modal
    renderApprovalModal: function(modal, done) {

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

        modalWindow.fn.killModal(modal);

        //callback function that returns a result of true
        done(true);

      });

      btn2.addEventListener('click', function() {
        modalWindow.fn.killModal(modal);

        // Callback function that returns a result of false
        done(false);

      });

      return { btn1, btn2 };

    },
    killModal: function(modal) {
      var parent  = modal.parent;
      var child = modal.frame;
      parent.removeChild(child);
    }
  }
}

// --------------------------- GENERIC FUNCTIONS ----------------------------

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
