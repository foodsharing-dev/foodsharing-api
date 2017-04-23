<?php
namespace AppBundle\Factory;

use League\FactoryMuffin\Faker\Facade as Faker;
use AppBundle\Entity\StoreFetchWeight;

$fm->define(StoreFetchWeight::class)->setDefinitions([
    'averageWeight' => Faker::randomFloat(1, 0, 999)
    ]
);
