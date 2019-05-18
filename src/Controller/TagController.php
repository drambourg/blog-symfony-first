<?php

namespace App\Controller;

use App\Repository\TagRepository;
use App\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
    /**
     * @var TagRepository
     */
    private $repository;

    public function __construct(TagRepository $repository)
    {

        $this->repository = $repository;
    }

    /**
     * @Route("/tag", name="tag")
     */
    public function index()
    {
        $tags = $this->repository->findAll();
        return $this->render('tag/index.html.twig', [
            'controller_name' => 'TagController',
            'tags' => $tags,
        ]);
    }

    /**
     * @Route("/tag/{name}", name="tag")
     * @param Tag $tag
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Tag $tag)
    {
        if (!$tag) {
            throw $this
                ->createNotFoundException('No tag has been sent to find a category in article\'s table.');
        }

        $articles = $tag->getArticles();

        return $this->render('tag/show.html.twig', [
            'controller_name' => 'TagController',
            'tag' => $tag,
            'articles' => $articles,
        ]);
    }
}
