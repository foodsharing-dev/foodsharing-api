<?php
namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\View;
use JMS\Serializer\SerializationContext;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthenticationController extends FOSRestController
{
    /**
     * Login!
     *
     * @ApiDoc(
     *  parameters={
     *      {"name"="email", "dataType"="string", "required"=true, "description"="email address"},
     *      {"name"="password", "dataType"="string", "required"=true, "description"="password"}
     *  }
     * )
     * @View(statusCode=200, serializerGroups={"ownUser"})
     * @Post("/api/v1/session")
     */
    public function postAction(UserInterface $user = null)
    {
        // actual login is handle with Guard and FoodsharingAuthenticator
        return ['user' => $user];
    }

    /**
     * Retrieve status of session
     *
     * @ApiDoc()
     * @View(statusCode=200, serializerGroups={"ownUser"})
     * @Get("/api/v1/session")
     */
    public function getAction(UserInterface $user = null)
    {
        return ['user' => $user];
    }

    /**
     * Logout!
     *
     * @ApiDoc()
     * @Delete("/api/v1/session")
     */
    public function logoutAction()
    {
        /* Explicit logout as firewall component does not support HTTP method filtering yet.
          TODO: Add no cookie clearing support yet
        */
        $this->get("session")->invalidate();
        $this->get("security.token_storage")->setToken(null);
        return ['message' => 'You are now logged out!'];
    }
}
