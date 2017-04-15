<?php
namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Post;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

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
     * @Post("/api/v1/login")
     */
    public function loginAction()
    {
        // actual login is handle with Guard and FoodsharingAuthenticator
        return array('message' => 'You are logged in!');
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
