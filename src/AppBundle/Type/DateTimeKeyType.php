<?php
namespace AppBundle\Type;
// http://stackoverflow.com/questions/17125863/symfony-doctrine-datetime-as-primary-key
class DateTimeKey extends \DateTime{
    function __toString() {
        return $this->format('c');
    }

    static function fromDateTime(\DateTime $dateTime) {
        return new static($dateTime->format('c'));
    }
}

class DateTimeKeyType extends \Doctrine\DBAL\Types\DateTimeType{
    public function convertToPHPValue($value, \Doctrine\DBAL\Platforms\AbstractPlatform $platform) {
        $value = parent::convertToPHPValue($value, $platform);
        if ($value !== NULL) {
            $value = DateTimeKey::fromDateTime($value);
        }
        return $value;
    }
    public function getName()
    {
        return 'DateTimeKey';
    }
}
