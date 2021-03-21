<?php

declare(strict_types=1);

namespace Iborysenko\Rest\Controller;

use AutoMapperPlus\AutoMapperInterface;
use Iborysenko\Rest\Service\ApiResponder;

abstract class RestController
{
    protected AutoMapperInterface $mapper;

    protected ApiResponder $responder;

    /** @required */
    public function setMapper(AutoMapperInterface $mapper): void
    {
        $this->mapper = $mapper;
    }

    /** @required */
    public function setResponder(ApiResponder $responder): void
    {
        $this->responder = $responder;
    }
}