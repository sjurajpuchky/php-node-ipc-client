/**
* @author Juraj Puchký - BABA Tumise s.r.o.
* @description IPC server sample
*/

const ipc = require('node-ipc');

const ipcSocketPath = '/tmp/sample.sock';

// IPC handler

ipc.serve(
    ipcSocketPath,
    function() {
        ipc.server.on(
            'message',
            function(data,socket) {
                console.log(`pid ${process.pid} got: `, data);
            }
        );
    }
);

ipc.server.start();
