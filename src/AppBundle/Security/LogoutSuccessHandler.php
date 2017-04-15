<?php
namespace AppBundle\Security;

use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class LogoutSuccessHandler implements LogoutSuccessHandlerInterface
{
    public function onLogoutSuccess(Request $request)
    {
      return new JsonResponse(array('message' => 'You are now logged out!'));
    }
}
