<?php
/**
 * Created by PhpStorm.
 * User: sekaherve
 * Date: 2019-04-08
 * Time: 13:57
 */

namespace App\Form\DataTransformer;

use App\Entity\Article;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleToStringTransformer implements DataTransformerInterface {

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function transform($article) {

        if($article === null && ! $article instanceof Article) {
            return '';
        }

        return (string) $article->getTitle();
    }

    public function reverseTransform($article) {

        if($article === null) {
            throw new TransformationFailedException('Vous devez fournir un article !');
        }

        $article = $this->manager
            ->getRepository('App:Article')->find($article);
//        print_r($article->getTitle());die();
        return $article;

    }

}