<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = ['api/tester','api/signup','api/profile-update','api/page-list','api/login','api/provider-details','api/update-provider',
        'api/category','api/providers-list'
        //
    ];
}
