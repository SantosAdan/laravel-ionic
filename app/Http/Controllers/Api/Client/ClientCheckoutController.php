<?php

namespace CodeDelivery\Http\Controllers\Api\Client;

use CodeDelivery\Http\Requests;
use CodeDelivery\Services\OrderService;
use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Http\Requests\CheckoutRequest;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClientCheckoutController extends Controller
{
    protected $repository;
    protected $userRepository;
    protected $service;

    /**
     * Checkout Controller constructor.
     * @param OrderRepository   $orderRepository
     * @param UserRepository    $userRepository
     */
    public function __construct(
        OrderRepository $repository,
        UserRepository $userRepository,
        OrderService $service)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->service = $service;
    }

    private $with = ['client', 'cupom', 'items'];

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authId = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find($authId)->client->id;
        $orders = $this->repository
            ->skipPresenter(false)
            ->with($this->with)
            ->scopeQuery(function($query) use ($clientId) {
                return $query->where('client_id', $clientId);
        })->paginate();

        return $orders;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        $data = $request->all();
        $authId = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find($authId)->client->id;
        $data['client_id'] = $clientId;
        $order = $this->service->create($data);

        return $this->repository->skipPresenter(false)->with($this->with)->find($order->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->repository->skipPresenter(false)->with($this->with)->find($id);;
    }
}
