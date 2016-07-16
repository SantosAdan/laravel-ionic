<?php

namespace CodeDelivery\Http\Controllers\Api\Deliveryman;

use Illuminate\Http\Request;
use CodeDelivery\Http\Requests;
use CodeDelivery\Services\OrderService;
use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Repositories\OrderRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class DeliverymanCheckoutController extends Controller
{
    protected $repository;
    protected $userRepository;
    protected $service;

    /**
     * Checkout Controller constructor.
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

    private $with = ['client', 'items', 'cupom'];

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliverymanId = Authorizer::getResourceOwnerId();

        return $this->repository
            ->skipPresenter(false)
            ->with($this->with)
            ->scopeQuery(function($query) use ($deliverymanId) {
                return $query->where('user_deliveryman_id', $deliverymanId);
        })->paginate();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deliverymanId = Authorizer::getResourceOwnerId();

        return $this->repository
            ->skipPresenter(false)
            ->getByIdAndDeliveryman($id, $deliverymanId);

    }

    public function updateStatus(Request $request, $id)
    {
        $deliverymanId = Authorizer::getResourceOwnerId();
        $order = $this->service->updateStatus($id, $deliverymanId, $request->get('status'));

        if($order)
            return $this->repository->skipPresenter(false)->with($this->with)->find($order->id);
        else
            abort(400, 'Order not found.');
    }
}
