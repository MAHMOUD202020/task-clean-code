<?php

if (! function_exists('responseApi')) {

    /**
     * return response Api
     *
     * @param string $status
     * @param string $message
     * @param string|array $data
     *
     */
    function responseApi($statusCode, $message = null, $data = null)
    {
        $statusType = ['success' => 200, 'error' => 404, 'unauthorized' => 401, 'forbidden' => 403];

        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $statusType[$statusCode]);
    }
}
