<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Order extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'client_id',
        'user_deliveryman_id',
        'total',
        'status',
        'cupom_id',
    ];

    // Relationships
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function deliveryman()
    {
        return $this->belongsTo(User::class, 'user_deliveryman_id', 'id');
    }

    public function cupom()
    {
        return $this->belongsTo(Cupom::class);
    }

    // ============================== Accessors ============================
    public function getStatusAttribute($value)
    {
        switch ($value) {
            case 0:
                return $this->status = 'Pendente';
                break;
            case 1:
                return $this->status = 'A caminho';
                break;
            case 2:
                return $this->status = 'Entregue';
                break;
            case 3:
                return $this->status = 'Cancelado';
                break;
        }
    }
    // ================================================================
}
