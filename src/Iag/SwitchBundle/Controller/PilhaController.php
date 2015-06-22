<?php

namespace Iag\SwitchBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Iag\SwitchBundle\Entity\Pilha;
use Iag\SwitchBundle\Form\PilhaType;

/**
 * Pilha controller.
 *
 * @Route("/pilha")
 */
class PilhaController extends Controller
{

    /**
     * Lists all Pilha entities.
     *
     * @Route("/", name="pilha")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IagSwitchBundle:Pilha')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Pilha entity.
     *
     * @Route("/", name="pilha_create")
     * @Method("POST")
     * @Template("IagSwitchBundle:Pilha:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Pilha();
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pilha_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Pilha entity.
     *
     * @param Pilha $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Pilha $entity)
    {
        $form = $this->createForm(new PilhaType(), $entity, array(
            'action' => $this->generateUrl('pilha_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Pilha entity.
     *
     * @Route("/new", name="pilha_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Pilha();
        
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Pilha entity.
     *
     * @Route("/{id}", name="pilha_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagSwitchBundle:Pilha')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pilha entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Pilha entity.
     *
     * @Route("/{id}/edit", name="pilha_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagSwitchBundle:Pilha')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pilha entity.');
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
    * Creates a form to edit a Pilha entity.
    *
    * @param Pilha $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pilha $entity)
    {
        $form = $this->createForm(new PilhaType(), $entity, array(
            'action' => $this->generateUrl('pilha_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Pilha entity.
     *
     * @Route("/{id}", name="pilha_update")
     * @Method("PUT")
     * @Template("IagSwitchBundle:Pilha:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagSwitchBundle:Pilha')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pilha entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pilha_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Pilha entity.
     *
     * @Route("/{id}", name="pilha_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IagSwitchBundle:Pilha')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pilha entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pilha'));
    }

    /**
     * Creates a form to delete a Pilha entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pilha_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
