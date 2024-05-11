<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class UserAuthException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request): Response
    {
        //
    }

    // public static function duplicateEntry($request): Response
    // {
    //     return new JsonResponse([
    //         'errors' => [
    //             'message' => $this->getMessage()
    //         ]], $this->code);
    // }
}
