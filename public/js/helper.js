function ajaxForm(formItems) {
  var form = new FormData();
  formItems.forEach(formItem => {
    form.append(formItem[0], formItem[1]);
  });
  return form;
}

/**
 *
 * @param {*} url route
 * @param {*} method POST or GET
 * @param {*} functionsOnSuccess Array of functions that should be called after ajax
 * @param {*} form for POST request
 */
function ajax(url, method, functionsOnSuccess, form) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  })

  if (typeof form === 'undefined') {
    form = new FormData;
  }

  if (typeof functionsOnSuccess === 'undefined') {
    functionsOnSuccess = [];
  }

  $.ajax({
    url: url,
    type: method,
    async: true,
    data: form,
    processData: false,
    contentType: false,
    dataType: 'json',
    error: function(xhr, textStatus, error) {
      console.log(xhr.responseText);
      console.log(xhr.statusText);
      console.log(textStatus);
      console.log(error);
    },
    success: function(response) {
      for (var j = 0; j < functionsOnSuccess.length; j++) {
        for (var i = 0; i < functionsOnSuccess[j][1].length; i++) {
          if (functionsOnSuccess[j][1][i] == "response") {
            functionsOnSuccess[j][1][i] = response;
          }
        }
        functionsOnSuccess[j][0].apply(this, functionsOnSuccess[j][1]);
      }
    }
  });
}

function removeAcceptedConnection(userId) {
  var functionsOnSuccess = [
    [getAcceptedConnections, ['response']]
  ];

  ajax('/accepted-connections/' + userId, 'DELETE', functionsOnSuccess);
}

function deleteConnectionRequest(userId) {
  var functionsOnSuccess = [
    [getOutgoingConnections, ['response']]
  ];

  ajax('/outgoing-connections/' + userId, 'DELETE', functionsOnSuccess);
}

function acceptConnectionRequest(userId) {
  var form = ajaxForm([
    ['user_id', userId],
  ]);

  var functionsOnSuccess = [
    [getIncomingConnections, ['response']]
  ];

  ajax('/incoming-connections', 'POST', functionsOnSuccess, form);
}

function sendConnectionRequest(userId) {
  var form = ajaxForm([
    ['user_id', userId],
  ]);

  var functionsOnSuccess = [
    [getSuggestedConnections, ['response']]
  ];

  ajax('/suggested-connections', 'POST', functionsOnSuccess, form);
}

function getAcceptedConnections() {
  $('#connections_in_common_skeleton').removeClass('d-none');
  $('#content').addClass('d-none');

  var functionsOnSuccess = [
    [connectionsOnSuccess, ['response']]
  ];

  ajax('/accepted-connections', 'GET', functionsOnSuccess);
}

function getIncomingConnections() {
    $('#connections_in_common_skeleton').removeClass('d-none');
    $('#content').addClass('d-none');

    var functionsOnSuccess = [
        [connectionsOnSuccess, ['response']]
    ];

    ajax('/incoming-connections', 'GET', functionsOnSuccess);
}

function getOutgoingConnections() {
    $('#connections_in_common_skeleton').removeClass('d-none');
    $('#content').addClass('d-none');

    var functionsOnSuccess = [
        [connectionsOnSuccess, ['response']]
    ];

    ajax('/outgoing-connections', 'GET', functionsOnSuccess);
}

function getSuggestedConnections() {
  $('#connections_in_common_skeleton').removeClass('d-none');
  $('#content').addClass('d-none');

  var functionsOnSuccess = [
    [connectionsOnSuccess, ['response']]
  ];

  ajax('/suggested-connections', 'GET', functionsOnSuccess);
}

function connectionsOnSuccess(response) {
    $('#connections_in_common_skeleton').addClass('d-none');
    $('#content').removeClass('d-none').html(response['content']);
}
