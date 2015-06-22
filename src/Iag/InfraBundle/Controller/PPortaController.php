<?php

namespace Iag\InfraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Iag\InfraBundle\Entity\PPorta;
use Iag\InfraBundle\Form\PPortaType;

/**
 * PPorta controller.
 *
 * @Route("/pporta")
 */
class PPortaController extends Controller
{

    /**
     * Lists all PPorta entities.
     *
     * @Route("/", name="pporta")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IagInfraBundle:PPorta')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new PPorta entity.
     *
     * @Route("/", name="pporta_create")
     * @Method("POST")
     * @Template("IagInfraBundle:PPorta:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new PPorta();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pporta_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a PPorta entity.
     *
     * @param PPorta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PPorta $entity)
    {
        $form = $this->createForm(new PPortaType(), $entity, array(
            'action' => $this->generateUrl('pporta_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new PPorta entity.
     *
     * @Route("/new", name="pporta_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PPorta();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PPorta entity.
     *
     * @Route("/{id}", name="pporta_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagInfraBundle:PPorta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PPorta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PPorta entity.
     *
     * @Route("/{id}/edit", name="pporta_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagInfraBundle:PPorta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PPorta entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a PPorta entity.
    *
    * @param PPorta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PPorta $entity)
    {
        $form = $this->createForm(new PPortaType(), $entity, array(
            'action' => $this->generateUrl('pporta_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing PPorta entity.
     *
     * @Route("/{id}", name="pporta_update")
     * @Method("PUT")
     * @Template("IagInfraBundle:PPorta:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagInfraBundle:PPorta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PPorta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pporta_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a PPorta entity.
     *
     * @Route("/{id}", name="pporta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IagInfraBundle:PPorta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PPorta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pporta'));
    }

    public function portasAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('IagInfraBundle:PPorta')->findBy(array('patch' => $id));
        return $this->render('IagInfraBundle:PPorta:index.html.twig', array('entities' =>$entities));
    }
    
    
    /**
     * Creates a form to delete a PPorta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pporta_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
