<?php

namespace App\Controller;

use App\Entity\Vol;
use App\Entity\Airline;
use App\Form\VolType;
use App\Repository\VolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VolController extends AbstractController
{
    /**
     * @Route("/", name="app_vol")
     */
    public function index(): Response
    {
        $vols = $this->getDoctrine()->getManager()->getRepository(Vol::class)->findALL();
        return $this->render('vol/index.html.twig',
            ['vols' => $vols]);

    }


    /**
     * @Route("/addvol", name="addvol")
     */

    public function addVol(Request $request): Response
    {
        $vol = new Vol();

        $form = $this->createForm(VolType::class, $vol);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vol);//Add
            $em->flush();

            return $this->redirectToRoute('app_vol');
        }
        return $this->render('vol/Createvol.html.twig', ['f' => $form->createView()]);

    }

    /**
     * @Route("/removevol/{id}",name="supp_vol")
     */
    public function suppressionVol(Vol $vol): Response
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($vol);
        $em->flush();

        return $this->redirectToRoute('app_vol');

    }

    /**
     * @Route("/editvol/{id}", name="editvol")
     */

    public function editvol(Request $request,$id): Response
    {
        $vol = $this->getDoctrine()->getManager()->getRepository(Vol::class)->find($id);

        $form = $this->createForm(VolType::class, $vol);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('app_vol');
        }
        return $this->render('vol/updatevol.html.twig', ['f' => $form->createView()]);

    }

    /**
     * @param VolRepository $repository
     * @Route("/search",name="search")
     */

    public function test(VolRepository $repository)
    {


       $em = $this->getDoctrine()->getManager();

        //$re=$em->CreateQuery('SELECT v FROM App\Entity\Vol v')->getResult();

        /*$re = $em->CreateQuery('SELECT count(v) FROM App\Entity\Vol v ')->getResult();

        dump($re[0][1]);
        die;*/
        /*   $re = $em->CreateQuery('SELECT count(v) FROM App\Entity\Vol v ')->getSingleScalarResult(); //retourne une seul valeur et pas un array
        dump($re);
        die;
        */

$best = $em->CreateQuery
(
"   
    SELECT a.nom,v.id,v.nomvol
    FROM App\Entity\Vol v JOIN App\Entity\Airline a 
 
"
)
->getResult();

        return $this->render('vol/show.html.twig',
            ['best' => $best]);

/*dump($best);
die;*/


    }


    /**
     * @param VolRepository $repository
     * @Route("/volliste",name="volliste")
     */

    public function Affichagelistedesvolsdispo(VolRepository $repository)
    {


        $em = $this->getDoctrine()->getManager();

        //$re=$em->CreateQuery('SELECT v FROM App\Entity\Vol v')->getResult();

        /*$re = $em->CreateQuery('SELECT count(v) FROM App\Entity\Vol v ')->getResult();

        dump($re[0][1]);
        die;*/
        /*   $re = $em->CreateQuery('SELECT count(v) FROM App\Entity\Vol v ')->getSingleScalarResult(); //retourne une seul valeur et pas un array
        dump($re);
        die;
        */

        $best = $em->CreateQuery
        (
            "  
    SELECT v.nomvol,a.nom,v.datedepart,v.datearrive,v.heuredepart,v.heurearrive,v.destination
    FROM App\Entity\Vol v JOIN App\Entity\Airline a 
            "
        )
            ->getResult();

        return $this->render('vol/listevoluser.html.twig',
            ['best' => $best]);

        /*dump($best);
        die;*/


    }



























}













