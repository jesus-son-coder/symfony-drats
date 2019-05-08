<?php
/**
 * Created by PhpStorm.
 * User: sekaherve
 * Date: 08/05/2019
 * Time: 14:25
 */

namespace App\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CommentPublishedSubscriber implements EventSubscriberInterface
{

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * ['eventName' => 'methodName']
     *  * ['eventName' => ['methodName', $priority]]
     *  * ['eventName' => [['methodName1', $priority], ['methodName2']]]
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            CommentPublishedEvent::NAME => 'onCommentPublished'
        ];

        /* Envents with Priority : */
        /* ----------------------- */
        /*
        return [
            // Event catched => "comment.published"
            CommentPublishedEvent::NAME => [
                // Method 1 with Priority #1 => 1000
                ['onCommentPublished' => 1000],

                // Method 2 with Priority #2 => 500
                ['onCommentUpdated' => 500],

                // Method 3 with Priority #3 => ''
                'onCommentDeleted'
            ]
        ];
        */

    }

    public function onCommentPublished(CommentPublishedEvent $event)
    {

    }
}