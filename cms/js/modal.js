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
      type: null,
      callback: null
    };
  },

  // Initialises modal render
  init: function(text, parent, type, callback){

    var modal = mw.createObj();

    modal.text = text;
    modal.parent = parent;
    modal.type = type;
    modal.callback = callback;

    controller(modal);
  },

  // Determines how to render the modal based on type
  controller: function(modal) {

    switch(modal.type) {

      case 'confirm':
      return mw.renderConfirmDialog(modal);
      break;

      case 'delete':
      return mw.renderDeleteDialog(modal);
      break;

      case 'delToast':
      return mw.renderDelToast(modal);
      break;

      case 'sucToast':
      return mw.renderSucToast(modal);
      break;

    }
  },

  // Creates overlay for dialogs
  renderOverlay: function(modal) {

  },

  // TODO: Renders dialog shell
  renderDialogShell: function() {
    return dialog;
  },

  // TODO: Renders toast shell
  renderToastShell: function() {
    return toast;
  },

  // TODO: Renders confirm dialog
  renderConfirmDialog: function(modal) {

  },

  // TODO: Renders confirm dialog
  renderDeleteDialog: function(modal) {

  },

  // TODO: Renders confirm dialog
  renderDeleteToast: function(modal) {

  },

  // TODO: Renders confirm dialog
  renderSucToast: function(modal) {

  },

  // TODO: Destroys dialog and toast
  kill: function(modal) {

  }
}
