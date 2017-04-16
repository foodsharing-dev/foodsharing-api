<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Context\Context;
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
     * @ApiDoc()
     * @View(statusCode=200)
     * @Get("/api/v1/conversations")
     */
    public function listAction()
    {
        return ['conversations' => $conversations];
    }

    /**
     * Get details on a conversation.
     *
     * @ApiDoc()
     * @Get("/api/v1/conversation/{id}")
     */
    public function getAction(Conversation $conversation)
    {

        $data = ['conversation' => $conversation];
        $context = new Context();
        $view = $this->view($data, 200);
        $context->setGroups(array(
            'conversationDetail',
            'members' => array('profile'),
            'messages' => array('Default', 'conversationDetail', 'sentBy' => array('userId'))
        ));
        $view->setContext($context);
        return $view;
        //        return $data;
    }
}
