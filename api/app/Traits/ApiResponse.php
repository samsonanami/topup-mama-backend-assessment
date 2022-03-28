<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

trait ApiResponse
{
    /**
     * Success Response
     * @param $data
     * @param int $code
     * @param string $message
     * @return $this
     */
    public function successResponse($data, $message, $code)
    {
        return response()->json(
            [
                'status' => $code,
                'message' => $message,
                'data' => $data
            ],
            $code
        );
    }

    /**
     * Error Response
     * @param $data
     * @param int $code
     * @param string $message
     * @return $this
     */
    public function errorResponse($message, $code, $data=[])
    {
        return response()->json(
            [
                'status' => $code,
                'message' => $message,
                'error' => $data
            ],
            $code
        );
    }

    /**
     * Exception Response
     * @param $data
     * @param int $code
     * @param string $message
     * @return $this
     */
    public function exceptionResponse($data, $message, $code)
    {
        return response()->json(
            [
                'status' => $code,
                'message' => $message,
                'data' => $data
            ],
            $code
        );
    }

    /**
     * Token Response
     * @param $data
     * @param int $code
     * @param string $message
     * @return $this
     */
    protected function token($personalAccessToken, $message = null, $code = 200)
	{
		$tokenData = [
			'access_token' => $personalAccessToken->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($personalAccessToken->token->expires_at)->toDateTimeString()
		];

		return $this->successResponse($tokenData, $message, $code);
	}
}
