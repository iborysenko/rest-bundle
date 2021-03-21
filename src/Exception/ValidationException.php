<?php
declare(strict_types=1);

namespace Iborysenko\Rest\Exception;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ValidationException extends BadRequestHttpException
{
    private const VALIDATION_ERROR = 'Invalid request parameters';

    private array $errors = [];

    public function __construct(array $errors = [], string $message = self::VALIDATION_ERROR)
    {
        $this->errors = $errors;
        parent::__construct($message);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}