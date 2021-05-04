<?php

declare(strict_types=1);

namespace FutureFoods\Rest\ParamConverter;

use FutureFoods\Rest\Configuration\MapperParamConverter;
use FutureFoods\Rest\Exception\ValidationException;
use AutoMapperPlus\AutoMapperInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Map request to dto specified in controller
 */
class MapperConverter implements ParamConverterInterface
{
    private AutoMapperInterface $mapper;

    private ValidatorInterface $validator;

    public function __construct(AutoMapperInterface $mapper, ValidatorInterface $validator)
    {
        $this->validator = $validator;
        $this->mapper = $mapper;
    }

    public function apply(Request $request, ParamConverter $configuration): bool
    {
        $class = $configuration->getClass();
        $dto = $this
            ->mapper
            ->convert(
                \array_merge(
                    $request->attributes->get('_route_params', []),
                    $request->query->all(),
                    $request->request->all()
                ),
                $class
            );

        $errors = $this->validator->validate($dto, null, $configuration->getValidationGroups());
        if (count($errors) > 0) {
            throw new ValidationException(iterator_to_array($errors));
        }

        $request->attributes->set($configuration->getName(), $dto);

        return true;
    }

    public function supports(ParamConverter $configuration): bool
    {
        return $configuration instanceof MapperParamConverter;
    }
}
