<?php

namespace FluxoDeCaixa\Core;

class Validator
{
    const NOT_EMPTY = 'notEmpty';

    public static function validate($dataObject, $field, $condition = self::NOT_EMPTY){
        if($condition == self::NOT_EMPTY ) {
            if($dataObject->$field == null || $dataObject->$field == ''){
                throw new \Exception("Favor preencher $field", 1);
            }
        }
    }
}
