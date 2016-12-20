<?php

namespace Veta\HomeworkBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Veta\HomeworkBundle\Entity\Theme;
use Veta\HomeworkBundle\Form\ThemeType;

class ThemeController extends Controller
{

    /**
     * Show all Themes
     *
     * @Route("/theme", name="index")
     * @Method("GET")
     *
     * @return Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $themes = $em->getRepository('VetaHomeworkBundle:Theme')->findOrderedById();

        return $this->render('VetaHomeworkBundle:Theme:index.html.twig', [
            'themes' => $themes,
        ]);
    }

    /**
     * Create data Theme
     *
     * @Route("/theme", name="create")
     * @Method("POST")
     *
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $theme = new Theme();

        $form = $this->createForm(ThemeType::class, $theme, [
            'action' => $this->generateUrl('veta_homework_theme_create'),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $theme = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($theme);
            $em->flush();


            $em = $this->getDoctrine()->getManager();
            $themes = $em->getRepository('VetaHomeworkBundle:Theme')->findOrderedById();

            return $this->render('VetaHomeworkBundle:Theme:index.html.twig', [
                'action' => 'create',
                'themes' => $themes,
            ]);
        }

        return $this->render('VetaHomeworkBundle:Site:form.html.twig', [
            'form' => $form->createView(),
            'action' => 'Create Theme',
            'li_active' => 'theme',
            'route' => 'veta_homework_theme_delete',

        ]);
    }

    /**
     * View data Theme
     *
     * @Route("/theme", name="view")
     * @Method("GET")
     *
     * @param Request $request
     * @return Response
     */
    public function viewAction(Request $request)
    {
        $id = $request->attributes->get('id');
        $em = $this->getDoctrine()->getManager();
        $theme = $em->getRepository('VetaHomeworkBundle:Theme')->find($id);

        $form = $this->createForm(ThemeType::class, $theme, [
            'action' => $this->generateUrl('veta_homework_theme_edit', ['id' => $id]),
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        return $this->render('VetaHomeworkBundle:Site:form.html.twig', [
            'form' => $form->createView(),
            'action' => 'Edit Theme',
            'entity' => 'Theme',
            'li_active' => 'theme',
            'id' => $id,
            'route' => 'veta_homework_theme_delete',

        ]);
    }

    /**
     * Edit data Theme
     *
     * @Route("/theme/{id}", name="edit", requirements={"id": "\d+"})
     * @Method("PUT")
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function editAction(Request $request)
    {
        $id = $request->attributes->get('id');
        $em = $this->getDoctrine()->getManager();
        $theme = $em->getRepository('VetaHomeworkBundle:Theme')->find($id);

        $form = $this->createForm(ThemeType::class, $theme, [
            'action' => $this->generateUrl('veta_homework_theme_edit', ['id' => $id]),
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $theme = $form->getData();
            $em->persist($theme);
            $em->flush();

            $em = $this->getDoctrine()->getManager();
            $themes = $em->getRepository('VetaHomeworkBundle:Theme')->findOrderedById();

            return $this->render('VetaHomeworkBundle:Theme:index.html.twig', [
                'themes' => $themes,
                'message' => 'Edit theme with id '.$id,
            ]);
        }
    }

    /**
     * Delete Theme
     *
     * @Route("/theme/{id}", name="delete", requirements={"id": "\d+"})
     * @Method("DELETE")
     *
     * @param Theme $theme
     * @return Response
     * @internal param Request $request
     */
    public function deleteAction(Theme $theme)
    {
        $id = $theme->getId();
        $em = $this->getDoctrine()->getManager();

        $em->remove($theme);
        $em->flush();

        $em = $this->getDoctrine()->getManager();
        $themes = $em->getRepository('VetaHomeworkBundle:Theme')->findOrderedById();

        return $this->render('VetaHomeworkBundle:Theme:index.html.twig', [
            'themes' => $themes,
            'message' => 'Delete theme with id '.$id,
        ]);
    }
}
