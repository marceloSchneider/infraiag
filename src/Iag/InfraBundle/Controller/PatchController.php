<?php

namespace Iag\InfraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Iag\InfraBundle\Entity\Patch;
use Iag\InfraBundle\Form\PatchType;

/**
 * Patch controller.
 *
 * @Route("/patch")
 */
class PatchController extends Controller
{

    /**
     * Lists all Patch entities.
     *
     * @Route("/", name="patch")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IagInfraBundle:Patch')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Patch entity.
     *
     * @Route("/", name="patch_create")
     * @Method("POST")
     * @Template("IagInfraBundle:Patch:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Patch();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->createPPortas($entity->getNumPortas(), $entity);
            return $this->redirect($this->generateUrl('patch_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Patch entity.
     *
     * @param Patch $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Patch $entity)
    {
        $form = $this->createForm(new PatchType(), $entity, array(
            'action' => $this->generateUrl('patch_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Patch entity.
     *
     * @Route("/new", name="patch_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Patch();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Patch entity.
     *
     * @Route("/{id}", name="patch_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagInfraBundle:Patch')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Patch entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Patch entity.
     *
     * @Route("/{id}/edit", name="patch_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagInfraBundle:Patch')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Patch entity.');
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
    * Creates a form to edit a Patch entity.
    *
    * @param Patch $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Patch $entity)
    {
        $form = $this->createForm(new PatchType(), $entity, array(
            'action' => $this->generateUrl('patch_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Patch entity.
     *
     * @Route("/{id}", name="patch_update")
     * @Method("PUT")
     * @Template("IagInfraBundle:Patch:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagInfraBundle:Patch')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Patch entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('patch_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Patch entity.
     *
     * @Route("/{id}", name="patch_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IagInfraBundle:Patch')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Patch entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('patch_index'));
    }

    
    /**
     * Creates a form to delete a Patch entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('patch_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
    private function createPPortas($numPortas, $patch)
    {
        for($i = 1; $i <= $numPortas ; $i++)
        {
            $pporta = new \Iag\InfraBundle\Entity\PPorta();
            $pporta->setNumero($i)
                    ->setPatch($patch);
            $em = $this->getDoctrine()->getManager();
            $em->persist($pporta);
            $em->flush();
        }
    }
}
