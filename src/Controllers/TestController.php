<?php

namespace Src\Controllers;

class TestController
{
    public function index()
    {
        return json_encode([
            'status' => 'ok',
            'message' => 'API is working',
        ]);
    }
}
