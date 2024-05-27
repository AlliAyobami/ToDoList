<?php

declare(strict_types=1);

namespace App\Exceptions;

use DomainException;
use Mezzio\ProblemDetails\Exception\CommonProblemDetailsExceptionTrait;
use Mezzio\ProblemDetails\Exception\ProblemDetailsExceptionInterface;

class UserAuthException extends DomainException implements
    ProblemDetailsExceptionInterface
{
    use CommonProblemDetailsExceptionTrait;
    const TYPE = 'toDoMTN';

    public static function invalid(): self
    {
        $detail = sprintf('Invalid User Registration Details');
        $e = new self($detail);
        $e->status = 417;
        $e->type = self::TYPE;
        $e->title = 'Invalid User Details';
        $e->detail = $detail;

        return $e;
    }

    public static function notFound(): self
    {
        $detail = sprintf('User not found');
        $e = new self($detail);
        $e->status = 404;
        $e->type = self::TYPE;
        $e->title = 'User not found';
        $e->detail = $detail;

        return $e;
    }
}
