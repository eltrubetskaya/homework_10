<?php

namespace Veta\HomeworkBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Veta\HomeworkBundle\Entity\Tag;
use Veta\HomeworkBundle\Form\TagType;

class TagController extends Controller
{
    /**
     * Show all Tag
     *
     * @Route("/tag", name="index")
     * @Method("GET")
     *
     * @return Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tags = $em->getRepository('VetaHomeworkBundle:Tag')->findOrderedById();

        return $this->render('VetaHomeworkBundle:Tag:index.html.twig', [
            'tags' => $tags,
        ]);
    }

    /**
     * Create data Tag
     *
     * @Route("/tag", name="create")
     * @Method("POST")
     *
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $tag = new Tag();

        $form = $this->createForm(TagType::class, $tag, [
            'action' => $this->generateUrl('veta_homework_tag_create'),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tag = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();


            $em = $this->getDoctrine()->getManager();
            $tags = $em->getRepository('VetaHomeworkBundle:Tag')->findOrderedById();

            return $this->render('VetaHomeworkBundle:Tag:index.html.twig', [
                'action' => 'create',
                'tags' => $tags,
            ]);
        }

        return $this->render('VetaHomeworkBundle:Site:form.html.twig', [
            'form' => $form->createView(),
            'action' => 'Create Tag',
            'li_active' => 'tag',
            'route' => 'veta_homework_tag_delete',

        ]);
    }

    /**
     * View data Tag
     *
     * @Route("/tag", name="view")
     * @Method("GET")
     *
     * @param Request $request
     * @return Response
     */
    public function viewAction(Request $request)
    {
        $id = $request->attributes->get('id');
        $em = $this->getDoctrine()->getManager();
        $tag = $em->getRepository('VetaHomeworkBundle:Tag')->find($id);

        $form = $this->createForm(TagType::class, $tag, [
            'action' => $this->generateUrl('veta_homework_tag_edit', ['id' => $id]),
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        return $this->render('VetaHomeworkBundle:Site:form.html.twig', [
            'form' => $form->createView(),
            'action' => 'Edit Tag',
            'entity' => 'Tag',
            'li_active' => 'tag',
            'id' => $id,
            'route' => 'veta_homework_tag_delete',

        ]);
    }

    /**
     * Edit data Tag
     *
     * @Route("/tag/{id}", name="edit", requirements={"id": "\d+"})
     * @Method("PUT")
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function editAction(Request $request)
    {
        $id = $request->attributes->get('id');
        $em = $this->getDoctrine()->getManager();
        $tag = $em->getRepository('VetaHomeworkBundle:Tag')->find($id);

        $form = $this->createForm(TagType::class, $tag, [
            'action' => $this->generateUrl('veta_homework_tag_edit', ['id' => $id]),
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tag = $form->getData();
            $em->persist($tag);
            $em->flush();

            $em = $this->getDoctrine()->getManager();
            $tags = $em->getRepository('VetaHomeworkBundle:Tag')->findOrderedById();

            return $this->render('VetaHomeworkBundle:Tag:index.html.twig', [
                'tags' => $tags,
                'message' => 'Edit Tag with id '.$id,
            ]);
        }
    }

    /**
     * Delete Tag
     *
     * @Route("/tag/{id}", name="delete", requirements={"id": "\d+"})
     * @Method("DELETE")
     *
     * @param Tag $tag
     * @return Response
     * @internal param Request $request
     */
    public function deleteAction(Tag $tag)
    {
        $id = $tag->getId();
        $em = $this->getDoctrine()->getManager();

        $em->remove($tag);
        $em->flush();

        $em = $this->getDoctrine()->getManager();
        $tags = $em->getRepository('VetaHomeworkBundle:Tag')->findOrderedById();

        return $this->render('VetaHomeworkBundle:Tag:index.html.twig', [
            'tags' => $tags,
            'message' => 'Delete Tag with id '.$id,
        ]);
    }
}
