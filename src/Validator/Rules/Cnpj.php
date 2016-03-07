<?php

namespace Validator\Rules;
use Validator\Exception\ValidationException;

/**
 * Class Cnpj
 * @author  Lucas A. de Araújo <lucas@minervasistemas.com.br>
 * @package Validator\Rules
 */
class Cnpj extends AbstractRule
{
    /**
     * Verifica se o Cnpj é válido.
     * @param $input
     * @return bool
     */
    public static function isValid($input)
    {
        $c = preg_replace('/\D/', '', $input);
        $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        if (strlen($c) != 14) {
            return false;
        }
        for ($i = 0, $n = 0; $i < 12; $n += $c[$i] * $b[++$i]);
        if ($c[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }
        for ($i = 0, $n = 0; $i <= 12; $n += $c[$i] * $b[$i++]);
        if ($c[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }
        return true;
    }

    public function execute()
    {
        if(!self::isValid($this->getData())){
            throw new ValidationException('O CNPJ informado é inválido.');
        }
    }

}