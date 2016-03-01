<?php
namespace Validator\Rules;
use Collections\ArrayList;
use Validator\Exception\ValidationException;

/**
 * Class Sequence
 * @author  Nathan C.N <nathan@domusinfo.com.br>
 * @package Validator\Rules
 */
class BlackList implements RuleInterface
{
    /**
     * Dado a ser validado
     * @var String
     */
    private $data;

    /**
     * @var ArrayList
     */
    private $blackList;

    public function __construct($blackList)
    {
        $this->setBlackList($blackList);
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return ArrayList
     */
    public function getBlackList()
    {
        return $this->blackList;
    }

    /**
     * @param ArrayList $blackList
     */
    public function setBlackList($blackList)
    {
        $this->blackList = $blackList;
    }

    /**
     * @throws ValidationException
     */
    public function execute()
    {
        if($this->getBlackList()->contains($this->getData()))
            throw new ValidationException("A sequencia {$this->getBlackList()} não é permitida.");
    }

}

