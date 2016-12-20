<?php

namespace Veta\HomeworkBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Veta\HomeworkBundle\Entity\UserAdmin;
use Veta\HomeworkBundle\Form\UserAdminType;

class UserAdminController extends Controller
{
    /**
     * Show all UsersAdmin
     *
     * @Route("/useradmin", name="index")
     * @Method("GET")
     *
     * @return Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $usersAdmin = $em->getRepository('VetaHomeworkBundle:UserAdmin')->findOrderedById();

        return $this->render('VetaHomeworkBundle:UserAdmin:index.html.twig', [
            'usersAdmin' => $usersAdmin,
        ]);
    }

    /**
     * Create data UserAdmin
     *
     * @Route("/useradmin", name="create")
     * @Method("POST")
     *
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $userAdmin = new UserAdmin();

        $form = $this->createForm(UserAdminType::class, $userAdmin, [
            'action' => $this->generateUrl('veta_homework_useradmin_create'),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userAdmin = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($userAdmin);
            $em->flush();


            $em = $this->getDoctrine()->getManager();
            $usersAdmin = $em->getRepository('VetaHomeworkBundle:UserAdmin')->findOrderedById();

            return $this->render('VetaHomeworkBundle:UserAdmin:index.html.twig', [
                'action' => 'create',
                'usersAdmin' => $usersAdmin,
            ]);
        }

        return $this->render('VetaHomeworkBundle:Site:form.html.twig', [
            'form' => $form->createView(),
            'action' => 'Create UserAdmin',
            'li_active' => 'useradmin',
            'route' => 'veta_homework_useradmin_delete',

        ]);
    }

    /**
     * View data UserAdmin
     *
     * @Route("/useradmin", name="view")
     * @Method("GET")
     *
     * @param Request $request
     * @return Response
     */
    public function viewAction(Request $request)
    {
        $id = $request->attributes->get('id');
        $em = $this->getDoctrine()->getManager();
        $userAdmin = $em->getRepository('VetaHomeworkBundle:UserAdmin')->find($id);

        $form = $this->createForm(UserAdminType::class, $userAdmin, [
            'action' => $this->generateUrl('veta_homework_useradmin_edit', ['id' => $id]),
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        return $this->render('VetaHomeworkBundle:Site:form.html.twig', [
            'form' => $form->createView(),
            'action' => 'Edit UserAdmin',
            'entity' => 'UserAdmin',
            'li_active' => 'useradmin',
            'id' => $id,
            'route' => 'veta_homework_useradmin_delete',

        ]);
    }

    /**
     * Edit data UserAdmin
     *
     * @Route("/useradmin/{id}", name="edit", requirements={"id": "\d+"})
     * @Method("PUT")
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function editAction(Request $request)
    {
        $id = $request->attributes->get('id');
        $em = $this->getDoctrine()->getManager();
        $userAdmin = $em->getRepository('VetaHomeworkBundle:UserAdmin')->find($id);

        $form = $this->createForm(UserAdminType::class, $userAdmin, [
            'action' => $this->generateUrl('veta_homework_useradmin_edit', ['id' => $id]),
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userAdmin = $form->getData();
            $em->persist($userAdmin);
            $em->flush();

            $em = $this->getDoctrine()->getManager();
            $usersAdmin = $em->getRepository('VetaHomeworkBundle:UserAdmin')->findOrderedById();

            return $this->render('VetaHomeworkBundle:UserAdmin:index.html.twig', [
                'usersAdmin' => $usersAdmin,
                'message' => 'Edit UserAdmin with id '.$id,
            ]);
        }
    }

    /**
     * Delete UserAdmin
     *
     * @Route("/useradmin/{id}", name="delete", requirements={"id": "\d+"})
     * @Method("DELETE")
     *
     * @param UserAdmin $userAdmin
     * @return Response
     * @internal param Request $request
     */
    public function deleteAction(UserAdmin $userAdmin)
    {
        $id = $userAdmin->getId();
        $em = $this->getDoctrine()->getManager();

        $em->remove($userAdmin);
        $em->flush();

        $em = $this->getDoctrine()->getManager();
        $usersAdmin = $em->getRepository('VetaHomeworkBundle:UserAdmin')->findOrderedById();

        return $this->render('VetaHomeworkBundle:UserAdmin:index.html.twig', [
            'usersAdmin' => $usersAdmin,
            'message' => 'Delete UserAdmin with id '.$id,
        ]);
    }
}
