<?php

namespace Veta\HomeworkBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Veta\HomeworkBundle\Entity\User;
use Veta\HomeworkBundle\Form\UserType;

class UserController extends Controller
{
    /**
     * Show all Users
     *
     * @Route("/user", name="index")
     * @Method("GET")
     *
     * @return Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('VetaHomeworkBundle:User')->findOrderedById();

        return $this->render('VetaHomeworkBundle:User:index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * Create data User
     *
     * @Route("/user", name="create")
     * @Method("POST")
     *
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user, [
            'action' => $this->generateUrl('veta_homework_user_create'),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();


            $em = $this->getDoctrine()->getManager();
            $users = $em->getRepository('VetaHomeworkBundle:User')->findOrderedById();

            return $this->render('VetaHomeworkBundle:User:index.html.twig', [
                'action' => 'create',
                'users' => $users,
            ]);
        }

        return $this->render('VetaHomeworkBundle:Site:form.html.twig', [
            'form' => $form->createView(),
            'action' => 'Create User',
            'li_active' => 'user',
            'route' => 'veta_homework_user_delete',

        ]);
    }

    /**
     * View data User
     *
     * @Route("/user", name="view")
     * @Method("GET")
     *
     * @param Request $request
     * @return Response
     */
    public function viewAction(Request $request)
    {
        $id = $request->attributes->get('id');
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('VetaHomeworkBundle:User')->find($id);

        $form = $this->createForm(UserType::class, $user, [
            'action' => $this->generateUrl('veta_homework_user_edit', ['id' => $id]),
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        return $this->render('VetaHomeworkBundle:Site:form.html.twig', [
            'form' => $form->createView(),
            'action' => 'Edit User',
            'entity' => 'User',
            'li_active' => 'user',
            'id' => $id,
            'route' => 'veta_homework_user_delete',

        ]);
    }

    /**
     * Edit data User
     *
     * @Route("/user/{id}", name="edit", requirements={"id": "\d+"})
     * @Method("PUT")
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function editAction(Request $request)
    {
        $id = $request->attributes->get('id');
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('VetaHomeworkBundle:User')->find($id);

        $form = $this->createForm(UserType::class, $user, [
            'action' => $this->generateUrl('veta_homework_user_edit', ['id' => $id]),
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $em->persist($user);
            $em->flush();

            $em = $this->getDoctrine()->getManager();
            $users = $em->getRepository('VetaHomeworkBundle:User')->findOrderedById();

            return $this->render('VetaHomeworkBundle:User:index.html.twig', [
                'users' => $users,
                'message' => 'Edit User with id '.$id,
            ]);
        }
    }

    /**
     * Delete User
     *
     * @Route("/user/{id}", name="delete", requirements={"id": "\d+"})
     * @Method("DELETE")
     *
     * @param User $user
     * @return Response
     * @internal param Request $request
     */
    public function deleteAction(User $user)
    {
        $id = $user->getId();
        $em = $this->getDoctrine()->getManager();

        $em->remove($user);
        $em->flush();

        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('VetaHomeworkBundle:User')->findOrderedById();

        return $this->render('VetaHomeworkBundle:User:index.html.twig', [
            'users' => $users,
            'message' => 'Delete User with id '.$id,
        ]);
    }
}
