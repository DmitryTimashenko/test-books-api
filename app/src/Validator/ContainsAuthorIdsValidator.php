<?php

namespace App\Validator;

use App\Repository\AuthorRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class ContainsAuthorIdsValidator extends ConstraintValidator
{
    private AuthorRepository $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function validate($value, Constraint $constraint)
    {
        if (! $constraint instanceof ContainsAuthorIds) {
            throw new UnexpectedTypeException($constraint, ContainsAuthorIds::class);
        }

        if (empty($value)) {
            return;
        }

        if (!is_array($value)) {
            throw new UnexpectedValueException($value, 'array');
        }

        foreach ($value as $id) {
            $author = $this->authorRepository->find($id);
            if(empty($author)) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ id }}', $id)
                    ->addViolation();
            }
        }
    }
}