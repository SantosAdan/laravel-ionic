<?php
namespace CodeDelivery\Services;

use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Repositories\ClientRepository;

/**
*
*/
class ClientService
{
    protected $clientRepository;
    protected$userRepository;

    /**
     * Client Service constructor.
     * @param ClientRepository $clientRepository
     * @param UserRepository   $userRepository
     */
    function __construct(ClientRepository $clientRepository, UserRepository $userRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Create a User and then relate it to a Client.
     * @param  array  $data [description]
     * @return [type]       [description]
     */
    public function create(array $data)
    {
        $data['user']['password'] = bcrypt('123456'); // Senha padrão

        $userId = $this->userRepository->create($data['user']);

        $data['user_id'] = $userId->id;
        $this->clientRepository->create($data);

    }

    /**
     * Update Client data and related User.
     * @param  array  $data [description]
     * @param  int $id   [description]
     */
    public function update(array $data, $id)
    {
        $this->clientRepository->update($data, $id);

        $userId = $this->clientRepository->find($id, ['user_id'])->user_id;

        $this->userRepository->update($data['user'], $userId);
    }
}