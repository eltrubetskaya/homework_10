<?php

namespace Veta\HomeworkBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Veta\HomeworkBundle\Entity\Privilege;
use Veta\HomeworkBundle\Form\PrivilegeType;

class PrivilegeController extends Controller
{
    /**
     * Show all Privileges
     *
     * @Route("/privilege", name="index")
     * @Method("GET")
     *
     * @return Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $privileges = $em->getRepository('VetaHomeworkBundle:Privilege')->findOrderedById();

        return $this->render('VetaHomeworkBundle:Privilege:index.html.twig', [
            'privileges' => $privileges,
        ]);
    }

    /**
     * Create data Privilege
     *
     * @Route("/privilege", name="create")
     * @Method("POST")
     *
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $privilege = new Privilege();

        $form = $this->createForm(PrivilegeType::class, $privilege, [
            'action' => $this->generateUrl('veta_homework_privilege_create'),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $privilege = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($privilege);
            $em->flush();


            $em = $this->getDoctrine()->getManager();
            $privileges = $em->getRepository('VetaHomeworkBundle:Privilege')->findOrderedById();

            return $this->render('VetaHomeworkBundle:Privilege:index.html.twig', [
                'action' => 'create',
                'privileges' => $privileges,
            ]);
        }

        return $this->render('VetaHomeworkBundle:Site:form.html.twig', [
            'form' => $form->createView(),
            'action' => 'Create Privilege',
            'li_active' => 'privilege',
            'route' => 'veta_homework_privilege_delete',

        ]);
    }

    /**
     * View data Privilege
     *
     * @Route("/privilege", name="view")
     * @Method("GET")
     *
     * @param Request $request
     * @return Response
     */
    public function viewAction(Request $request)
    {
        $id = $request->attributes->get('id');
        $em = $this->getDoctrine()->getManager();
        $privilege = $em->getRepository('VetaHomeworkBundle:Privilege')->find($id);

        $form = $this->createForm(PrivilegeType::class, $privilege, [
            'action' => $this->generateUrl('veta_homework_privilege_edit', ['id' => $id]),
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        return $this->render('VetaHomeworkBundle:Site:form.html.twig', [
            'form' => $form->createView(),
            'action' => 'Edit Privilege',
            'entity' => 'Privilege',
            'li_active' => 'privilege',
            'id' => $id,
            'route' => 'veta_homework_privilege_delete',

        ]);
    }

    /**
     * Edit data Privilege
     *
     * @Route("/privilege/{id}", name="edit", requirements={"id": "\d+"})
     * @Method("PUT")
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function editAction(Request $request)
    {
        $id = $request->attributes->get('id');
        $em = $this->getDoctrine()->getManager();
        $privilege = $em->getRepository('VetaHomeworkBundle:Privilege')->find($id);

        $form = $this->createForm(PrivilegeType::class, $privilege, [
            'action' => $this->generateUrl('veta_homework_privilege_edit', ['id' => $id]),
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $privilege = $form->getData();
            $em->persist($privilege);
            $em->flush();

            $em = $this->getDoctrine()->getManager();
            $privileges = $em->getRepository('VetaHomeworkBundle:Privilege')->findOrderedById();

            return $this->render('VetaHomeworkBundle:Privilege:index.html.twig', [
                'privileges' => $privileges,
                'message' => 'Edit Privilege with id '.$id,
            ]);
        }
    }

    /**
     * Delete Privilege
     *
     * @Route("/privilege/{id}", name="delete", requirements={"id": "\d+"})
     * @Method("DELETE")
     *
     * @param Privilege $privilege
     * @return Response
     * @internal param Request $request
     */
    public function deleteAction(Privilege $privilege)
    {
        $id = $privilege->getId();
        $em = $this->getDoctrine()->getManager();

        $em->remove($privilege);
        $em->flush();

        $em = $this->getDoctrine()->getManager();
        $privileges = $em->getRepository('VetaHomeworkBundle:Privilege')->findOrderedById();

        return $this->render('VetaHomeworkBundle:Privilege:index.html.twig', [
            'privileges' => $privileges,
            'message' => 'Delete Privilege with id '.$id,
        ]);
    }
}
