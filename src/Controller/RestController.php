<?php

declare(strict_types=1);

namespace Iborysenko\Rest\Controller;

use Api\Service\ApiResponder;
use AutoMapperPlus\AutoMapperInterface;

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