<?php

namespace app\components\traits;

trait EnumToArray
{
    /**
     * @return array
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * @return array
     */
    public static function array(): array
    {
        return array_combine(self::values(), self::names());
    }

    /**
     * @return array
     */
    public static function getList(): array
    {
        $types = [];
        foreach (self::cases() as $case) {
            $types[$case->value] = $case->label();
        }
        return $types;
    }

    /**
     * @param $separator
     * @return string
     */
    public function externalId($separator = '_'): string
    {
        $name = lcfirst($this->name);
        $parts = preg_split('/(?=[A-Z])/', $name);
        array_walk($parts, function (&$value, $key) {
            $value = strtolower($value);
        });
        return implode($separator, $parts);
    }

    /**
     * @param $value
     * @return int|string|null
     */
    public static function getKeyByValue($value)
    {
        $value = ucfirst($value);
        $valueList = array_flip(self::array());

        if (isset($valueList[$value])) {
            return $valueList[$value];
        }
        return null;
    }
}
