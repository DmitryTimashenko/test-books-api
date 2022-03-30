<?php

namespace App\Controller;

use App\Model\BookDTO;
use App\Service\BookService;
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
    private BookService $bookService;

    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator, BookService $bookService)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->bookService = $bookService;
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

        $this->bookService->create($input);

        return $this->json(["message" => []], 200);
    }

    #[Route('/book/search', methods: ['GET'])]
    public function searchBook(Request $request): Response
    {
        $tile = $request->get('title');
        $bookList = $this->bookService->searchByTitle($tile);
        return new Response($this->serializer->serialize($bookList,'json'), 200);
    }
}