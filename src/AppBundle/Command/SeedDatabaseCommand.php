<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use AppBundle\Util\FactoryMuffin;
use AppBundle\Entity\User;

class SeedDatabaseCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('fs:seed')
            ->setDescription('Adds some seed data to db.')
            ->setHelp('Useful for development...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $manager = $this->getContainer()->get('doctrine.orm.entity_manager');
        FactoryMuffin::init($manager);
        $users = FactoryMuffin::seed(10, 'AppBundle\Entity\User', ['role' => User::ROLE_FOODSAVER]);
        foreach ($users as $user)
        {
            echo 'name: '. $user->getFirstName() . " " . $user->getLastName() . "\n";
            echo 'email: '. $user->getEmail() . "\n";
            echo 'password: '. $user->clearPassword . "\n";
            echo "\n";
        }
        echo "Created some users! Although did not add them to a group or anything...\n";
    }
}