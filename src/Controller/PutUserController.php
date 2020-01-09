<?php

namespace App\Controller;

use Domain\Command\PutUser;
use Domain\Model\User;
use Domain\Model\UserUID;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PutUserController
 */
class PutUserController
{
    /**
     * @var CommandBus
     */
    private $bus;

    /**
     * GetUserByUIDController constructor.
     *
     * @param CommandBus $writeBus
     */
    public function __construct(CommandBus $writeBus)
    {
        $this->bus = $writeBus;
    }

    /**
     * Invoke
     *
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request) : Response
    {
        $userData = json_decode($request->getContent(), true);

        $putUser = new PutUser(
            new User(
                new UserUID($request->get('uid')),
                (string) $userData['name'],
                (int) $userData['age']
            )
        );

        $this
            ->bus
            ->handle($putUser);

        return new Response('', 200);
    }
}