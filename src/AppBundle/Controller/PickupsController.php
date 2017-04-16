<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\Security\Core\User\UserInterface;
use AppBundle\Entity\User;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class PickupsController extends FOSRestController
{
    /**
     * List all future pickups of the logged in user.
     * Pickups will be ordered by date, first first, starting with a pickup in the short past.
     *
     * @ApiDoc()
     * @View(statusCode=200, serializerGroups={"userId", "pickupDetail", "storeDetail", "conversationList"})
     * @Get("/api/v1/pickups/next")
     */
    public function listNextAction(UserInterface $user = null)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:TakenPickup');
        $pickups = $repository->findNextForUserOrderedByDate($user->getId());
        return ['pickups' => $pickups];
    }

    /**
     * Gets a single pickup detail.
     * The pickup is identified by store and date, what actually means that the identifier may change when the date is moved.
     * Currently, this does only add information about taken pickup slots.
     *
     * @ApiDoc()
     * @View(statusCode=200, serializerGroups={"profile", "userProfileStore", "pickupDetail", "storeDetail"}))
     * @Get("/api/v1/pickups/{store}:{at}")
     */
    public function getAction($store, \DateTime $at, UserInterface $user = null)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:TakenPickup');
        $pickup = $repository->getPickupDetails($store, $at);
        return ['pickup' => $pickup];
    }
}
