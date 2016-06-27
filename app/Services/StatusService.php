<?php
namespace CodeDelivery\Services;

class StatusService
{
    public function lists()
    {
        return [0 => 'Pendente', 1 => 'À Caminho', 2 => 'Entregue', 3 => 'Cancelado'];
    }
}