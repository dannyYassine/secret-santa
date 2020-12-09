<?php


class GenericMapper
{
    public static function mapArray($class, array $array)
    {
        $objects = [];
        foreach ($array as $object) {
            $objects[] = self::mapObject($class, $object);
        }

        return $objects;
    }

    public static function mapObject($class, \stdClass $stdClass)
    {
        $object = new $class();
        foreach (get_object_vars($stdClass) as $key => $value) {
            if (isset($object->{$key})) {
                $object->{$key} = $value;
            }
        }

        return $object;
    }
}
