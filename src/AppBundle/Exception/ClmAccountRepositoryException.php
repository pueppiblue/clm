<?php

namespace AppBundle\Exception;


use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\Config\Definition\Exception\Exception;

class ClmAccountRepositoryException extends \Exception
{

    /**
     * ClmAccountRepositoryException constructor.
     * @param string $message
     * @param int $code
     * @param UniqueConstraintViolationException|\Exception|Exception $e
     */
    public function __construct($message = "", $code = 0, UniqueConstraintViolationException $e = null)
    {
        parent::__construct($message, $code, $e);
    }
}