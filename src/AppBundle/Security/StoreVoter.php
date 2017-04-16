<?php
namespace AppBundle\Security;

use AppBundle\Entity\Store;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class StoreVoter extends Voter
{
    // these strings are just invented: you can use anything
    const VIEW = 'view';

    protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, array(self::VIEW))) {
            return false;
        }

        // only vote on Post objects inside this voter
        if (!$subject instanceof Store) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // you know $subject is a Store object, thanks to supports
        /** @var Store $store */
        $store = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($store, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(Store $store, User $user)
    {
        return $store->isInTeam($user);
    }
}
