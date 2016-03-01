<?php

namespace Validator\Rules;
use Collections\ArrayList;
use Validator\Exception\ValidationException;

/**
 * Class WhiteList
 * @author  Lucas A. de Araújo <lucas@minervasistemas.com.br>
 * @package Validator\Rules
 */
class WhiteList implements RuleInterface
{
    /**
     * @var ArrayList
     */
    private $whiteList;

    /**
     * @var string
     */
    private $data;

    /**
     * Construtor da classe.
     * @param ArrayList $whiteList
     */
    public function __construct(ArrayList $whiteList)
    {
        $this->whiteList = $whiteList;
    }

    /**
     * @return ArrayList
     */
    public function getWhiteList()
    {
        return $this->whiteList;
    }

    /**
     * Retorna o valor a ser validado.
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Define o valor a ser validado.
     * @param $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Executa a validação da whitelist.
     */
    public function execute()
    {
        if(!$this->getWhiteList()->contains($this->getData()))
            throw new ValidationException('O valor informado não está presente na WhiteList.');
    }
}