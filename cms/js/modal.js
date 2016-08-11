var mw = {
  // mw UI
  confirm: function(text, parent, done) {
    mw.init(text, parent, 'confirm', done );
  },
  delete: function(text, parent, done) {
    mw.init(text, parent, 'delete', done );
  },
  deleteToast: function(text, parent) {
    mw.init(text, parent, 'delToast');
  },
  successToast: function(text, parent) {
    mw.init(text, parent, 'sucToast');
  },

  // Creates object to store modal variables
  createObj: function() {
    return {
      shell: null,
      parent: null,
      type: null
    };
  },

  // Initialises modal render
  init: function(text, parent, type, done){

    var modal = mw.createObj();

    modal.text = text;
    modal.parent = document.querySelector(parent);
    modal.type = type;

    mw.controller(modal, done);
  },

  // Determines how to render the modal based on type
  controller: function(modal, done) {

    switch(modal.type) {

      case 'confirm':
      return mw.renderConfirmDialog(modal, done);
      break;

      case 'delete':
      return mw.renderDeleteDialog(modal, done);
      break;

      case 'delToast':
      return mw.renderDeleteToast(modal);
      break;

      case 'sucToast':
      return mw.renderSucToast(modal);
      break;

    }
  },

  // Creates overlay for dialogs
  renderOverlay: function(parent) {
    var overlay = newEl('div', parent);
    overlay.classList.add('mw-overlay');
    fillVH(overlay);

    return overlay;
  },

  // Renders dialog shell and returns dialog buttons
  renderDialogShell: function(modal) {

    // create overlay
    var overlay = mw.renderOverlay(modal.parent);
    modal.overlay = overlay;

    var shell = newEl('div', overlay);
    shell.classList.add('mw-modal', 'mw-large');

    // Render dialog header
    var heading = newEl('header', shell);
    modal.header = heading;
    var h3 = newEl('h3', heading);
    addText(modal.type, h3);

    // Render dialog body
    var body = newEl('div', shell);

    // Add message to body
    var txt = newEl('p', body);
    addText(modal.text, txt);

    return shell;
  },

  // Create button set
  renderButtonSet: function(shell) {

    var btnSet = newEl('div', shell);
    btnSet.classList.add('mw-button-set');
    var btn1 = newEl('button', btnSet);
    var btn2 = newEl('button', btnSet);

    return [btn1, btn2];
  },

  // Renders toast shell
  renderToastShell: function(modal) {

    var toast = newEl('div', modal.parent);
    toast.classList.add('mw-modal', 'mw-small');

    // Add message to toast
    var txt = newEl('p', toast);
    addText(modal.text, txt);

    return toast;
  },

  // Renders confirm dialog
  renderConfirmDialog: function(modal, done) {

    modal.shell = mw.renderDialogShell(modal);
    modal.header.classList.add('mw-confirm');

    var buttons = mw.renderButtonSet(modal.shell);

    // Customising button set
    buttons[0].innerHTML = 'Cancel';
    buttons[0].addEventListener('click', function() {
      done(false);
      mw.kill(modal.overlay, modal);
    });

    buttons[1].innerHTML = 'Okay';
    buttons[1].classList.add('mw-proceed');
    buttons[1].addEventListener('click', function() {
      done(true);
      mw.kill(modal.overlay, modal);
    });

    return modal;

  },

  // Renders confirm dialog
  renderDeleteDialog: function(modal, done) {

    modal.shell = mw.renderDialogShell(modal);
    modal.header.classList.add('mw-delete');

    var buttons = mw.renderButtonSet(modal.shell);

    // Customising button set
    buttons[0].innerHTML = 'Cancel';
    buttons[0].addEventListener('click', function() {
      done(false);
      mw.kill(modal.overlay, modal);
    });

    buttons[1].innerHTML = 'Delete';
    buttons[1].classList.add('danger-btn');
    buttons[1].addEventListener('click', function() {
      done(true);
      mw.kill(modal.overlay, modal);
    });

    return modal;

  },

  // Renders delete toast
  renderDeleteToast: function(modal) {

    modal.shell = mw.renderToastShell(modal);

    modal.shell.classList.add('mw-delete');

    unfade(modal.shell);

    setTimeout(function(){
      fade(modal.shell);
    }, 4000);

  },

  // Renders success toast
  renderSucToast: function(modal) {

    modal.shell = mw.renderToastShell(modal);

    modal.shell.classList.add('mw-success');

    unfade(modal.shell);

    setTimeout(function(){
      fade(modal.shell);
    }, 4000);

  },

  // TODO: Destroys dialog and toast
  kill: function(child, modal) {
    parent = modal.parent;
    parent.removeChild(child);
  }
}
