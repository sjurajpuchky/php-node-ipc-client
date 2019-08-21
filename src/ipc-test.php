<?php

class Message
{
    /** @var mixed */
    private $data;
    /** @var string */
    private $type;

    /**
     * Message constructor.
     * @param stdClass $data
     * @param string $type
     */

    public function __construct(string $type, $data)
    {
        $this->data = $data;
        $this->type = $type;
    }


    function getType()
    {
        return $this->type;
    }

    function getData()
    {
        return $this->data;
    }

    function getJSON()
    {
        $obj = new stdClass();
        $obj->type = $this->type;
        $obj->data = $this->data;

        return json_encode($obj);
    }

    function setType($type)
    {
        $this->type = $type;
    }

    function setData($data)
    {
        $this->data = $data;
    }

    function parse($message)
    {
        try {
            $message = json_decode($message, $assoc = false, $depth = 65536, JSON_THROW_ON_ERROR);
            $this->type = $message->type;
            $this->data = $message->data;
        } catch (\JsonException $e) {
            $this->type = 'error';
            $this->data = new stdClass();
            $this->data->message = 'Invalid JSON response format';
            $this->data->err = $e->getMessage();
            $this->data->response = $message;
        }
    }
}

class IPCClient extends SocketClient
{
    const IPC_DELIMITER = "\f";

    public function emit($type, $data) {
        $message = (new Message($type, $data))->getJSON();
        $buffer = $message. self::IPC_DELIMITER;
        $this->write($buffer);
    }
}

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

$ipc = new IPCClient('unix:///tmp/app.mobilni-eshop-websocket-server.sock');

$ipc->emit('notify','test');