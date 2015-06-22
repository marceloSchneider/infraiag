<?php

namespace Iag\SwitchBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Iag\SwitchBundle\Entity\SwitchPilha;
use Iag\SwitchBundle\Form\SwitchPilhaType;

/**
 * SwitchPilha controller.
 *
 */
class SwitchPilhaController extends Controller
{

    /**
     * Lists all SwitchPilha entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IagSwitchBundle:SwitchPilha')->findAll();

        return $this->render('IagSwitchBundle:SwitchPilha:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SwitchPilha entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SwitchPilha();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('switchpilha_show', array('id' => $entity->getId())));
        }

        return $this->render('IagSwitchBundle:SwitchPilha:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SwitchPilha entity.
     *
     * @param SwitchPilha $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SwitchPilha $entity)
    {
        $form = $this->createForm(new SwitchPilhaType(), $entity, array(
            'action' => $this->generateUrl('switchpilha_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SwitchPilha entity.
     *
     */
    public function newAction()
    {
        $entity = new SwitchPilha();
        $form   = $this->createCreateForm($entity);

        return $this->render('IagSwitchBundle:SwitchPilha:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SwitchPilha entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagSwitchBundle:SwitchPilha')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SwitchPilha entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IagSwitchBundle:SwitchPilha:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SwitchPilha entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagSwitchBundle:SwitchPilha')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SwitchPilha entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IagSwitchBundle:SwitchPilha:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SwitchPilha entity.
    *
    * @param SwitchPilha $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SwitchPilha $entity)
    {
        $form = $this->createForm(new SwitchPilhaType(), $entity, array(
            'action' => $this->generateUrl('switchpilha_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SwitchPilha entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagSwitchBundle:SwitchPilha')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SwitchPilha entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('switchpilha_edit', array('id' => $id)));
        }

        return $this->render('IagSwitchBundle:SwitchPilha:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SwitchPilha entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IagSwitchBundle:SwitchPilha')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SwitchPilha entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('switchpilha'));
    }

    /**
     * Creates a form to delete a SwitchPilha entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('switchpilha_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
