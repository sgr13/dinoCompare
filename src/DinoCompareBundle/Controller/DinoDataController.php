<?php

namespace DinoCompareBundle\Controller;

use DinoCompareBundle\Entity\DinoData;
use DinoCompareBundle\Form\DinoDataType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DinoDataController extends Controller
{
    /**
     * @Route("/entrance")
     */
    public function entranceAction()
    {

        return $this->render('DinoCompareBundle:DinoData:entrance.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/new")
     */
    public function newAction()
    {

        return $this->render('DinoCompareBundle:DinoData:new.html.twig', array(// ...
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
            $file = $dino->getPath();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            $file->move(
                $this->getParameter('path_directory'),
                $fileName
            );


            $dino->setPath($fileName);

            $em = $this->getDoctrine()->getManager();

            $em->persist($dino);

            $em->flush();

            return new Response("Dodano nowego Dinozaura");
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

        $form = $this->createForm(new DinoDataType(), $dino, array(
            'noPhoto' => true
        ));

        $photoForm = $this->createForm(new DinoDataType(), $dino, array(
            'noPhoto' => false,
            'onlyPhoto' => true
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $dino = $form->getData();

            $file = $dino->getPath();

            $dino->setPath($file);

            $em = $this->getDoctrine()->getManager();
            $em->persist($dino);
            $em->flush();
        }

        return $this->render('DinoCompareBundle:DinoData:edit.html.twig', array(
            'form' => $form->createView(),
            'photoForm' => $photoForm->createView()
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
    public function showAll(Request $request)
    {
        $dinoRepository = $this->getDoctrine()->getRepository('DinoCompareBundle:DinoData');

        $dinos = $dinoRepository->findBy(
            array(),
            array('name' => 'ASC')
        );

        $text = $request->get('text');

        if (isset($text)) {

            $em = $this->getDoctrine()->getManager();

            $repository = $em->getRepository('DinoCompareBundle:DinoData');

            $query = $repository->createQueryBuilder('p')
                ->where('p.name Like :word')
                ->setParameter('word', '%' . $text . '%')
                ->getQuery();

            $dinos = $query->getResult();

            return $this->render('DinoCompareBundle:DinoData:showAll.html.twig', array('dinos' => $dinos));
        }

        return $this->render('DinoCompareBundle:DinoData:showAll.html.twig', array('dinos' => $dinos));
    }

    /**
     * @Route("/compareForm", name="compare")
     * @Method("POST")
     */
    public function compareForm(Request $request)
    {
        $session = $request->getSession();

        if ($session->has('dino1')) {
            $session->remove('dino1');
        }

        if ($session->has('dino2')) {
            $session->remove('dino2');
        }

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
     * @Route("/selectDino", name="selectDino")
     */
    public function selectDino(Request $request)
    {
        $session = $request->getSession();

        $dinoRepository = $this->getDoctrine()->getRepository('DinoCompareBundle:DinoData');

        $dinos = $dinoRepository->findAll();

        if ($session->has('dino1')) {
            $session = $request->getSession();
            $dino1 = $session->get('dino1');
            $dinoSelected1 = $dinoRepository->find($dino1);
        } else {
            $dinoSelected1 = null;
        }

        if ($session->has('dino2')) {
            $session = $request->getSession();
            $dino2 = $session->get('dino2');
            $dinoSelected2 = $dinoRepository->find($dino2);
            $session->remove('dino2');
        } else {
            $dinoSelected2 = null;
        }

        return $this->render('DinoCompareBundle:DinoData:selectDino.html.twig', array('dinos' => $dinos, 'dino1' => $dinoSelected1, 'dino2' => $dinoSelected2));
    }

    /**
     * @Route("/graphicSelection/{id}", name="graphic")
     */
    public function graphicSelection($id)
    {

        $dinoRepository = $this->getDoctrine()->getRepository('DinoCompareBundle:DinoData');

        $dinos = $dinoRepository->findAll();

        $suborderRepository = $this->getDoctrine()->getRepository('DinoCompareBundle:DinoSuborder');

        $suborders = $suborderRepository->findAll();

        return $this->render('DinoCompareBundle:DinoData:graphicSelection.html.twig', array('dinos' => $dinos, 'suborders' => $suborders, 'selection' => $id));
    }

    /**
     * @Route("/selectSuborder/{id}/{selection}", name="selectSuborder")
     */
    public function selectSuborder(Request $request, $id, $selection)
    {

        $em = $this->getDoctrine()->getManager();

        $dinos = $em->getRepository('DinoCompareBundle:DinoData')->findByDinoSuborder($id);

        if (!$dinos) {
            throw new NotFoundHttpException('Nie znaleziono dinozaurów w bazie danych');
        }

        return $this->render('DinoCompareBundle:DinoData:selectSuborder.html.twig', array('dinos' => $dinos, 'selection' => $selection));
    }

    /**
     * @Route("/idSaveToSession/{id}/{selection}", name="idSaveToSession")
     */
    public function idSaveToSession(Request $request, $id, $selection)
    {

        $session = $request->getSession();

        if ($selection == 1) {
            $session->set('dino1', $id);
        }

        if ($selection == 2) {
            $session->set('dino2', $id);
        }
        return new RedirectResponse($this->generateUrl('selectDino'));
    }

    /**
     * @Route("/changePhoto/{id}", name="changePhoto")
     */
    public function changePhotoAction(Request $request, $id)
    {
        $dinoRepository = $this->getDoctrine()->getRepository('DinoCompareBundle:DinoData');

        $dino = $dinoRepository->find($id);

        $form = $this->createForm(DinoDataType::class, $dino);

        $form->handleRequest($request);

        return $this->render('DinoCompareBundle:DinoData:changePhoto.html.twig', array(
            'dino' => $dino,
            'form' => $form
        ));
    }

}
