<?php

namespace Iag\VlanBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Iag\VlanBundle\Entity\Vlan;
use Iag\VlanBundle\Form\VlanType;

/**
 * Vlan controller.
 *
 * @Route("/vlan")
 */
class VlanController extends Controller
{

    /**
     * Lists all Vlan entities.
     *
     * @Route("/", name="vlan")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IagVlanBundle:Vlan')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Vlan entity.
     *
     * @Route("/", name="vlan_create")
     * @Method("POST")
     * @Template("IagVlanBundle:Vlan:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Vlan();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vlan_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Vlan entity.
     *
     * @param Vlan $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Vlan $entity)
    {
        $form = $this->createForm(new VlanType(), $entity, array(
            'action' => $this->generateUrl('vlan_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Vlan entity.
     *
     * @Route("/new", name="vlan_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Vlan();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Vlan entity.
     *
     * @Route("/{id}", name="vlan_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagVlanBundle:Vlan')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vlan entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Vlan entity.
     *
     * @Route("/{id}/edit", name="vlan_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagVlanBundle:Vlan')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vlan entity.');
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
    * Creates a form to edit a Vlan entity.
    *
    * @param Vlan $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Vlan $entity)
    {
        $form = $this->createForm(new VlanType(), $entity, array(
            'action' => $this->generateUrl('vlan_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Vlan entity.
     *
     * @Route("/{id}", name="vlan_update")
     * @Method("PUT")
     * @Template("IagVlanBundle:Vlan:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagVlanBundle:Vlan')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vlan entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('vlan_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Vlan entity.
     *
     * @Route("/{id}", name="vlan_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IagVlanBundle:Vlan')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Vlan entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('vlan'));
    }

    /**
     * Creates a form to delete a Vlan entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vlan_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
