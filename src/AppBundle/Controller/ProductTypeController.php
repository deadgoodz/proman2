<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Producttype controller.
 *
 * @Route("producttype")
 */
class ProductTypeController extends Controller
{
    /**
     * Lists all productType entities.
     *
     * @Route("/", name="producttype_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $productTypes = $em->getRepository('AppBundle:ProductType')->findAll();

        return $this->render('producttype/index.html.twig', array(
            'productTypes' => $productTypes,
        ));
    }

    /**
     * Creates a new productType entity.
     *
     * @Route("/new", name="producttype_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $productType = new Producttype();
        $form = $this->createForm('AppBundle\Form\ProductTypeType', $productType);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($productType);
            $em->flush($productType);

            return $this->redirectToRoute('producttype_show', array('id' => $productType->getId()));
        }

        return $this->render('producttype/new.html.twig', array(
            'productType' => $productType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a productType entity.
     *
     * @Route("/{id}", name="producttype_show")
     * @Method("GET")
     */
    public function showAction(ProductType $productType)
    {
        $deleteForm = $this->createDeleteForm($productType);

        return $this->render('producttype/show.html.twig', array(
            'productType' => $productType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing productType entity.
     *
     * @Route("/{id}/edit", name="producttype_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProductType $productType)
    {
        $deleteForm = $this->createDeleteForm($productType);
        $editForm = $this->createForm('AppBundle\Form\ProductTypeType', $productType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('producttype_edit', array('id' => $productType->getId()));
        }

        return $this->render('producttype/edit.html.twig', array(
            'productType' => $productType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a productType entity.
     *
     * @Route("/{id}", name="producttype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProductType $productType)
    {
        $form = $this->createDeleteForm($productType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($productType);
            $em->flush($productType);
        }

        return $this->redirectToRoute('producttype_index');
    }

    /**
     * Creates a form to delete a productType entity.
     *
     * @param ProductType $productType The productType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProductType $productType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('producttype_delete', array('id' => $productType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
