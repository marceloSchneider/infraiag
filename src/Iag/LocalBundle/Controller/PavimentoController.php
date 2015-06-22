<?php

namespace Iag\LocalBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Iag\LocalBundle\Entity\Pavimento;
use Iag\LocalBundle\Form\PavimentoType;

/**
 * Pavimento controller.
 *
 * @Route("/pavimento")
 */
class PavimentoController extends Controller
{

    /**
     * Lists all Pavimento entities.
     *
     * @Route("/", name="pavimento")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IagLocalBundle:Pavimento')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Pavimento entity.
     *
     * @Route("/", name="pavimento_create")
     * @Method("POST")
     * @Template("IagLocalBundle:Pavimento:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Pavimento();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pavimento_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Pavimento entity.
     *
     * @param Pavimento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Pavimento $entity)
    {
        $form = $this->createForm(new PavimentoType(), $entity, array(
            'action' => $this->generateUrl('pavimento_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Pavimento entity.
     *
     * @Route("/new", name="pavimento_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Pavimento();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Pavimento entity.
     *
     * @Route("/{id}", name="pavimento_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagLocalBundle:Pavimento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pavimento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Pavimento entity.
     *
     * @Route("/{id}/edit", name="pavimento_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagLocalBundle:Pavimento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pavimento entity.');
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
    * Creates a form to edit a Pavimento entity.
    *
    * @param Pavimento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pavimento $entity)
    {
        $form = $this->createForm(new PavimentoType(), $entity, array(
            'action' => $this->generateUrl('pavimento_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Pavimento entity.
     *
     * @Route("/{id}", name="pavimento_update")
     * @Method("PUT")
     * @Template("IagLocalBundle:Pavimento:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagLocalBundle:Pavimento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pavimento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pavimento_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Pavimento entity.
     *
     * @Route("/{id}", name="pavimento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IagLocalBundle:Pavimento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pavimento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pavimento'));
    }

    /**
     * Creates a form to delete a Pavimento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pavimento_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
