<?php

namespace App\Controller;

use Domain\Query\GetUserByUID;
use Domain\Exception\UserNotFoundException;
use Domain\Model\UserUID;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GetUserByUIDController
 */
final class GetUserByUIDController
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
        $getUserByUID = new GetUserByUID(new UserUID($request->get('uid')));

        try {
            $user = $this
                ->bus
                ->handle($getUserByUID);

            $userUID = $user->getUID();
            $response = new JsonResponse([
                'uid' => [
                    'id' => $userUID->getId()
                ],
                'name' => $user->getName(),
                'age' => $user->getAge(),
            ], 200);
        } catch (UserNotFoundException $exception) {
            $response = new Response('User not found', 404);
        }

        return $response;
    }
}