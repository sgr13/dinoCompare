<?php

namespace DinoCompareBundle\Controller;

use DinoCompareBundle\Entity\DinoData;
use DinoCompareBundle\Form\DinoDataType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DinoDataController extends Controller
{
    /**
     * @Route("/new")
     */
    public function newAction()
    {

        return $this->render('DinoCompareBundle:DinoData:new.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/create", name="createDino")
     */
    public function createAction(Request $request)
    {
        $dino = new DinoData();

        $form = $this->createForm(DinoDataType::class, $dino);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $dino = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $em->persist($dino);

            $em->flush();

            Return new Response("Dodano nowego Dinozaura");
        }

        return $this->render('DinoCompareBundle:DinoData:create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/edit")
     */
    public function editAction(Request $request)
    {
        $id = $request->get('id');

        $dinoRepository = $this->getDoctrine()->getRepository('DinoCompareBundle:DinoData');

        $dino = $dinoRepository->find($id);

        if (!$dino) {
            throw new NotFoundHttpException('Nie znaleziono dinozaura o podanym ID');
        }

        $form = $this->createForm(DinoDataType::class, $dino);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $dino = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($dino);
            $em->flush();
        }

        return $this->render('DinoCompareBundle:DinoData:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/delete")
     */
    public function deleteAction(Request $request)
    {
        $id = $request->get('id');

        $em = $this->getDoctrine()->getManager();

        $dino = $em->getRepository('DinoCompareBundle:DinoData')->find($id);


        if (!$dino) {
            throw new NotFoundHttpException('Nie znaleziono dinozaura o podanym ID');
        }

        $em->remove($dino);
        $em->flush();

        return new Response("Usunięto dinozaura");
    }

    /**
     * @Route("/showAll")
     */
    public function showAll()
    {
        $dinoRepository = $this->getDoctrine()->getRepository('DinoCompareBundle:DinoData');

        $dinos = $dinoRepository->findAll();

        return $this->render('DinoCompareBundle:DinoData:showAll.html.twig', array('dinos' => $dinos));
    }



}
