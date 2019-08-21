<?php

namespace BABA\NodeIPC;

class Client extends SocketClient
{
    const IPC_DELIMITER = "\f";

    public function emit($type, $data) {
        $message = new Message($type, $data);
        $buffer = $message->getJSON(). self::IPC_DELIMITER;
        $this->write($buffer);
    }
}
