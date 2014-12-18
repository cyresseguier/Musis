<?php

namespace Team\MusisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Team\MusisBundle\Entity\Music;
use Team\MusisBundle\Form\MusicType;

/**
 * Music controller.
 *
 * @Route("/music")
 */
class MusicController extends Controller
{

    /**
     * Lists all Music entities.
     *
     * @Route("/", name="music")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TeamMusisBundle:Music')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Music entity.
     *
     * @Route("/", name="music_create")
     * @Method("POST")
     * @Template("TeamMusisBundle:Music:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Music();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('music_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Music entity.
     *
     * @param Music $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Music $entity)
    {
        $form = $this->createForm(new MusicType(), $entity, array(
            'action' => $this->generateUrl('music_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Music entity.
     *
     * @Route("/new", name="music_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Music();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Music entity.
     *
     * @Route("/{id}", name="music_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TeamMusisBundle:Music')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Music entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Music entity.
     *
     * @Route("/{id}/edit", name="music_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TeamMusisBundle:Music')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Music entity.');
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
    * Creates a form to edit a Music entity.
    *
    * @param Music $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Music $entity)
    {
        $form = $this->createForm(new MusicType(), $entity, array(
            'action' => $this->generateUrl('music_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Music entity.
     *
     * @Route("/{id}", name="music_update")
     * @Method("PUT")
     * @Template("TeamMusisBundle:Music:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TeamMusisBundle:Music')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Music entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('music_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Music entity.
     *
     * @Route("/{id}", name="music_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TeamMusisBundle:Music')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Music entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('music'));
    }

    /**
     * Creates a form to delete a Music entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('music_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
