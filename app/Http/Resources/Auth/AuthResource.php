<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Override;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'auth',
             ...$this->toAttributes($request),
        ];
    }

    /**
     * Customize the response data when the resource is converted to JSON.
     * 
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toAttributes(Request $request): array
    {
        return [
            'access_token' => $this->resource['access_token'],
            'token_type' => $this->resource['token_type'],
        ];
    }
}
