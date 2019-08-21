<?php

require_once __DIR__ . '/vendor/autoload.php';

use BABA\NodeIPC\Client;

$ipc = new Client('unix:///tmp/sample.sock');

$ipc->emit('message', 'Hello world!!!');