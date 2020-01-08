<?php

namespace App\Controller;

use Domain\Command\DeleteUser;
use Domain\Model\UserUID;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DeleteUserController
 */
final class DeleteUserController
{
    /**
     * @var CommandBus
     */
    private $bus;

    /**
     * GetUserByUIDController constructor.
     *
     * @param CommandBus $bus
     */
    public function __construct(CommandBus $bus)
    {
        $this->bus = $bus;
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
        $this
            ->bus
            ->handle(new DeleteUser(
                new UserUID($request->get('uid'))
            ));

        return new Response('', 200);
    }
}