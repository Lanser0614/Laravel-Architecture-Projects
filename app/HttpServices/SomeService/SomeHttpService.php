<?php
declare(strict_types=1);

namespace App\HttpServices\SomeService;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class SomeHttpService
{
    private function baseRequest(): PendingRequest
    {
        return Http::baseUrl(config('services.some_service.domain'));
    }

    /**
     * @throws RequestException
     */
    public function getOneItem(int $id)
    {
        return $this->baseRequest()->get("/todos/{$id}")->throw()->json();
    }
}
