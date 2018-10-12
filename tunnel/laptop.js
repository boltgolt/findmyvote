var socket = require('socket.io-client')('http://138.68.91.134:80');
const request = require('request');

socket.on('connect', function(){console.log("conn")});
socket.on('req', function(data) {
	console.log(data)
	request('http://10.42.0.65/' + data.url, {}, (err, res, body) => {
		if (err) { return console.log(err); }
		console.log(res.body)
		socket.emit(data.id, {
			"string": res.body,
			"type": res.headers['content-type']
		})
	});
});
socket.on('disconnect', function(){console.log("disconnect")});
