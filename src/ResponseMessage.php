<?php namespace ND\ApiHelper;

class ResponseMessage
{
    protected $status;
    protected $messages = [];

    public function __construct($status = 200, $messages = [])
    {
        $this->status = $status;
        $this->messages = $messages;
    }

    public function make($element, $action = '', $status = null, $type = 'success')
    {
        if ($status !== null) {
            $this->status = $status;
        }

        if (empty($action) || is_array($element)) {
            if (is_array($element)) {
                $this->messages = $element;
            } else {
                $this->messages[] = $element;
            }
        } else {
            $this->messages[] = $this->appMessage($element, $action, $type);
        }

        return $this;
    }

    public function makeSuccess($element, $action = '', $status = 200)
    {
        return $this->make($element, $action, $status);
    }

    public function makeFailure($element, $action = '', $status = 400)
    {
        return $this->make($element, $action, $status, 'failure');
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    /**
     * Gets standard formated app message
     *
     * app_message('Persona', 'creación', 'success')
     *
     * @param  string $element Object's mane under in the message
     * @param  string $action  Action that was performed.
     * @param  string $type    Message type can be: success or failure
     * @return string
     */
    protected function appMessage($element = 'registro', $action = 'creación', $type = 'success')
    {
        return trans("messages.{$type}", ['action' => $action, 'element' => $element]);
    }
}
