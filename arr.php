<?php

class Arr
{
    public static function each($arr, $fn)
    {
        foreach ($arr as $k => $v) {
            $fn($v, $k);
        }
    }

    public static function get($arr, $key, $def = null)
    {
        if (isset($arr[$key]) || array_key_exists($key, $arr)) {
            return $arr[$key];
        }
        return $def;
    }

    public static function mget($arr, $keys)
    {
        $ret = [];
        $keys = explode(',', $keys);
        foreach ($keys as $key) {
            $ret[$key] = self::get($arr, $key);
        }
        return $ret;
    }

    public static function index($arr, $index_key, $column_key = null)
    {

        return array_column($arr, $column_key, $index_key);
    }

    public static function column($arr, $column_key)
    {
        return array_column($arr, $column_key);
    }

    public static function group($arr, $group_key, $index_key = null)
    {
        $ret = [];
        foreach ($arr as $v) {
            if (is_null($index_key)) {
                $ret[self::get($v, $group_key)][] = $v;
            } else {
                $ret[self::get($v, $group_key)][self::get($v, $index_key)] = $v;
            }
        }
        return $ret;
    }
}
