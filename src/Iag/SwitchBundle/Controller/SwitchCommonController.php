<?php

namespace Iag\SwitchBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Iag\SwitchBundle\Entity\SwitchCommon;
use Iag\SwitchBundle\Form\SwitchCommonType;

/**
 * SwitchCommon controller.
 *
 */
class SwitchCommonController extends Controller
{

    /**
     * Lists all SwitchCommon entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IagSwitchBundle:SwitchCommon')->findAll();

        return $this->render('IagSwitchBundle:SwitchCommon:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SwitchCommon entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SwitchCommon();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('switchcommon_show', array('id' => $entity->getId())));
        }

        return $this->render('IagSwitchBundle:SwitchCommon:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SwitchCommon entity.
     *
     * @param SwitchCommon $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SwitchCommon $entity)
    {
        $form = $this->createForm(new SwitchCommonType(), $entity, array(
            'action' => $this->generateUrl('switchcommon_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SwitchCommon entity.
     *
     */
    public function newAction()
    {
        $entity = new SwitchCommon();
        $form   = $this->createCreateForm($entity);

        return $this->render('IagSwitchBundle:SwitchCommon:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SwitchCommon entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagSwitchBundle:SwitchCommon')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SwitchCommon entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IagSwitchBundle:SwitchCommon:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SwitchCommon entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagSwitchBundle:SwitchCommon')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SwitchCommon entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IagSwitchBundle:SwitchCommon:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SwitchCommon entity.
    *
    * @param SwitchCommon $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SwitchCommon $entity)
    {
        $form = $this->createForm(new SwitchCommonType(), $entity, array(
            'action' => $this->generateUrl('switchcommon_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SwitchCommon entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagSwitchBundle:SwitchCommon')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SwitchCommon entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('switchcommon_edit', array('id' => $id)));
        }

        return $this->render('IagSwitchBundle:SwitchCommon:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SwitchCommon entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IagSwitchBundle:SwitchCommon')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SwitchCommon entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('switchcommon'));
    }

    /**
     * Creates a form to delete a SwitchCommon entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('switchcommon_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
