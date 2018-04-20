<?php namespace Spys\ApiHelper;

use League\Fractal\TransformerAbstract;

class ResponseMessageTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'messages'
    ];

    public function transform($apiResponse)
    {
        return [
            'status' => $apiResponse->status,
        ];
    }

    public function includeMessages($apiResponse)
    {
        $messages = $apiResponse->messages;

        return $this->collection($messages, new MessageTransformer);
    }
}
