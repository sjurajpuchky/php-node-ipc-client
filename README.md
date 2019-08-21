# php-node-ipc-client
=====================

node-ipc client for php
------------------------

node-ipc client implementation in PHP

> Author: Juraj Puchký - BABA Tumise s.r.o. <info@baba.bj>
>
> Web: http://www.baba.bj
>
> GIT: https://github.com/sjurajpuchky/php-node-ipc-client
>

INTRODUCTION
------------
I was in a situation when I need to connect to node-ipc (nodejs) server by PHP client for one project written within the Symfony framework. So I create this simple package to emit messages to my nodejs application from PHP.

HOW TO RUN
----------

### go to examples and start nodejs application from terminal
> cd examples/nodejs-ipc-server
>
> npm install
>
> nodejs src/server.js

### then go to client in separated terminal
> cd examples/client
>
> composer install
>
> php ipc-client.php
>




