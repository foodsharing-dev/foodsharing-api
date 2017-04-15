<?php
namespace AppBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Bridge\Monolog\Logger;
use AppBundle\Security\Credentials;
class FoodsharingAuthenticator extends AbstractGuardAuthenticator
{
    private $logger;
    private $serializer;
    public function __construct(Logger $logger, $serializer)
    {
      $this->logger = $logger;
      $this->serializer = $serializer;
    }
    /**
     * Called on every request. Return whatever credentials you want,
     * or null to stop authentication.
     */
    public function getCredentials(Request $request)
    {
        if ($request->getPathInfo() != '/api/v1/login' || !$request->isMethod('POST')) {
          return;
        }
        $content = $request->getContent();
        if (!$content) {
          return;
        }
        // TODO: should this not check for the login path too? should only be activate
        // when posting to create a new session
        // TODO: check json content type
        $credentials = $this->serializer->deserialize($content, Credentials::class, 'json');
        if (!$credentials->getEmail() || !$credentials->getPassword()) {
            // no token? Return null and no other methods will be called
            return;
        }
        // What you return here will be passed to getUser() as $credentials
        return $credentials;
    }
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return $userProvider->loadUserByUsername($credentials->getEmail());
    }
    public function checkCredentials($credentials, UserInterface $user)
    {
        $passwd = $this->encryptMd5($user->getEmail(), $credentials->getPassword());
        return hash_equals($user->getPasswd(), $passwd);
    }
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // on success, let the request continue
        return null;
    }
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = array(
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
            // or to translate this message
            // $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
        );
        return new JsonResponse($data, Response::HTTP_FORBIDDEN);
    }
    /**
     * Called when authentication is needed, but it's not sent
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = array(
            // you might translate this message
            'message' => 'Authentication Required'
        );
        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }
    public function supportsRememberMe()
    {
        return false;
    }
    // From existing foodsharing code. Enables compatibility.
    private function encryptMd5($email,$pass)
    {
        $email = strtolower($email);
        return md5($email.'-lz%&lk4-'.$pass);
    }
}
