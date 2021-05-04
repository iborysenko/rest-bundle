<?php

namespace FutureFoods\Rest\Dto\Request;

class PaginationDto
{
    public const DEFAULT_PAGE = 1;
    public const DEFAULT_LIMIT = 20;

    /**
     * @var integer
     * @Assert\Type(type="int")
     */
    public $page = self::DEFAULT_PAGE;

    /**
     * @var integer
     * @Assert\Type(type="int")
     */
    public $limit = self::DEFAULT_LIMIT;
}
