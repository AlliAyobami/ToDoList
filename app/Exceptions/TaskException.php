<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class TaskException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     * @return JsonResponse
     */
    public function render(Request $request): Response
    {
        //
    }

    /**
     * Render the exception as an HTTP response.
     * @return JsonResponse
     */
    public static function invalid(): JsonResponse
    {
        return new JsonResponse([
            'errors' => [
                'message' => 'Invalid Request'
            ]], 400);
    }

    /**
     * Render the exception as an HTTP response.
     * @return JsonResponse
     */
    public static function notFound(): JsonResponse
    {
        return new JsonResponse([
            'errors' => [
                'message' => 'Not Found'
            ]], 404);
    }
}
