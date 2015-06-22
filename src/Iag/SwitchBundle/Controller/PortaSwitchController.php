<?php

namespace Iag\SwitchBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Iag\SwitchBundle\Entity\PortaSwitch;
use Iag\SwitchBundle\Form\PortaSwitchType;
use Iag\InfraBundle\Entity\PPorta;

/**
 * PortaSwitch controller.
 *
 * @Route("/portaswitch")
 */
class PortaSwitchController extends Controller
{

    /**
     * Lists all PortaSwitch entities.
     *
     * @Route("/", name="portaswitch")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IagSwitchBundle:PortaSwitch')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new PortaSwitch entity.
     *
     * @Route("/", name="portaswitch_create")
     * @Method("POST")
     * @Template("IagSwitchBundle:PortaSwitch:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new PortaSwitch();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('portaswitch_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a PortaSwitch entity.
     *
     * @param PortaSwitch $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PortaSwitch $entity)
    {
        $form = $this->createForm(new PortaSwitchType(), $entity, array(
            'action' => $this->generateUrl('portaswitch_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new PortaSwitch entity.
     *
     * @Route("/new", name="portaswitch_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PortaSwitch();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PortaSwitch entity.
     *
     * @Route("/{id}", name="portaswitch_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagSwitchBundle:PortaSwitch')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PortaSwitch entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PortaSwitch entity.
     *
     * @Route("/{id}/edit", name="portaswitch_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagSwitchBundle:PortaSwitch')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PortaSwitch entity.');
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
    * Creates a form to edit a PortaSwitch entity.
    *
    * @param PortaSwitch $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PortaSwitch $entity)
    {
        $form = $this->createForm(new PortaSwitchType(), $entity, array(
            'action' => $this->generateUrl('portaswitch_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing PortaSwitch entity.
     *
     * @Route("/{id}", name="portaswitch_update")
     * @Method("PUT")
     * @Template("IagSwitchBundle:PortaSwitch:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagSwitchBundle:PortaSwitch')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PortaSwitch entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('portaswitch_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a PortaSwitch entity.
     *
     * @Route("/{id}", name="portaswitch_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IagSwitchBundle:PortaSwitch')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PortaSwitch entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('portaswitch'));
    }

    /**
     * Creates a form to delete a PortaSwitch entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('portaswitch_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
    /**
     * Retorna a lista de portas de um determinado switch
     * @param type $switchId
     * @return type
     */
    public function pswitchAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $portas = $em->getRepository('IagSwitchBundle:PortaSwitch')->findBy(array('switch'=>$id));
        $switch = $em->getRepository('IagSwitchBundle:Switchs')->find($id);
        return $this->render('IagSwitchBundle:PortaSwitch:pswitch.html.twig', array('portas'=>$portas, 'switch'=>$switch));
    }
}