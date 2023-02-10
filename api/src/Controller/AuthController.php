<?php

declare(strict_types=1);

namespace App\Controller;

use App\Command\SignUp\Command;
use App\Command\SignUp\Handle;
use OpenApi\Attributes\QueryParameter;
use OpenApi\Attributes\RequestBody;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Annotations as OA;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;

class AuthController extends AbstractController
{
    public function __construct(private Handle $handle)
    {
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Signs up a user",
     *     @OA\JsonContent(
     *         @OA\Property(property="token", type="string")
     *     )
     * )
     */
    #[Route(path: '/api/v1/auth/signUp', methods: ['POST'])]
    public function signUp(Request $request): Response
    {
        return $this->handle->handle(new Command(json_decode($request->getContent(), true)));
    }
}