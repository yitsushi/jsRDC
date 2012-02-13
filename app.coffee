express = require("express")
routes = require("./routes")
coffeekup = require("coffeekup")


app = module.exports = express.createServer()
app.configure ->
  app.set "views", __dirname + "/views"
  # app.set "view engine", "jade"
  app.set "view engine", "coffee"
  app.register ".coffee", coffeekup.adapters.express
  app.use express.bodyParser()
  app.use express.methodOverride()
  app.use app.router
  app.use express.static(__dirname + "/public")

app.configure "development", ->
  app.use express.errorHandler(
    dumpExceptions: true
    showStack: true
  )

app.configure "production", ->
  app.use express.errorHandler()

app.get "/", routes.root

io = require('socket.io').listen(app)

socket_cache = []

io.sockets.on "connection", (socket) ->
  socket_cache.push(socket)
  socket.on 'disconnect', () ->
    for s, i in socket_cache
      socket_cache[i] = null if socket is s

send_broadcast = (cmd, data) ->
  s?.emit?("message", {cmd: cmd, args: data} ) for s in socket_cache
  
app.get "/msg", (req, res) ->
  console.log req
  send_broadcast req.query['cmd'], req.query['data']
  res.writeHead(200, {'Content-Type': 'text/plain'}); res.end('Ok\n');

app.listen 3000
console.log "Express server listening on port %d in %s mode", app.address().port, app.settings.env
