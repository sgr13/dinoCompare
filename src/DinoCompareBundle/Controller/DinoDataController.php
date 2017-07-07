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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DinoDataController extends Controller
{
    /**
     * @Route("/entrance")
     */
    public function entranceAction()
    {
        return $this->render('DinoCompareBundle:DinoData:entrance.html.twig', array());
    }

    /**
     * @Route("/create", name="createDino")
     * @Security("has_role('ROLE_ADMIN')")
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
     * @Security("has_role('ROLE_ADMIN')")
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
        ));
    }

    /**
     * @Route("/delete/{id}")
     * @Security("has_role('ROLE_ADMIN')")
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
     * @Route("/showAll", name="showAll")
     * @Security("has_role('ROLE_ADMIN')")
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

//            $em = $this->getDoctrine()->getManager();
//            $dinos = $em->getRepository('DinoCompareBundle:DinoData')->findDinoByName($text);

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

        if ($session->has('firstDino')) {
            $session->remove('firstDino');
        }

        if ($session->has('secondDino')) {
            $session->remove('secondDino');
        }

        $firstDinoName = $request->get('firstDinosaur');
        $secondDinoName = $request->get('secondDinosaur');
        $em = $this->getDoctrine()->getManager();
        $dinoRepository = $em->getRepository('DinoCompareBundle:DinoData');
        $firstDino = $dinoRepository->find($firstDinoName);
        $secondDino = $dinoRepository->find($secondDinoName);

        return $this->render('DinoCompareBundle:DinoData:compareForm.html.twig', array(
            'firstDino' => $firstDino, 'secondDino' => $secondDino
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

        if ($session->has('firstDino')) {
            $session = $request->getSession();
            $firstDino = $session->get('firstDino');
            $firstDinoSelected = $dinoRepository->find($firstDino);
        } else {
            $firstDinoSelected = null;
        }

        if ($session->has('secondDino')) {
            $session = $request->getSession();
            $secondDino = $session->get('secondDino');
            $secondDinoSelected = $dinoRepository->find($secondDino);
            $session->remove('secondDino');
        } else {
            $secondDinoSelected = null;
        }

        return $this->render('DinoCompareBundle:DinoData:selectDino.html.twig', array(
            'dinos' => $dinos, 'firstDino' => $firstDinoSelected, 'secondDino' => $secondDinoSelected
        ));
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
            $session->set('firstDino', $id);
        }

        if ($selection == 2) {
            $session->set('secondDino', $id);
        }
        return new RedirectResponse($this->generateUrl('selectDino'));
    }

    /**
     * @Route("/changePhoto/{id}", name="changePhoto")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function changePhotoAction(Request $request, $id)
    {
        $dinoRepository = $this->getDoctrine()->getRepository('DinoCompareBundle:DinoData');
        $dino = $dinoRepository->find($id);
        $photoForm = $this->createForm(new DinoDataType(), $dino, array(
            'noPhoto' => false,
            'onlyPhoto' => true
        ));

        $photoForm->handleRequest($request);

        if ($photoForm->isSubmitted()) {

            $dino = $photoForm->getData();
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

            return new Response("Zmieniono zdjęcie Dinozaura");
        }

        return $this->render('DinoCompareBundle:DinoData:changePhoto.html.twig', array(
            'dino' => $dino,
            'form' => $photoForm->createView()
        ));
    }

    /**
     * @Route("/adminLogin", name="adminLogin")
     * @Security("has_role('ROLE_ADMIN')")
     * Method("post")
     */
    public function adminLoginAction()
    {
        return $this->render('DinoCompareBundle:DinoData:adminLogin.html.twig', array());
    }
}
