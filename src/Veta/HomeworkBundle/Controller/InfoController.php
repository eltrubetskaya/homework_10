<?php

namespace Veta\HomeworkBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Veta\HomeworkBundle\Entity\Info;
use Veta\HomeworkBundle\Form\InfoType;

class InfoController extends Controller
{
    /**
     * Show all Info Pages
     *
     * @Route("/info", name="index")
     * @Method("GET")
     *
     * @return Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pages = $em->getRepository('VetaHomeworkBundle:Info')->findOrderedById();

        return $this->render('VetaHomeworkBundle:Info:index.html.twig', [
            'pages' => $pages,
        ]);
    }

    /**
     * Create data Info Page
     *
     * @Route("/info", name="create")
     * @Method("POST")
     *
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $page = new Info();

        $form = $this->createForm(InfoType::class, $page, [
            'action' => $this->generateUrl('veta_homework_info_create'),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $page = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush();


            $em = $this->getDoctrine()->getManager();
            $pages = $em->getRepository('VetaHomeworkBundle:Info')->findOrderedById();

            return $this->render('VetaHomeworkBundle:Info:index.html.twig', [
                'action' => 'create',
                'pages' => $pages,
            ]);
        }

        return $this->render('VetaHomeworkBundle:Site:form.html.twig', [
            'form' => $form->createView(),
            'action' => 'Create Info Page',
            'li_active' => 'info',
            'route' => 'veta_homework_info_delete',

        ]);
    }

    /**
     * View data Info Page
     *
     * @Route("/info", name="view")
     * @Method("GET")
     *
     * @param Request $request
     * @return Response
     */
    public function viewAction(Request $request)
    {
        $id = $request->attributes->get('id');
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('VetaHomeworkBundle:Info')->find($id);

        $form = $this->createForm(InfoType::class, $page, [
            'action' => $this->generateUrl('veta_homework_info_edit', ['id' => $id]),
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        return $this->render('VetaHomeworkBundle:Site:form.html.twig', [
            'form' => $form->createView(),
            'action' => 'Edit Info Page',
            'entity' => 'Info',
            'li_active' => 'info',
            'id' => $id,
            'route' => 'veta_homework_info_delete',

        ]);
    }

    /**
     * Edit data Info Page
     *
     * @Route("/info/{id}", name="edit", requirements={"id": "\d+"})
     * @Method("PUT")
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function editAction(Request $request)
    {
        $id = $request->attributes->get('id');
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('VetaHomeworkBundle:Info')->find($id);

        $form = $this->createForm(InfoType::class, $page, [
            'action' => $this->generateUrl('veta_homework_info_edit', ['id' => $id]),
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $page = $form->getData();
            $em->persist($page);
            $em->flush();

            $em = $this->getDoctrine()->getManager();
            $pages = $em->getRepository('VetaHomeworkBundle:Info')->findOrderedById();

            return $this->render('VetaHomeworkBundle:Info:index.html.twig', [
                'pages' => $pages,
                'message' => 'Edit Info Page with id '.$id,
            ]);
        }
    }

    /**
     * Delete Info Page
     *
     * @Route("/info/{id}", name="delete", requirements={"id": "\d+"})
     * @Method("DELETE")
     *
     * @param Info $page
     * @return Response
     * @internal param Request $request
     */
    public function deleteAction(Info $page)
    {
        $id = $page->getId();
        $em = $this->getDoctrine()->getManager();

        $em->remove($page);
        $em->flush();

        $em = $this->getDoctrine()->getManager();
        $pages = $em->getRepository('VetaHomeworkBundle:Info')->findOrderedById();

        return $this->render('VetaHomeworkBundle:Info:index.html.twig', [
            'pages' => $pages,
            'message' => 'Delete Info Page with id '.$id,
        ]);
    }
}
