<?php

namespace Iag\LocalBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Iag\LocalBundle\Entity\Sala;
use Iag\LocalBundle\Form\SalaType;

/**
 * Sala controller.
 *
 * @Route("/sala")
 */
class SalaController extends Controller
{

    /**
     * Lists all Sala entities.
     *
     * @Route("/", name="sala")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IagLocalBundle:Sala')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Sala entity.
     *
     * @Route("/", name="sala_create")
     * @Method("POST")
     * @Template("IagLocalBundle:Sala:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Sala();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sala_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Sala entity.
     *
     * @param Sala $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Sala $entity)
    {
        $form = $this->createForm(new SalaType(), $entity, array(
            'action' => $this->generateUrl('sala_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Sala entity.
     *
     * @Route("/new", name="sala_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Sala();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Sala entity.
     *
     * @Route("/{id}", name="sala_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagLocalBundle:Sala')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sala entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Sala entity.
     *
     * @Route("/{id}/edit", name="sala_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagLocalBundle:Sala')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sala entity.');
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
    * Creates a form to edit a Sala entity.
    *
    * @param Sala $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Sala $entity)
    {
        $form = $this->createForm(new SalaType(), $entity, array(
            'action' => $this->generateUrl('sala_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Sala entity.
     *
     * @Route("/{id}", name="sala_update")
     * @Method("PUT")
     * @Template("IagLocalBundle:Sala:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagLocalBundle:Sala')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sala entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('sala_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Sala entity.
     *
     * @Route("/{id}", name="sala_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IagLocalBundle:Sala')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Sala entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('sala'));
    }

    /**
     * Creates a form to delete a Sala entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sala_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
