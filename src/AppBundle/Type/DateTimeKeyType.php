<?php

namespace AppBundle\Type;

// http://stackoverflow.com/questions/17125863/symfony-doctrine-datetime-as-primary-key
class DateTimeKey extends \DateTime
{
    public function __toString()
    {
        return $this->format('c');
    }

    public static function fromDateTime(\DateTime $dateTime)
    {
        return new static($dateTime->format('c'));
    }
}

class DateTimeKeyType extends \Doctrine\DBAL\Types\DateTimeType
{
    public function convertToPHPValue($value, \Doctrine\DBAL\Platforms\AbstractPlatform $platform)
    {
        $value = parent::convertToPHPValue($value, $platform);
        if ($value !== null) {
            $value = DateTimeKey::fromDateTime($value);
        }

        return $value;
    }

    public function getName()
    {
        return 'DateTimeKey';
    }
}
