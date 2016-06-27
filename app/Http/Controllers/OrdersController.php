<?php

namespace CodeDelivery\Http\Controllers;

use Illuminate\Http\Request;
use CodeDelivery\Http\Requests;
use CodeDelivery\Services\StatusService;
use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Repositories\OrderRepository;

class OrdersController extends Controller
{

    protected $repository;
    protected $statusService;

    /**
     * Order Controller constructor.
     * @param OrderRepository $repository [description]
     */
    public function __construct(OrderRepository $repository, StatusService $statusService)
    {
        $this->repository = $repository;
        $this->statusService = $statusService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->repository->paginate(5);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, UserRepository $userRepository)
    {
        $order = $this->repository->find($id);
        $list_status = $this->statusService->lists();
        $deliverymen = $userRepository->getDeliverymen();

        return view('admin.orders.edit', compact('order', 'list_status', 'deliverymen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $order = $this->repository->update($data, $id);

        return redirect()->route('admin.orders.index');
    }
}
