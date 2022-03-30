<?php

namespace App\Helpers;

use App\Exception\CreateBookInputIsNotValidException;
use App\Model\TranslatableDto;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TranslatableDtoValidator
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param TranslatableDto $dto
     * @return void
     */
    public function validate(TranslatableDto $dto)
    {
        $errors = $this->validator->validate($dto);
        if ($errors->count() > 0) {
            throw new CreateBookInputIsNotValidException('Input json is not valid');
        }

        foreach ($dto->getTranslations() as $translation) {
            $errors = $this->validator->validate($translation);
            if ($errors->count() > 0) {
                throw new CreateBookInputIsNotValidException('Input json is not valid');
            }
        }
    }
}