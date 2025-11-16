<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

trait ApiResponse
{

    protected function success($data = null,  $message = null, int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message ?? 'Success',
            'data' => $data,
        ], $status);
    }

    protected function fail($message = null, int $status = 400, $errors = null): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message ?? 'Failed.',
            'errors' => $errors,
        ], $status);
    }

    // Called automatically when validation fails
    protected function failedValidation(Validator $validator)
    {
        // Use the fail helper to keep structure consistent
        $response = $this->fail(
            'Validation errors',
            422,
            $validator->errors()->messages()
        );

        throw new HttpResponseException($response);
    }

    // Called automatically when authorization fails
    protected function failedAuthorization()
    {
        $response = $this->fail(
            'You are not authorized to perform this action.',
            403
        );

        throw new HttpResponseException($response);
    }
}
