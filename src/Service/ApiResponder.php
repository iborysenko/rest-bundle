<?php

declare(strict_types=1);

namespace Iborysenko\Rest\Service;

use Iborysenko\Rest\Dto\Request\PaginationDto;
use AutoMapperPlus\MapperInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ApiResponder
{
    private SerializerInterface $serializer;

    private PaginatorInterface $paginator;

    private MapperInterface $mapper;

    public function __construct(SerializerInterface $serializer, PaginatorInterface $paginator, MapperInterface $mapper)
    {
        $this->serializer = $serializer;
        $this->paginator = $paginator;
        $this->mapper = $mapper;
    }

    public function createResponse($data, ?string $dtoName = null, $statusCode = Response::HTTP_OK): JsonResponse
    {
        if (null !== $data) {
            if (null !== $dtoName) {
                $data = $this->mapper->map($data, $dtoName);
            }
        }

        $context[DateTimeNormalizer::FORMAT_KEY] = 'Y-m-d h:i:s';
        if (null !== $data) {
            $data = $this->serializer->serialize($data, 'json');
        }

        return new JsonResponse($data, $statusCode, [], true);
    }

    public function createEmptyResponse(int $statusCode = Response::HTTP_NO_CONTENT): Response
    {
        return new Response('', $statusCode);
    }

    public function createPaginatedResponse(PaginationDto $pagination, $data = null, ?string $dtoName = null): JsonResponse
    {
        $paginationResult = $this->paginator->paginate($data, $pagination->page, $pagination->limit);
        $items = $paginationResult->getItems();
        if (null !== $dtoName) {
            $items = $this->mapper->mapMultiple($items, $dtoName);
        }
        $data = [
            'data'  => $items,
            'meta'  => [
                'page'  => $paginationResult->getCurrentPageNumber(),
                'limit' => $paginationResult->getItemNumberPerPage(),
                'total' => $paginationResult->getTotalItemCount()
            ],
        ];

        return $this->createResponse($data);
    }
}