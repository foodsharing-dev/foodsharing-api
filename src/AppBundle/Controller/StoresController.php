<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\User;
use AppBundle\Entity\Store;
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
    public function listAction(UserInterface $user = null)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Store');
        $stores = $repository->findAllForUserOrderedByName($user->getId());
        return ['stores' => $stores];
    }

    /**
     * Get detailed information on a specific store.
     *
     * @ApiDoc()
     * @View(statusCode=200, serializerGroups={"profile", "userProfileStore", "storeDetail", "conversationList"})
     * @Get("/api/v1/stores/{id}")
     * @Security("is_granted('view', store)")
     */
    public function getAction(Store $store)
    {
        return ['stores' => $store];
    }


}
