<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 18.12.2019
 * Time: 22:40
 */

namespace Framework\Helper;


class ArrayHelper
{
    /**
     * @param array $array
     * @param string $search
     * @return mixed
     * Поиск ключа и возврат значения по ключу
     */
    public static function searchinarray( $array, $search)
    {

        foreach ($array as $key=>$value)
        {

            if (($key===$search))
            {
                $result = $value;

            }

            elseif ((\is_array($value)) && (self::searchinarray($value,$search))) $result =self::searchinarray($value,$search);

            if ($result)
            {
                if ($result instanceof \Closure)
                {
                    return $result();
                }
                return $result;
            }

        }

    }
}