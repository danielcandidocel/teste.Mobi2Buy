<?php

namespace App\Services;

use App\Models\Api\Url;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * Class UrlService
 * @package App\Services
 */
class UrlService
{
    /**
     * @var Url
     */
    private $url;

    /**
     * UrlService constructor.
     * @param Url $url
     */
    public function __construct(Url $url)
    {
        $this->url = $url;
    }

    /**
     * @param array $data
     * @return Builder|Model
     */
    public function createUrl(array $data)
    {
        $shortened = $data['shortened'] ?? Str::random(6);

        return $this->url->query()->create([
            'url_complete'      => $data['url_complete'],
            'shortened'         => $shortened,
            'expiration_date'   => $data['expiration_date'] ?? now()->addDays(7),
        ]);
    }

    /**
     * @param string $shortened
     * @return false|Builder|Model|object
     * @throws ValidationException
     */
    public function findUrl(string $shortened)
    {
        $urlShortened = $this->url->query()->where('shortened', $shortened)->first();

        if ($urlShortened === null || $urlShortened->expiration_date < now()) {
            throw ValidationException::withMessages([
                'url' => __('definitions.message.url.expired')
            ])->status(404);
        }

        return $urlShortened;
    }
}
