var error_handler, socket_handler, socket, commands = {},
    is_connected = false;

commands = {
  log: function(data) {
    var div = document.createElement('div');
    div.innerHTML = data;
    div.className = 'line';
    document.querySelector('section[role="viewport"]').appendChild(div);
  },
  disconnect: function() {
    var status = document.querySelector('#statusbar .status');
    status.innerHTML = 'Disconnected';
    status.className = 'status disconnected';
  },
  connected: function() {
    var status = document.querySelector('#statusbar .status');
    status.innerHTML = 'Connected';
    status.className = 'status connected';
  }
}

error_handler = function(e) {
  return typeof console !== "undefined" && console !== null ? console.log(e) : void 0;
};

socket_handler = function(data) {
  var _status = document.querySelector('#statusbar .last_message');
  _status.innerHTML = new Date
  typeof console !== "undefined" && console !== null ? console.log(data) : void 0;
  try {
    if (commands[data.cmd]) {
      commands[data.cmd](data.args);
    }
    return _status.setAttribute('rel', "success");
  } catch (e) {
    _status.setAttribute('rel', "error");
    return error_handler(e);
  }
};

var socket = io.connect('http://localhost:3000');
socket.on('message', socket_handler);
socket.on('disconnect', commands.disconnect);
socket.on('connect', commands.connected);