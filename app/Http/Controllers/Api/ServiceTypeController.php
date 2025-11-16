<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceType\ServiceTypeResource;
use App\Models\ServiceType;
use Symfony\Component\HttpFoundation\JsonResponse;

class ServiceTypeController extends Controller
{
     public function index(): JsonResponse
    {
        $serviceTypes = ServiceType::orderBy('name')->get();

      return $this->success(ServiceTypeResource::collection($serviceTypes), 'Service types retrieved successfully');
    }
}
