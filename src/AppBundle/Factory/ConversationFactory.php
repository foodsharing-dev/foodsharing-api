<?php
namespace AppBundle\Factory;


use League\FactoryMuffin\Faker\Facade as Faker;
use AppBundle\Entity\Conversation;

$fm->define(Conversation::class)->setDefinitions([
    'name'   => Faker::optional()->words(4, true)
    ]
);
