script src: "/socket.io/socket.io.js"
script src: "/javascripts/index.js"

section role: "viewport", ->
  header "Remote Debug Console <small>jsRDC v0.1 — Free Albatros</small>"

footer id: "statusbar", ->
  span "Status: "
  span class: "status disconnected", "Disconnected"
  span class: "separator"
  span "Last message on: "
  span class: "last_message", "none"