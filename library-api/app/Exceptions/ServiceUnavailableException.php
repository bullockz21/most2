<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class ServiceUnavailableException extends BaseException
{
    public function __construct(
        $previous = null,
    )
    {
        parent::__construct();

        if ($previous instanceof AuthorizationException) {
            throw new AuthorizationException();
        }

        if ($previous instanceof QueryException) {
            throw new \App\Exceptions\QueryException($previous->getMessage());
        }

        if ($previous != null) {
            $code = $previous->getCode();
            if (isHttpCode($code)) {
                $this->code = $previous->getCode();
            } else {
                $this->code = Response::HTTP_SERVICE_UNAVAILABLE;
            }
            $this->message = $previous->getMessage();
        } else {
            $this->message = 'Сервис временно недоступен';
            $this->code = Response::HTTP_SERVICE_UNAVAILABLE;
        }
    }
}
