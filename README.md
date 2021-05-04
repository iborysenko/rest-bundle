### Rest Bundle

## Install bundle

Add to your package.json
```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "git@gitlab.futurefoods.solutions:backend/library/rest-bundle.git"
    }
  ]
}
``` 
```shell
composer require futurefoods/rest-bundle
```

## Enable Bundle in config/bundles.php
```php

return [
    AutoMapperPlus\AutoMapperPlusBundle\AutoMapperPlusBundle::class => ['all' => true], // uses for automapping
    FutureFoods\Rest\RestBundle::class => ['all' => true],
];
```

## Usage
```php 

<?php

declare(strict_types=1);

namespace App\Controller;

use FutureFoods\Rest\Configuration\MapperParamConverter;
use FutureFoods\Rest\Controller\RestController;
use FutureFoods\Rest\Dto\Request\PaginationDto;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends RestController
{
    /**
     * @Route(path="/", methods={"GET"})
     * 
     * @MapperParamConverter("paginationDto", class="FutureFoods\Rest\Dto\Request\PaginationDto")
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

