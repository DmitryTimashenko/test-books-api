<?php

namespace App\Controller;

use App\Model\DTO\BookDTO;
use App\Service\AuthorService;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BookController extends AbstractController
{
    private SerializerInterface $serializer;
    private ValidatorInterface $validator;

    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator, AuthorService $authorService)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }
    #[Route('/book/create', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $input = $this->serializer->deserialize($request->getContent(), BookDTO::class, 'json');
        $errors = $this->validator->validate($input);
        if ($errors->count() > 0) {
            $errorsString = (string) $errors;
            return $this->json(["message" => $errorsString], 400);
        }

        return $this->json(["message" => []], 200);
    }
}