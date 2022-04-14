<?php

namespace App\Controller;

use App\Entity\Airline;
use App\Entity\Vol;
use App\Form\AirlineType;
use App\Form\VolType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class AirlineController extends AbstractController
{
    /**
     * @Route("/airline", name="airline")
     */
    public function index(): Response
    {

        $airlines = $this->getDoctrine()->getManager()->getRepository(Airline::class)->findALL();
        return $this->render('airline/index.html.twig', ['airlines' => $airlines]);
    }





    /**
     * @Route("/addAirline", name="addAirline")
     */

    public function addAirline(Request $request): Response
    {
        $Airline= new Airline();

        $form = $this->createForm(AirlineType::class, $Airline);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Airline);
            $em->flush();

            return $this->redirectToRoute('airline');
        }
        return $this->render('airline/CreateAirline.html.twig', ['a' => $form->createView()]);

    }

    /**
     * @Route("/removeairline/{id}",name="airlinedel")
     */
    public function delairline(Airline $airline): Response
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($airline);
        $em->flush();

        return $this->redirectToRoute('airline');

    }





    /**
     * @Route("/editairline/{id}", name="editairline")
     */

    public function editairline(Request $request,$id): Response
    {
        $airline = $this->getDoctrine()->getManager()->getRepository(Airline::class)->find($id);

        $form = $this->createForm(AirlineType::class, $airline);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('airline');
        }
        return $this->render('airline/updateairline.html.twig', ['a' => $form->createView()]);

    }














































}
