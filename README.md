### Rest Bundle

## Install bundle

Add to your package.json
```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "git@github.com:iborysenko/rest-bundle.git"
    }
  ]
}
``` 
```shell
composer require iborysenko/rest-bundle
```

## Enable Bundle in config/bundles.php
```php

return [
    AutoMapperPlus\AutoMapperPlusBundle\AutoMapperPlusBundle::class => ['all' => true], // uses for automapping
    Ba\Rest\RestBundle::class => ['all' => true],
];
```

## Usage
```php 

<?php

declare(strict_types=1);

namespace App\Controller;

use Ba\Rest\Configuration\MapperParamConverter;
use Ba\Rest\Controller\RestController;
use Ba\Rest\Dto\Request\PaginationDto;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends RestController
{
    /**
     * @Route(path="/", methods={"GET"})
     * 
     * @MapperParamConverter("paginationDto", class="Ba\Rest\Dto\Request\PaginationDto")
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

