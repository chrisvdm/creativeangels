main();

function createInitialData() {
  return {
    valid: true,
    name: '',
    surname: '',
    email: '',
    mobile: ''
  }
}

// changes the data relative to actions
function reduce(data, action) {
  switch (action.type) {
    case 'CHANGE_NAME':
      return $.extend({}, data, {
        name: action.value
      });

    case 'INVALID':
      return $.extend({}, data, {
        valid: false
      });
    }
}

// draws DOM from data
function render(data, dispatch) {
  $('input[name="txtName"]')
    .off()
    .val(data.name)
    .toggleClass('error-bg', data.name === '' && !data.valid);

  $('input[name="txtName"]')
    .off()
    .keyup(function() {
      changeName(dispatch, $(this).val());
    });

  $('input[name="btnAddNew"]')
    .off()
    .click(function() {
      submit(dispatch, data);
    });
}

function main() {
  var data = createInitialData();

  // tells the application that an action has happened which
  // will change the data
  function dispatch(action) {
    var newData = reduce(data, action);
    render(newData, dispatch);
  }

  render(data, dispatch);
}

function isValid(data) {
  return data.name;
}

// actually submits the form
function doSubmit() {
  $('#form').submit();
}

// ACTIONS (Where stuff is happening)
// tells(dispatch) app that a name change has happened
function changeName(dispatch, value) {
  var nameAction = {
    type: 'CHANGE_NAME',
    value: value
  };

  dispatch(nameAction);
}

function submit(dispatch, data) {
  if (isValid(data)) {
    doSubmit();
  }
  else {
    dispatch({
      type: 'INVALID'
    });
  }
}
