<?php

namespace App\Traits;

trait HttpResponse {

    protected function success($code, $data=null, $message=null) {
        return response()->json([
            'status'=> 'Request was successful.',
            'message'=> $message,
            'data'=> $data,
        ],$code);
    }

    protected function error($code, $data=null, $message=null) {
        return response()->json([
            'status'=> 'Error has occurred...',
            'message'=> $message,
            'data'=> $data,
        ],$code);
    }
}
