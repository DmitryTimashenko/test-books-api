<?php

namespace App\Controller;

use App\Helpers\TranslatableDtoValidator;
use App\Model\BookDTO;
use App\Service\BookService;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private TranslatableDtoValidator $validator,
        private BookService $bookService
    )
    {
    }

    #[Route('/book/create', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $input = $this->serializer->deserialize($request->getContent(), BookDTO::class, 'json');
        $this->validator->validate($input);
        $this->bookService->create($input);
        return $this->json(["message" => "Book was created"], Response::HTTP_CREATED);
    }

    #[Route('/book/search', methods: ['GET'])]
    public function searchBook(Request $request): Response
    {
        $tile = $request->get('title');
        $bookList = $this->bookService->searchByTitle($tile);
        return new Response($this->serializer->serialize($bookList,'json'), Response::HTTP_OK);
    }

    #[Route('/{_locale}/book/{id}', methods: ['GET'], requirements: ['_locale' => 'en|ru'])]
    public function getBook(Request $request, int $id): Response
    {
        $book = $this->bookService->getBook($id);
        return new Response(
            $this->serializer->serialize($book,'json'),
            Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}