var skeletonId = 'skeleton';
var contentId = 'content';
var skipCounter = 0;
var takeAmount = 10;

function getRequests(mode) {
    if (mode === 'sent') {
        getOutgoingConnections()
    } else {
        getIncomingConnections()
    }
}

function getMoreRequests(mode) {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getConnections() {
  getAcceptedConnections()
}

function getMoreConnections() {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getConnectionsInCommon(userId, connectionId) {
  // your code here...
}

function getMoreConnectionsInCommon(userId, connectionId) {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getSuggestions() {
    getSuggestedConnections()
}

function getMoreSuggestions() {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function sendRequest(userId) {
  sendConnectionRequest(userId)
}

function deleteRequest(userId) {
  deleteConnectionRequest(userId)
}

function acceptRequest(userId) {
  acceptConnectionRequest(userId)
}

function removeConnection(userId) {
  removeAcceptedConnection(userId)
}

$(function () {
  getSuggestions();
});
