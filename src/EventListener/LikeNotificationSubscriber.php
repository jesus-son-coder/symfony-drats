<?php


namespace App\EventListener;


use App\Entity\LikeNotification;
use App\Entity\MicroPost;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\PersistentCollection;

class LikeNotificationSubscriber implements EventSubscriber
{

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return string[]
     */
    public function getSubscribedEvents()
    {
        return [
            Events::onFlush
        ];
    }

    public function onFlush(OnFlushEventArgs $args)
    {
        $em = $args->getEntityManager();

        /* UnitOfWork keeps track of all the changes that are made to all the different entities, that include persisting a new entity, modifying its property, or adding elements to different collections.
        That's why we would have to read in the UnitOfWork if a certain collection did change : */
        $uow = $em->getUnitOfWork();

        /* "getScheduledCollectionUpdate": returns a list of all the persitant Collection Objects or Objects that actually implement the Doctrine Collection interface.
            And from that list, we would read if it has any new elements,
            and we will check to which Entity and to which entity's Field it is actually related : */
        /** @var PersistentCollection $collectionUpdate */
        foreach ($uow->getScheduledCollectionUpdates() as $collectionUpdate) {
            if (!$collectionUpdate->getOwner() instanceof MicroPost) {
                continue;
            }

            // Check the actual field's name on the Owner entity that the collection of was modified :
            if('likedBy' !== $collectionUpdate->getMapping()['fieldName']) {
                continue;
            } /* After that, we are now sure that the collection is reprensented by the 'likedBy' field of the MicroPst entity... */

            /* Below, "getInsertDriff" would give an array of elements that are added newly to the collection. */
            $insertDiff = $collectionUpdate->getInsertDiff();

            if(!count($insertDiff)){
                return;
            }

            /** @var MicroPost $microPost */
            $microPost = $collectionUpdate->getOwner();

            $notification = new LikeNotification();
            $notification->setUser($microPost->getUser());
            $notification->setMicroPost($microPost);
            $notification->setLikedBy(reset($insertDiff));

            $em->persist($notification);

            $uow->computeChangeSet(
                $em->getClassMetadata(LikeNotification::class),
                $notification
            );
        }

    }
}