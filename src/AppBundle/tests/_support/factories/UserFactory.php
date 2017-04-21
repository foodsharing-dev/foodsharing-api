<?php
use League\FactoryMuffin\Faker\Facade as Faker;
use AppBundle\Entity\User as User;
use AppBundle\Foodsharing;

$fm->define(User::class)->setDefinitions([
    'firstName'   => Faker::firstName(),
    'lastName'   => Faker::lastName(),
    'email'  => Faker::email(),
    'clearPassword' => Faker::password(),
    'verified' => true,
    'active' => true,
    'password' => function ($object, $saved) {
        return Foodsharing::pw_hash($object->getEmail(), $object->clearPassword);
    }
    ]
);
