<?php
namespace AppBundle\Factory;


use League\FactoryMuffin\Faker\Facade as Faker;
use AppBundle\Entity\Store;
use AppBundle\Entity\Conversation;
use AppBundle\Entity\Group;
use AppBundle\Entity\StoreFetchWeight;
use AppBundle\Util\Foodsharing;

$fm->define(Store::class)->setDefinitions([
    'name'   => Faker::company(),
    'city'   => Faker::city(),
    'zip'  => Faker::postcode(),
    'street' => Faker::streetName(),
    'streetNumber' => Faker::buildingNumber(),
    'notes' => Faker::optional()->paragraphs(rand(1,2), true),
    'notesPublic' => Faker::optional()->paragraphs(rand(1,2), true),
    'teamConversation' => 'factory|' . Conversation::class,
    'status' => Faker::numberBetween(1,6),
    'district' => 'factory|'. Group::Class,
    'averageFetchWeight' => 'factory|' . StoreFetchWeight::Class
    ]
);
