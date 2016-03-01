<?php

namespace Validator\Rules;

use Validator\Exception\ValidationException;

/**
 * Class DateFormat
 * @author  Luan Maik Cordeiro <luanmaik1994@gmail.com>
 * @package Validator\Rules
 */


class DateFormat implements RuleInterface
{
    /**
     * Formato a ser verificado.
     * @var string
     */
    private $format;

    /**
     * Data a ser validada
     * @var string
     */
    private $data;

    /**
     * Date constructor.
     * @param String $format
     */
    public function __construct($format)
    {
        $this->format = $format;
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
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param mixed $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }


    /**
     * Valida o formato da data a partir da data e formato passados por parâmetros
     * @param String $format
     * @param String $date
     * @return bool
     */
    private function dateFormatValidate($format, $date){
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    /**
     * Executa a validação.
     * @throws ValidationException
     */
    public function execute()
    {
        if(!$this->dateFormatValidate($this->getFormat(), $this->getData())) {
            throw new ValidationException("O formato da data é inválido.");
        }
    }
}