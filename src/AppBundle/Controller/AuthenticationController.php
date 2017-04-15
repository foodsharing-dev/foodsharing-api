<?php
namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Post;
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
     * @View(statusCode=200, serializerGroups={"own_user"})
     * @Post("/api/v1/login")
     */
    public function loginAction(UserInterface $user = null)
    {
        // actual login is handle with Guard and FoodsharingAuthenticator
        return ['user' => $user];
    }

    /**
     * Logout!
     *
     * @ApiDoc()
     * @Post("/api/v1/logout")
     */
    public function logoutAction()
    {
        // actual logout is handled by security framework
    }
}
