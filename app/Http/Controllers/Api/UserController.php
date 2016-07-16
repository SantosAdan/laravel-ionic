<?php

namespace CodeDelivery\Http\Controllers\Api;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\UserRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class UserController extends Controller
{
    protected $repository;

    /**
     * User Controller constructor.
     * @param UserRepository    $userRepository
     */
    public function __construct(
        UserRepository $repository)
    {
        $this->repository = $repository;
    }

     /**
     * .
     * @return \Illuminate\Http\Response
     */
    public function authenticated()
    {
        $authId = Authorizer::getResourceOwnerId();
        $client = $this->repository
            ->skipPresenter(false)
            ->with('client')->find($authId);

        return $client;
    }

}
