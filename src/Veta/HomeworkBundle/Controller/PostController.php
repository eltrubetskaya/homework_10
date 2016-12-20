<?php

namespace Veta\HomeworkBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Veta\HomeworkBundle\Entity\Post;
use Veta\HomeworkBundle\Form\PostType;

class PostController extends Controller
{
    /**
     * Show all Posts
     *
     * @Route("/post", name="index")
     * @Method("GET")
     *
     * @return Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('VetaHomeworkBundle:Post')->findOrderedById();

        return $this->render('VetaHomeworkBundle:Post:index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * Create data Post
     *
     * @Route("/post", name="create")
     * @Method("POST")
     *
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post, [
            'action' => $this->generateUrl('veta_homework_post_create'),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();


            $em = $this->getDoctrine()->getManager();
            $posts = $em->getRepository('VetaHomeworkBundle:Post')->findOrderedById();

            return $this->render('VetaHomeworkBundle:Post:index.html.twig', [
                'action' => 'create',
                'posts' => $posts,
            ]);
        }

        return $this->render('VetaHomeworkBundle:Site:form.html.twig', [
            'form' => $form->createView(),
            'action' => 'Create Post',
            'li_active' => 'post',
            'route' => 'veta_homework_post_delete',

        ]);
    }

    /**
     * View data Post
     *
     * @Route("/post", name="view")
     * @Method("GET")
     *
     * @param Request $request
     * @return Response
     */
    public function viewAction(Request $request)
    {
        $id = $request->attributes->get('id');
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('VetaHomeworkBundle:Post')->find($id);

        $form = $this->createForm(PostType::class, $post, [
            'action' => $this->generateUrl('veta_homework_post_edit', ['id' => $id]),
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        return $this->render('VetaHomeworkBundle:Site:form.html.twig', [
            'form' => $form->createView(),
            'action' => 'Edit Post',
            'entity' => 'Post',
            'li_active' => 'post',
            'id' => $id,
            'route' => 'veta_homework_post_delete',

        ]);
    }

    /**
     * Edit data Post
     *
     * @Route("/post/{id}", name="edit", requirements={"id": "\d+"})
     * @Method("PUT")
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function editAction(Request $request)
    {
        $id = $request->attributes->get('id');
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('VetaHomeworkBundle:Post')->find($id);

        $form = $this->createForm(PostType::class, $post, [
            'action' => $this->generateUrl('veta_homework_post_edit', ['id' => $id]),
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $em->persist($post);
            $em->flush();

            $em = $this->getDoctrine()->getManager();
            $posts = $em->getRepository('VetaHomeworkBundle:Post')->findOrderedById();

            return $this->render('VetaHomeworkBundle:Post:index.html.twig', [
                'posts' => $posts,
                'message' => 'Edit Post with id '.$id,
            ]);
        }
    }

    /**
     * Delete Post
     *
     * @Route("/post/{id}", name="delete", requirements={"id": "\d+"})
     * @Method("DELETE")
     *
     * @param Post $post
     * @return Response
     * @internal param Request $request
     */
    public function deleteAction(Post $post)
    {
        $id = $post->getId();
        $em = $this->getDoctrine()->getManager();

        $em->remove($post);
        $em->flush();

        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('VetaHomeworkBundle:Post')->findOrderedById();

        return $this->render('VetaHomeworkBundle:Post:index.html.twig', [
            'posts' => $posts,
            'message' => 'Delete Post with id '.$id,
        ]);
    }
}
