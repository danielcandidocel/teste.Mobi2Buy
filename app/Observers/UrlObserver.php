<?php

namespace App\Observers;

use App\Models\Api\Url;
use Exception;

class UrlObserver
{
    /**
     * @param Url $url
     * @throws Exception
     */
    public function retrieved(Url $url)
    {
        if ($url->expiration_date < now()) {
            $url->delete();
        }
    }
}
