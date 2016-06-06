<?php

namespace AppBundle\Exception;


use Symfony\Component\Config\Definition\Exception\Exception;

class ClmAccountRepositoryException extends \Exception
{


    /**
     * ClmAccountRepositoryException constructor.
     * @param string $message
     * @param int $code
     * @param Exception $e
     */
    public function __construct($message = "", $code = 0, Exception $e = null)
    {
        parent::__construct($message, $code, $e);
    }
}