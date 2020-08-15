<?php namespace ND\ApiHelper;

use League\Fractal\TransformerAbstract;

class MessageTransformer extends TransformerAbstract
{
    public function transform($message)
    {
        return [$message];
    }
}
