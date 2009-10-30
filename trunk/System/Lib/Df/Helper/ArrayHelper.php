<?php
class Df_Helper_ArrayHelper
{
    public static function diff($arr, $arr2)
    {
        foreach ($arr as $name => $value)
        {
            if (isset($arr2[$name]))
            {
                unset($arr[$name]);
            }
        }

        return $arr;
    }
}