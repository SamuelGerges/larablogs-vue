<?php

namespace App\Traits;

trait Response
{
    public function sendResponse($response,$status="Success",$code=200)
    {
        return response()->json($response);
    }
}
