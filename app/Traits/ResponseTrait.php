<?php

namespace App\Traits;

trait ResponseTrait
{
    public function sendResponse($response,$status="Success",$code=200)
    {
        return response()->json($response);
    }
}
