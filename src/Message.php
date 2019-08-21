<?php

namespace BABA\NodeIPC;

use stdClass;

/**
 * Class Message
 * @package BABA\NodeIPC
 */

class Message
{
    /** @var mixed */
    private $data;
    /** @var string */
    private $type;

    /**
     * Message constructor.
     * @param mixed $data
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
