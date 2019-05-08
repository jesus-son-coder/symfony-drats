<?php

namespace App\Event;

use Symfony\Component\EventDispatcher\Event;
use App\Entity\Comment;

class CommentPublishedEvent extends Event
{
    private $_comment;

    const NAME = "comment.published";

    public function __construct(Comment $comment)
    {
        $this->_comment = $comment;
    }

    public function getComment()
    {
        return $this->_comment;
    }

    public function getArticle()
    {
        $this->_comment->getArticle();
    }

}