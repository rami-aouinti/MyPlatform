<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Form\CommentType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(PostRepository $postRepository): Response
    {
         return $this->render('ui/index.html.twig', [
            'posts' => $postRepository->findAll(),
         ]);
    }

    #[Route('/comment', name: 'comment')]
    public function addComment(Request $request, $post, $comment)
    {
        if (!$this->getUser()) {
            $this->redirectToRoute('home');
        }
        $comment = new Comment();
        $comment->setAuthor($this->get('security.token_storage')->getToken()->getUser());
        $comment->setPost($post);
        $comment->setComment($comment);
        $comment->setCommentParent(0);
        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        } catch (\Exception $e) {
            return new JsonResponse('error');
        }
        return new JsonResponse('success');
    }
}
