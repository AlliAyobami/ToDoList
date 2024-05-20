<?php

declare(strict_types=1);

namespace App\Exceptions;

use DomainException;
use Mezzio\ProblemDetails\Exception\CommonProblemDetailsExceptionTrait;
use Mezzio\ProblemDetails\Exception\ProblemDetailsExceptionInterface;

class JwtException extends DomainException implements ProblemDetailsExceptionInterface
{
    use CommonProblemDetailsExceptionTrait;
    const TYPE = 'toDoMTN';

    public static function invalid(string $detail): self
    {
        $e = new self($detail);
        $e->status = 401;
        $e->type   = self::TYPE;
        $e->title  = 'Invalid JWT Authentication';
        $e->detail = $detail;

        return $e;
    }
}
