<?php

namespace App\Trait;

trait HttpResponse
{
    protected function success($status=200,$message=null,$data=null) {
        return response()->json([
            'status'=> 'success',
            'message'=> $message,
            'data'=> $data,
        ], $status);
    }

    protected function error($status=200,$message=null) {
        return response()->json([
            'status'=> 'error',
            'message'=> $message
        ],$status);
    }
}
