<?php
use League\FactoryMuffin\Faker\Facade as Faker;
use AppBundle\Entity\User as User;
use AppBundle\Foodsharing;


$fm->define(User::class)->setDefinitions([
    'firstName'   => Faker::firstName(),
    'firstName'   => Faker::lastName(),
    'email' => Faker::email(),

    // generate email
    'email'  => Faker::email(),
    'clearPassword' => Faker::password(),
    'body'   => Faker::text(),
    'verified' => true,
    'active' => true,
    'password' => function ($object, $saved) {
        return Foodsharing::pw_hash($object->getEmail(), $object->clearPassword);
    }
    ]
);
