<?php

namespace Iag\InfraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Iag\InfraBundle\Entity\VoicePanel;
use Iag\InfraBundle\Form\VoicePanelType;

/**
 * VoicePanel controller.
 *
 */
class VoicePanelController extends Controller
{

    /**
     * Lists all VoicePanel entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IagInfraBundle:VoicePanel')->findAll();

        return $this->render('IagInfraBundle:VoicePanel:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new VoicePanel entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new VoicePanel();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            $this->createVoicePanelPorts($entity);
            
            return $this->redirect($this->generateUrl('voicepanel_show', array('id' => $entity->getId())));
        }

        return $this->render('IagInfraBundle:VoicePanel:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a VoicePanel entity.
     *
     * @param VoicePanel $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(VoicePanel $entity)
    {
        $form = $this->createForm(new VoicePanelType(), $entity, array(
            'action' => $this->generateUrl('voicepanel_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new VoicePanel entity.
     *
     */
    public function newAction()
    {
        $entity = new VoicePanel();
        $form   = $this->createCreateForm($entity);

        return $this->render('IagInfraBundle:VoicePanel:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a VoicePanel entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagInfraBundle:VoicePanel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VoicePanel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IagInfraBundle:VoicePanel:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing VoicePanel entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagInfraBundle:VoicePanel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VoicePanel entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IagInfraBundle:VoicePanel:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a VoicePanel entity.
    *
    * @param VoicePanel $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(VoicePanel $entity)
    {
        $form = $this->createForm(new VoicePanelType(), $entity, array(
            'action' => $this->generateUrl('voicepanel_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing VoicePanel entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagInfraBundle:VoicePanel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VoicePanel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('voicepanel_edit', array('id' => $id)));
        }

        return $this->render('IagInfraBundle:VoicePanel:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a VoicePanel entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IagInfraBundle:VoicePanel')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find VoicePanel entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('voicepanel'));
    }
    
    /**
     * Creates a form to delete a VoicePanel entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('voicepanel_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
    private function createVoicePanelPorts(VoicePanel $entity)
    {
        $numPortas = $entity->getNumPortas();
        $em = $this->getDoctrine()->getManager();
        
        for ($i=1; $i<=$numPortas; $i++)
        {
            $voicePorta = new \Iag\InfraBundle\Entity\VoicePorta();
            $voicePorta->setNumero($i);
            $voicePorta->setVoicePanel($entity);
            $em->persist($voicePorta);
            $em->flush();
        }
    }
}
