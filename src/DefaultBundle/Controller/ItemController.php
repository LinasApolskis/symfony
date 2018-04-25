<?php

namespace DefaultBundle\Controller;

use DefaultBundle\Entity\Item;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Item controller.
 *
 * @Route("item")
 */
class ItemController extends Controller
{
    /**
     * Creates a new item entity.
     *
     * @Route("/json", name="JSON")
     */
    public function DeSerializeAction()
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer(), new ArrayDenormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, "https://gist.githubusercontent.com/emodus/27d245484a85c2286722b9d146c53354/raw/c9af224580a22cbde969127527c4500e3f7d2a9e/dummyFeed");

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $data = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);



        $data = json_decode($data);
        $data = json_encode($data->items);

        $items = $serializer->deserialize($data,'DefaultBundle\Entity\Item[]', 'json');
        $em = $this->getDoctrine()->getManager();
        foreach($items as $item=>$item_value)
        {
            if($item_value->getBool() == "true")
                $item_value->setBool("1");
            else
                $item_value->setBool("0");
            $em->persist($item_value);
            $em->flush();
        }

        return $this->render('item/json.html.twig', array(
        ));
    }
    /**
     * Lists all item entities.
     *
     * @Route("/", name="item_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $items = $em->getRepository('DefaultBundle:Item')->findAll();

        return $this->render('item/index.html.twig', array(
            'items' => $items,
        ));
    }

    /**
     * Lists all item entities.
     *
     * @Route("/list", name="CRUD_list")
     * @Method("GET")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT a FROM DefaultBundle:Item a";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            25/*limit per page*/
        );

        // parameters to template
        return $this->render('item/list.html.twig', array('pagination' => $pagination));
    }

    /**
     * Creates a new item entity.
     *
     * @Route("/new", name="item_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $item = new Item();
        $form = $this->createForm('DefaultBundle\Form\ItemType', $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            return $this->redirectToRoute('item_show', array('index' => $item->getIndex()));
        }

        return $this->render('item/new.html.twig', array(
            'item' => $item,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a item entity.
     *
     * @Route("/{index}", name="item_show")
     * @Method("GET")
     */
    public function showAction(Item $item)
    {
        $deleteForm = $this->createDeleteForm($item);

        return $this->render('item/show.html.twig', array(
            'item' => $item,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing item entity.
     *
     * @Route("/{index}/edit", name="item_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Item $item)
    {
        $deleteForm = $this->createDeleteForm($item);
        $editForm = $this->createForm('DefaultBundle\Form\ItemType', $item);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('item_edit', array('index' => $item->getIndex()));
        }

        return $this->render('item/edit.html.twig', array(
            'item' => $item,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a item entity.
     *
     * @Route("/{index}", name="item_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Item $item)
    {
        $form = $this->createDeleteForm($item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($item);
            $em->flush();
        }

        return $this->redirectToRoute('item_index');
    }

    /**
     * Creates a form to delete a item entity.
     *
     * @param Item $item The item entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Item $item)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('item_delete', array('index' => $item->getIndex())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
