<?php


namespace App\Traits;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Exception;

trait JsonResponseTrait
{
    /**
     * @param null|mixed $data
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function success(
        $data = null,
        string $message = 'Successful',
        int $statusCode = Response::HTTP_OK
    ): JsonResponse {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $statusCode);
    }

    /**
     * @param array|null $data
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function error(
        array $data = null,
        string $message = 'Unsuccessful',
        int $statusCode = Response::HTTP_BAD_REQUEST
    ): JsonResponse {
        $response = [
            'success' => false,
            'message' => $message,
            'errors' => $data,
        ];

        return response()->json($response, $statusCode);
    }

    /**
     * @param Exception $e
     * @param int $statusCode
     * @return JsonResponse
     */
    public function fatalError(
        Exception $e,
        int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR
    ): JsonResponse {
        $line = $e->getTrace();

        $error = [
            'message' => $e->getMessage(),
            'trace' => $line,
            'mini_trace' => $line[1],
        ];

        if ('PRODUCTION' === strtoupper(config('APP_ENV'))) {
            $error = null;
        }

        $response = [
            'success' => false,
            'message' => 'Oops! Something went wrong on the server',
            'errors' => $error,
        ];

        return response()->json($response, $statusCode);
    }
}
