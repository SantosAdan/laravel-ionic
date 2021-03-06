<?php

namespace CodeDelivery\Http\Controllers;

use Illuminate\Http\Request;
use CodeDelivery\Http\Requests;
use Illuminate\Support\Facades\Auth;
use CodeDelivery\Services\OrderService;
use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Http\Requests\CheckoutRequest;
use CodeDelivery\Repositories\ProductRepository;

class CheckoutController extends Controller
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
        $clientId = $this->userRepository->find(Auth::user()->id)->client->id;
        $orders = $this->repository->scopeQuery(function($query) use ($clientId) {
            return $query->where('client_id', $clientId);
        })->paginate();

        return view('customer.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = $this->productRepository->all();

        return view('customer.order.create', compact('products'));
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
        $clientId = $this->userRepository->find(Auth::user()->id)->client->id;
        $data['client_id'] = $clientId;
        $this->service->create($data);

        return redirect()->route('customer.order.index');
    }
}
