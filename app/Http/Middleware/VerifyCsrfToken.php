<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     *
     * @throws TokenMismatchException
     */
    public function handle($request, $next): mixed
    {
        if (
            $this->isReading($request) ||
            $this->runningUnitTests() ||
            $this->inExceptArray($request) ||
            $this->tokensMatch($request)
        ) {
            return tap($next($request), function ($response) use ($request) {
                if ($this->shouldAddXsrfTokenCookie()) {
                    $this->addCookieToResponse($request, $response);
                }
            });
        }

        throw new TokenMismatchException('CSRF token mismatch.');
    }

    /**
     * Determine if the session and input CSRF tokens match.
     *
     * @param  Request  $request
     * @return bool
     */
    protected function tokensMatch($request): bool
    {
        $token = $this->getTokenFromRequest($request);
        return is_string($request->session()->token()) &&
            is_string($token) &&
            hash_equals($request->session()->token(), $token);
    }
}
