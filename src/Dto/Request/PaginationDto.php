<?php

namespace Ba\Rest\Dto\Request;

use Symfony\Component\Validator\Constraints as Assert;

class PaginationDto
{
    public const DEFAULT_PAGE = 1;
    public const DEFAULT_LIMIT = 20;

    /**
     * @var integer
     * @Assert\Type(type="int")
     * @Assert\Range(min="1")
     */
    public $page = self::DEFAULT_PAGE;

    /**
     * @var integer
     * @Assert\Type(type="int")
     * @Assert\Range(min="1", max="1000")
     */
    public $limit = self::DEFAULT_LIMIT;
}
