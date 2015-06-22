<?php

namespace Iag\SwitchBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Iag\SwitchBundle\Entity\Switchs;
use Iag\SwitchBundle\Form\SwitchsType;
use Iag\SwitchBundle\Entity\PortaSwitch;

/**
 * Switchs controller.
 *
 * @Route("/switchs")
 */
class SwitchsController extends Controller
{

    /**
     * Lists all Switchs entities.
     *
     * @Route("/", name="switchs")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $entities = $em->getRepository('IagSwitchBundle:Switchs')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Switchs entity.
     *
     * @Route("/", name="switchs_create")
     * @Method("POST")
     * @Template("IagSwitchBundle:Switchs:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Switchs();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->__createPorts($entity, $entity->getNumPortas());

            return $this->redirect($this->generateUrl('switchs_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Switchs entity.
     *
     * @param Switchs $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Switchs $entity)
    {
        $form = $this->createForm(new SwitchsType(), $entity, array(
            'action' => $this->generateUrl('switchs_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }
    
    /**
     * Displays a form to create a new Switchs entity.
     *
     * @Route("/new", name="switchs_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Switchs();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Switchs entity.
     *
     * @Route("/{id}", name="switchs_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagSwitchBundle:Switchs')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Switchs entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Switchs entity.
     *
     * @Route("/{id}/edit", name="switchs_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagSwitchBundle:Switchs')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Switchs entity.');
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
    * Creates a form to edit a Switchs entity.
    *
    * @param Switchs $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Switchs $entity)
    {
        $form = $this->createForm(new SwitchsType(), $entity, array(
            'action' => $this->generateUrl('switchs_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));
        
        return $form;
    }
    /**
     * Edits an existing Switchs entity.
     *
     * @Route("/{id}", name="switchs_update")
     * @Method("PUT")
     * @Template("IagSwitchBundle:Switchs:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IagSwitchBundle:Switchs')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Switchs entity.');
        }
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('switchs_edit', array('id' => $id)));
        } 

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Switchs entity.
     *
     * @Route("/{id}", name="switchs_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IagSwitchBundle:Switchs')->find($id);
            $portas = $em->getRepository('IagSwitchBundle:PortaSwitch')->deletePortasBySwitchId($id);
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Switchs entity.');
            }
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('switchs'));
    }

    /**
     * Creates a form to delete a Switchs entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('switchs_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Apagar'))
            ->getForm()
        ;
    }
    
    //Após criar o switch as suas portas serão adicionadas
    //automaticamente.
    private function __createPorts($switchId, $numPortas)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IagSwitchBundle:Switchs')->find($switchId);
        
        $posicaoPilha = $entity->getPosicaoPilha();
        
        for($i=1; $i <= $numPortas; $i++)
        { 
            $porta = new PortaSwitch();
            $porta->setIsPOE(0)
                    ->setPOEStatus(0)
                    ->setNumPorta($posicaoPilha.'/'.'0'.'/'.$i)
                    ->setSwitch($switchId);
            $em = $this->getDoctrine()->getManager();
            $em->persist($porta);
            $em->flush();
        }
    }
}
