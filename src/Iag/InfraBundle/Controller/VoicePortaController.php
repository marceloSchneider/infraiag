<?php

namespace Iag\InfraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Iag\InfraBundle\Entity\VoicePorta;
use Iag\InfraBundle\Form\VoicePortaType;

/**
 * VoicePorta controller.
 *
 */
class VoicePortaController extends Controller
{

    /**
     * Lists all VoicePorta entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IagInfraBundle:VoicePorta')->findAll();

        return $this->render('IagInfraBundle:VoicePorta:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new VoicePorta entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new VoicePorta();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('voiceporta_show', array('id' => $entity->getId())));
        }

        return $this->render('IagInfraBundle:VoicePorta:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a VoicePorta entity.
     *
     * @param VoicePorta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(VoicePorta $entity)
    {
        $form = $this->createForm(new VoicePortaType(), $entity, array(
            'action' => $this->generateUrl('voiceporta_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new VoicePorta entity.
     *
     */
    public function newAction()
    {
        $entity = new VoicePorta();
        $form   = $this->createCreateForm($entity);

        return $this->render('IagInfraBundle:VoicePorta:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a VoicePorta entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagInfraBundle:VoicePorta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VoicePorta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IagInfraBundle:VoicePorta:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing VoicePorta entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagInfraBundle:VoicePorta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VoicePorta entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IagInfraBundle:VoicePorta:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a VoicePorta entity.
    *
    * @param VoicePorta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(VoicePorta $entity)
    {
        $form = $this->createForm(new VoicePortaType(), $entity, array(
            'action' => $this->generateUrl('voiceporta_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing VoicePorta entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagInfraBundle:VoicePorta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VoicePorta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('voiceporta_edit', array('id' => $id)));
        }

        return $this->render('IagInfraBundle:VoicePorta:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a VoicePorta entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IagInfraBundle:VoicePorta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find VoicePorta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('voiceporta'));
    }

    public function portasAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IagInfraBundle:VoicePorta')->findBy(array(
            'voicePanel' => $id,
        ));
        return $this->render('IagInfraBundle:VoicePorta:index.html.twig', array('entities' => $entity));
    }
    
    /**
     * Creates a form to delete a VoicePorta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('voiceporta_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
