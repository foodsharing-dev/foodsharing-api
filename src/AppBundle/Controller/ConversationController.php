<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Context\Context;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\User;
use AppBundle\Entity\Conversation;
use AppBundle\Entity\ConversationMessage;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ConversationController extends FOSRestController
{
    /**
     * List all conversations the logged in user is active in.
     * Conversations will be ordered (conversation with most recent message first) as well as
     * limited.
     *
     * Take care: Message body has htmlentities applied to it!
     * @ApiDoc()
     * @View(statusCode=200, serializerGroups={"profile", "messageDetail", "conversationList"})
     * @Get("/api/v1/conversations")
     */
    public function listAction(UserInterface $user = null)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Conversation');
        $conversations = $repository->findForUserOrderedByLastMessageDesc($user->getId());
        return ['conversations' => $conversations];
    }

    /**
     * Get details on a conversation.
     *
     * Take care: Message body has htmlentities applied to it!
     * @ApiDoc()
     * @Get("/api/v1/conversations/{id}")
     * @Security("conversation.isMember(user)")
     */
    public function getAction(Conversation $conversation)
    {
        $data = ['conversation' => $conversation];
        $view = $this->view($data, 200);
        $context = new Context();
        $context->setGroups(array(
            'conversationDetail',
            'members' => array('profile'),
            'messages' => array('Default', 'conversationDetail', 'sentBy' => array('userId'))
        ));
        $view->setContext($context);
        return $view;
    }
}
