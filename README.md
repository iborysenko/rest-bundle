### Rest Bundle

## Install bundle
```shell
composer require iborysenko/rest-bundle
```

## Enable Bundle in config/bundles.php
```php

return [
    AutoMapperPlus\AutoMapperPlusBundle\AutoMapperPlusBundle::class => ['all' => true], // uses for automapping
    Iborysenko\Rest\RestBundle::class => ['all' => true],
];
```

## Usage
```php 

<?php

declare(strict_types=1);

namespace App\Controller;

use Iborysenko\Rest\Configuration\MapperParamConverter;
use Iborysenko\Rest\Controller\RestController;
use Iborysenko\Rest\Dto\Request\PaginationDto;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends RestController
{
    /**
     * @Route(path="/", methods={"GET"})
     * 
     * @MapperParamConverter("paginationDto", class="Iborysenko\Rest\Dto\Request\PaginationDto")
     *
     * @return Response
     */
    public function indexAction(PaginationDto $paginationDto): Response
    {
        return $this->responder->createResponse(['foo'=> 'bar']); // response with data
        return $this->responder->createPaginatedResponse($paginationDto, []); // paginated response
        return $this->responder->createEmptyResponse(); // empty response
    }
}

```

