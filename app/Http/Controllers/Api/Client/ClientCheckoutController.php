<?php

namespace CodeDelivery\Http\Controllers\Api\Client;

use Illuminate\Http\Request;
use CodeDelivery\Http\Requests;
use Illuminate\Support\Facades\Auth;
use CodeDelivery\Services\OrderService;
use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClientCheckoutController extends Controller
{
    protected $repository;
    protected $userRepository;
    protected $productRepository;
    protected $service;

    /**
     * Checkout Controller constructor.
     * @param OrderRepository   $orderRepository
     * @param UserRepository    $userRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
        OrderRepository $repository,
        UserRepository $userRepository,
        ProductRepository $productRepository,
        OrderService $service)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->service = $service;
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authId = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find($authId)->client->id;
        $orders = $this->repository->with(['items'])->scopeQuery(function($query) use ($clientId) {
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
    public function store(Request $request)
    {
        $data = $request->all();
        $authId = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find($authId)->client->id;
        $data['client_id'] = $clientId;
        $order = $this->service->create($data);

        $order = $this->repository->with(['items'])->find($order->id);

        return $order;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = $this->repository->with(['client', 'items', 'cupom'])->find($id);
        $order->items->each(function($item) {
            $item->product;
        });

        return $order;
    }
}
