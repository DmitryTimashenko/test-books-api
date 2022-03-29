<?php

namespace App\Helpers;

use App\Model\DTO\TranslatableDto;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TranslatableDtoValidator
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(TranslatableDto $dto): ConstraintViolationListInterface
    {
        foreach ($dto->getTranslations() as $translation) {
            $errors = $this->validator->validate($translation);
            if ($errors->count() > 0) {
                return $errors;
            }
        }
        return $this->validator->validate($dto);
    }
}