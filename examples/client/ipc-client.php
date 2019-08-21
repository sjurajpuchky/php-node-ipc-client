<?php




$ipc = new IPCClient('unix:///tmp/app.mobilni-eshop-websocket-server.sock');

$ipc->emit('notify','test');