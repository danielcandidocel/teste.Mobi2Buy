<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Url\CreateUrlShortenedRequest;
use App\Http\Resources\UrlResource;
use App\Services\UrlService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class UrlController extends Controller
{
    /**
     * @var UrlService
     */
    private $urlService;

    /**
     * UrlController constructor.
     * @param UrlService $urlService
     */
    public function __construct(UrlService $urlService)
    {
        $this->urlService = $urlService;
    }

    /**
     * @param CreateUrlShortenedRequest $request
     * @return UrlResource
     */
    public function store(CreateUrlShortenedRequest $request): UrlResource
    {
        $createUrl = $this->urlService->createUrl($request->validated());
        return new UrlResource($createUrl);
    }

    /**
     * @param string $shortened
     * @return JsonResponse|RedirectResponse
     * @throws ValidationException
     */
    public function redirect(string $shortened)
    {
        $urlShortened = $this->urlService->findUrl($shortened);
        return Redirect::to($urlShortened->url_complete);
    }
}
