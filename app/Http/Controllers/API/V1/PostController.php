<?php

namespace App\Http\Controllers\API\V1;

use App\DAO\PostStatsCriteriaDAO;
use App\Services\DataLoader;
use App\Services\UserPostService;
use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(
        private DataLoader $dataLoader,
        private UserPostService $service
    ) {}

    /**
     * Get stats.
     */
    public function stats(Request $request): JsonResponse
    {
        // load data if not loaded yet.
        if ($this->service->count() == 0) {
            $this->dataLoader->handle();
        }

        $average = $this->service->getWordsAverage(
            // create a new dto instance with data from request.
            new PostStatsCriteriaDAO($request->all())
        );

        return response()->json(compact('average'));
    }
}
