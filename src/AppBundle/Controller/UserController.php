<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use AppBundle\Entity\Foodsaver;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class UserController extends FOSRestController
{
    /**
     * Show details on a user
     * @ApiDoc()
     * @Get("/api/v1/users")
     */
    public function listAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Foodsaver');
        $foodsavers = $repository->findAll();
        return array('users' => $foodsavers);
    }
}
