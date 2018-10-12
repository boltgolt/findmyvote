const app = require('express')();
const http = require('http').Server(app);
const port = 80

const io = require('socket.io')(http);

let soc = false

function forward(req, res) {
	if (soc === false) {
		res.status(503)
		res.send("Booting")
		return
	}

	var id = "asd" + Math.random()

	let url = req.originalUrl

	var match = /\/([\d\w]{8})/g.exec(url);

	if (match) {
		url = "/?id=" + match[1]
		console.log("d", match[1])
	}

	console.log(req.originalUrl)
	io.emit("req", {
		id: id,
		url: url
	})

	soc.on(id, function(data) {
		res.header("Content-Type", data.type);
		res.send(data.string)
	})
}

app.get("/", forward)

app.get("*", forward)

io.on('connection', function(socket){
	console.log('a user connected');

	soc = socket
});

http.listen(port, () => console.log(`Example app listening on port ${port}!`))
