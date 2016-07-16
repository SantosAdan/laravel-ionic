<?php

namespace CodeDelivery\Repositories;

use CodeDelivery\Models\Order;
use CodeDelivery\Presenters\OrderPresenter;
use CodeDelivery\Validators\OrderValidator;;
use Illuminate\Database\Eloquent\Collection;
use CodeDelivery\Repositories\OrderRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class OrderRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return OrderPresenter::class;
    }

    /**
     * Get orders for given order id and deliveryman id
     * @param  int $id
     * @param  int $deliverymanId
     * @return  CodeDelivery\Models\Order
     */
    public function getByIdAndDeliveryman($id, $deliverymanId)
    {
        $result = $this->with(['client', 'items', 'cupom'])->findWhere([
            'id' => $id,
            'user_deliveryman_id' => $deliverymanId
        ]);

        if($result instanceof Collection)
            $result = $result->first();
        else {
            if(isset($result['data']) && count($result['data']) == 1) {
                $result = [
                    'data' => $result['data'][0]
                ];
            }
            else {
                throw new ModelNotFoundException("Pedido inexistente");
            }
        }

        return $result;
    }
}
