<?php

namespace App\Controller;

use App\Helpers\TranslatableDtoValidator;
use App\Model\AuthorDTO;
use App\Service\AuthorService;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{

    public function __construct(
        private SerializerInterface $serializer,
        private TranslatableDtoValidator $validator,
        private AuthorService $authorService)
    {
    }

    #[Route('/author/create', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $input = $this->serializer->deserialize($request->getContent(), AuthorDTO::class, 'json');
        $this->validator->validate($input);
        $this->authorService->create($input);
        return $this->json(["message" => "Author was created"], Response::HTTP_CREATED);
    }
}