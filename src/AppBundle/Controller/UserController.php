<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use AppBundle\Entity\User;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class UserController extends FOSRestController
{
    /**
     * Show details on a user
     * @ApiDoc()
     * @View(statusCode=200, serializerGroups={"profile"})
     * @Get("/api/v1/users/{id}")
     */
    public function getAction(User $user)
    {
        return ['user' => $user];
    }
}
