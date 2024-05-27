<?php

declare(strict_types=1);
namespace App\Exceptions;

use DomainException;
use Mezzio\ProblemDetails\Exception\CommonProblemDetailsExceptionTrait;
use Mezzio\ProblemDetails\Exception\ProblemDetailsExceptionInterface;

class TokenException extends DomainException implements
    ProblemDetailsExceptionInterface
{
    use CommonProblemDetailsExceptionTrait;
    const TYPE = 'toDoMTN';

    public static function expired(): self
    {
        $detail = sprintf('OTP Provided has expired');
        $e = new self($detail);
        $e->status = 410;
        $e->type = self::TYPE;
        $e->title = 'OTP has expired';
        $e->detail = $detail;

        return $e;
    }

    public static function wrong(): self
    {
        $detail = sprintf('Token Provided is incorrect');
        $e = new self($detail);
        $e->status = 409;
        $e->type = self::TYPE;
        $e->title = 'Token Provided is incorrect';
        $e->detail = $detail;

        return $e;
    }
}
