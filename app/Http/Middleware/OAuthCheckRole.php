<?php

namespace CodeDelivery\Http\Middleware;

use Closure;
use CodeDelivery\Repositories\UserRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class OAuthCheckRole
{
    protected $userRepository;

    /**
     * OAuthCheckRole constructor.
     * @param UserRepository $userRepository [description]
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $authId = Authorizer::getResourceOwnerId();
        $user = $this->userRepository->find($authId);

        if($user->role != $role)
            abort(403, 'Access Forbidden.');

        return $next($request);
    }
}
