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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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
     * @Route("/edit/{id}")
     */
    public function editAction(Request $request, $id)
    {
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
     * @Route("/delete/{id}")
     */
    public function deleteAction(Request $request, $id)
    {
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

    /**
     * @Route("/compareForm", name="compare")
     * @Method("POST")
     */
    public function compareForm(Request $request)
    {
        $dinosaur = $request->get('dinosaur');

        $dinosaur1 = $request->get('dinosaur1');

        $em = $this->getDoctrine()->getManager();

        $dino = $em->getRepository('DinoCompareBundle:DinoData')->find($dinosaur);

        $dino1 = $em->getRepository('DinoCompareBundle:DinoData')->find($dinosaur1);

        return $this->render('DinoCompareBundle:DinoData:compareForm.html.twig', array(
            'dino' => $dino, 'dino1' => $dino1
        ));
    }

    /**
     * @Route("/selectDino")
     */
    public function selectDino()
    {
        $dinoRepository = $this->getDoctrine()->getRepository('DinoCompareBundle:DinoData');

        $dinos = $dinoRepository->findAll();

        return $this->render('DinoCompareBundle:DinoData:selectDino.html.twig', array('dinos' => $dinos));
    }





}
