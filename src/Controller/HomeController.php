<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use App\Form\PostType;
use App\Handler\CommentHandler;
use App\Handler\PostHandler;
use App\Repository\PostRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/', name: 'home')]
    public function index(
        PostRepository $postRepository,
        Request $request,
        PostHandler $postHandler
    ): Response {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($this->getUser()) {
            /** @var User $user */
            $user = $this->getUser();
            $post->setAuthor($user);
        }
        if ($postHandler->handle($request, $post)) {
            return $this->redirectToRoute('home');
        }
         $page = $request->get('page', 1);
         $limit = $request->get('limit', 10);
         $posts = $postRepository->getAllPosts($page, $limit);
         $pages = ceil($posts->count()/ $limit);
         $range = range(
             max($page - 3, 1),
             min($page +3, $pages)
         );
        foreach ($posts as $post) {
            $differenceDate = $this->differenceDate($post->getPublishedAt());
            $post->setDescription($differenceDate);
        }

         return $this->render('ui/index.html.twig', [
             'posts' => $posts,
             'pages' => $pages,
             'page' => $page,
             'limit' => $limit,
             'range' => $range,
             'form' => $postHandler->createView(),
         ]);
    }

    #[Route('post/{id}', name: 'post_show', methods: ['GET', 'POST'])]
    public function show(Request $request, Post $post, CommentHandler $commentHandler): Response
    {
        if (!$this->security->getUser()) {
            $this->redirectToRoute('app_login');
        }
        $comment = new Comment();
        /** @var User $user */
        $user = $this->security->getUser();
        $comment->setAuthor($user);
        $comment->setPost($post);
        if ($commentHandler->handle($request, $comment)) {
            return $this->redirectToRoute('post_show', [
                'id' => $post->getId()
            ]);
        }
        return $this->render('post/post.html.twig', [
            'post' => $post,
            'form' => $commentHandler->createView(),
        ]);
    }

    #[Route('post/{id}/edit', name: 'post_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Post $post): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('post/edit.html.twig', [
            'friend' => $post,
            'form' => $form->createView(),
        ]);
    }

    #[Route('post/{id}', name: 'post_delete', methods: ['DELETE'])]
    public function delete(Request $request, Post $post): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home');
    }

    /**
     * @param $date
     * @return string
     */
    private function differenceDate($date): string
    {
        $now = new DateTime();
        $days = $date->diff($now)->format("%d");
        $hours = $date->diff($now)->format("%h");
        if ($days != "0") {
            return $days . ' days';
        } elseif ($hours != "0") {
            return $hours . ' hours';
        } else {
            return $date->diff($now)->format("%i minutes");
        }
    }
}
