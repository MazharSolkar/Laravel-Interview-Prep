<?php

namespace App\Traits;

trait HttpResponse {

    protected function success($code,$message=null,$data=null) {
        return response()->json([
            'status'=>'Request was successful.',
            'message'=>$message,
            'data'=>$data,
        ],$code);
    }

    protected function error($code,$message=null,$data=null) {
        return response()->json([
            'status'=>'Error has occured.',
            'message'=>$message,
            'data'=>$data,
        ],$code);
    }
}
