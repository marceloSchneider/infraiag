<?php

namespace Iag\InfraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Iag\InfraBundle\Entity\Rack;
use Iag\InfraBundle\Form\RackType;

/**
 * Rack controller.
 *
 * @Route("/rack")
 */
class RackController extends Controller
{

    /**
     * Lists all Rack entities.
     *
     * @Route("/", name="rack")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IagInfraBundle:Rack')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Rack entity.
     *
     * @Route("/", name="rack_create")
     * @Method("POST")
     * @Template("IagInfraBundle:Rack:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Rack();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
           
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
             $this->flushAtendeSalas($form->get('atendeLocais')->getData(), $entity);

            return $this->redirect($this->generateUrl('rack_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Rack entity.
     *
     * @param Rack $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Rack $entity)
    {
        $form = $this->createForm(new RackType(), $entity, array(
            'action' => $this->generateUrl('rack_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Rack entity.
     *
     * @Route("/new", name="rack_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Rack();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Rack entity.
     *
     * @Route("/{id}", name="rack_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagInfraBundle:Rack')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rack entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Rack entity.
     *
     * @Route("/{id}/edit", name="rack_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagInfraBundle:Rack')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rack entity.');
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
    * Creates a form to edit a Rack entity.
    *
    * @param Rack $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Rack $entity)
    {
        $form = $this->createForm(new RackType(), $entity, array(
            'action' => $this->generateUrl('rack_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Rack entity.
     *
     * @Route("/{id}", name="rack_update")
     * @Method("PUT")
     * @Template("IagInfraBundle:Rack:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagInfraBundle:Rack')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rack entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->flushAtendeSalas($entity->getAtendeLocais(), $entity);
            return $this->redirect($this->generateUrl('rack_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Rack entity.
     *
     * @Route("/{id}", name="rack_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IagInfraBundle:Rack')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Rack entity.');
            }
            $locais = array();
            $this->flushAtendeSalas($locais, $entity);
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('rack_index'));
    }

    /**
     * Creates a form to delete a Rack entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rack_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Apagar'))
            ->getForm()
        ;
    }
    
    private function flushAtendeSalas($locais, Rack $rack)
    {
        $em = $this->getDoctrine()->getManager();
        $salasAtendidas = $em->getRepository('IagLocalBundle:Sala')->findBy(
                array('rackAtendente' => $rack->getId())
                );
        
        if (!is_array($salasAtendidas)){
            $salasAtendidas = array();
        }
        
        foreach ($salasAtendidas as $s){
            $s->setRackAtendente(NULL);
            $em->persist($s);
            $em->flush();
        }
        
        foreach ($locais as $l)
        {
            $localAtendido = $em->getRepository('IagLocalBundle:Sala')->find($l);
            if(!$localAtendido)
            {
                throw $this->createNotFoundException('A sala não foi encontrada');
            }
            $localAtendido->setRackAtendente($rack);
            $em->persist($localAtendido);
            $em->flush();
            echo $l.',';
        }
    }
}
