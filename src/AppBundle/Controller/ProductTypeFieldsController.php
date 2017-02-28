<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProductTypeFields;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Producttypefield controller.
 *
 * @Route("producttypefields")
 */
class ProductTypeFieldsController extends Controller
{
    /**
     * Lists all productTypeField entities.
     *
     * @Route("/", name="producttypefields_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $productTypeFields = $em->getRepository('AppBundle:ProductTypeFields')->findAll();

        return $this->render('producttypefields/index.html.twig', array(
            'productTypeFields' => $productTypeFields,
        ));
    }

    /**
     * Creates a new productTypeField entity.
     *
     * @Route("/new", name="producttypefields_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $productTypeField = new ProductTypeFields();

        $form = $this->createForm('AppBundle\Form\ProductTypeFieldsType', $productTypeField);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($productTypeField);
            $em->flush($productTypeField);

            return $this->redirectToRoute('producttypefields_show', array('id' => $productTypeField->getId()));
        }

        return $this->render('producttypefields/new.html.twig', array(
            'productTypeField' => $productTypeField,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a productTypeField entity.
     *
     * @Route("/{id}", name="producttypefields_show")
     * @Method("GET")
     */
    public function showAction(ProductTypeFields $productTypeField)
    {
        $deleteForm = $this->createDeleteForm($productTypeField);

        return $this->render('producttypefields/show.html.twig', array(
            'productTypeField' => $productTypeField,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing productTypeField entity.
     *
     * @Route("/{id}/edit", name="producttypefields_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProductTypeFields $productTypeField)
    {
        $deleteForm = $this->createDeleteForm($productTypeField);
        $editForm = $this->createForm('AppBundle\Form\ProductTypeFieldsType', $productTypeField);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('producttypefields_edit', array('id' => $productTypeField->getId()));
        }

        return $this->render('producttypefields/edit.html.twig', array(
            'productTypeField' => $productTypeField,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a productTypeField entity.
     *
     * @Route("/{id}", name="producttypefields_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProductTypeFields $productTypeField)
    {
        $form = $this->createDeleteForm($productTypeField);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($productTypeField);
            $em->flush($productTypeField);
        }

        return $this->redirectToRoute('producttypefields_index');
    }

    /**
     * Creates a form to delete a productTypeField entity.
     *
     * @param ProductTypeFields $productTypeField The productTypeField entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProductTypeFields $productTypeField)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('producttypefields_delete', array('id' => $productTypeField->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
