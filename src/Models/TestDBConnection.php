<?php

namespace Src\Models;

use Config\Database;
use Exception;

class TestDBConnection
{
    public function index()
    {
        try {
            $db = new Database();
            $db->getConnection();

            return json_encode([
                'status' => 'success',
                'message' => 'Database connection successfully'
            ]);
        } catch (Exception $e) {
            return json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
