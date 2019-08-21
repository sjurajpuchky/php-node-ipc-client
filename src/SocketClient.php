<?php

namespace BABA\NodeIPC;

/**
 * Class SocketClient
 * @package BABA\NodeIPC
 */

class SocketClient
{
    const MAX_BUFFER_SIZE = 4096;
    private $sock;

    function __construct($socketUrl)
    {
        $this->sock = stream_socket_client($socketUrl, $errno, $errstr);
    }

    function write($data)
    {
        fwrite($this->sock, $data);
    }

    function read() {
        return fread($this->sock,self::MAX_BUFFER_SIZE);
    }

    public function __destruct()
    {
        fclose($this->sock);
    }

}
