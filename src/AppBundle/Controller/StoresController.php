<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\Security\Core\User\UserInterface;
use AppBundle\Entity\User;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class StoresController extends FOSRestController
{
    /**
     * List all stores of the logged in user.
     *
     * @ApiDoc()
     * @View(statusCode=200, serializerGroups={"userId", "storeDetail", "conversationList"})
     * @Get("/api/v1/stores")
     */
    public function listNextAction(UserInterface $user = null)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Store');
        $stores = $repository->findAllForUserOrderedByName($user->getId());
        return ['stores' => $stores];
    }
}
