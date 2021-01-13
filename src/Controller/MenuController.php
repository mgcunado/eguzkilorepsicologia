<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Facturas;
use App\Form\FacturasFormType;
use App\Form\UpdateFormType;

use Symfony\Component\HttpFoundation\Response;

use App\Entity\Menu;
use App\Entity\Texto;

use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;


class MenuController extends Controller
{
   /** 
    * @Route("/", name="inicioraiz")
    */
   public function inicioraizAction()
   {   
        $em = $this->getDoctrine()->getManager();

        $ppp1 = $em->getRepository('App:Menu')->findMenus(); 
        $linka = 1; 
    
        return $this->render('inicio.html.twig', array(
               'ppp1' => $ppp1, 'linka' => $linka
            ));         
   } 
   
    /**
     * @Route("/inicio", name="inicio")
     */
    public function menu1Action()
    {
        $em = $this->getDoctrine()->getManager();

        $ppp1 = $em->getRepository('App:Menu')->findMenus();
        $linka = 1;

        return $this->render('inicio.html.twig', array(
               'ppp1' => $ppp1, 'linka' => $linka
            ));

    }

    /** 
     * @Route("/sobremi", name="sobremi")
     */
    public function menu2Action()
    {   
        $em = $this->getDoctrine()->getManager();

        $ppp1 = $em->getRepository('App:Menu')->findMenus();
        //$ppp2 = $em->getRepository('App:Texto')->findTextos(2);
        $linka = 2;

        return $this->render('sobremi.html.twig', array(
           'ppp1' => $ppp1, 'linka' => $linka
               )); 
    }     

    /** 
     * @Route("/sobreelcentro", name="sobreelcentro")
     */
    public function menu3Action()
    {   
        $em = $this->getDoctrine()->getManager();

        $ppp1 = $em->getRepository('App:Menu')->findMenus();
        //$ppp2 = $em->getRepository('App:Texto')->findTextos(3);
        $linka = 3;

        return $this->render('sobreelcentro.html.twig', array(
           'ppp1' => $ppp1, 'linka' => $linka
               )); 
    }     

    /** 
     * @Route("/objetivos", name="objetivos")
     */
    public function menu4anteriorAction()
    {   
        return $this->redirectToRoute('ayudaprofesional');
    }     


    /** 
     * @Route("/ayudaprofesional", name="ayudaprofesional")
     */
    public function menu4Action()
    {   
        $em = $this->getDoctrine()->getManager();

        $ppp1 = $em->getRepository('App:Menu')->findMenus();
        //$ppp2 = $em->getRepository('App:Texto')->findTextos(4);
        $linka = 4;

        return $this->render('ayudaprofesional.html.twig', array(
           'ppp1' => $ppp1, 'linka' => $linka
               )); 
    }     

    /** 
     * @Route("/servicios", name="servicios")
     */
    public function menu5Action()
    {
        $em = $this->getDoctrine()->getManager();

        $ppp1 = $em->getRepository('App:Menu')->findMenus();
        //$ppp2 = $em->getRepository('App:Texto')->findTextos(5);
        $linka = 5;

        return $this->render('servicios.html.twig', array(
           'ppp1' => $ppp1, 'linka' => $linka
               ));
    }

    /** 
     * @Route("/actividades", name="actividades")
     */
    public function menu6Action()
    {
        $em = $this->getDoctrine()->getManager();

        $ppp1 = $em->getRepository('App:Menu')->findMenus();
        //$ppp2 = $em->getRepository('App:Texto')->findTextos(6);
        $linka = 6;

        return $this->render('actividades.html.twig', array(
           'ppp1' => $ppp1, 'linka' => $linka
               ));
    }

    /** 
     * @Route("/tarifas", name="tarifas")
     */
    public function menu7Action()
    {
        $em = $this->getDoctrine()->getManager();

        $ppp1 = $em->getRepository('App:Menu')->findMenus();
        //$ppp2 = $em->getRepository('App:Texto')->findTextos(7);
        $linka = 7;

        return $this->render('tarifas.html.twig', array(
           'ppp1' => $ppp1, 'linka' => $linka
               ));
    }

     /** 
     * @Route("/contacto", name="contacto")
     */
    public function menu8Action()
    {
        $em = $this->getDoctrine()->getManager();

        $ppp1 = $em->getRepository('App:Menu')->findMenus();
        //$ppp2 = $em->getRepository('App:Texto')->findTextos(7);
        $linka = 8;

        return $this->render('contacto.html.twig', array(
           'ppp1' => $ppp1, 'linka' => $linka
               ));
    }
   
     /**
     * @Route("/grafico", name="grafico")
     */
    public function grafico1Action()
    {
      $pctCalculo=50; 
      $pctC_fisico=65;
      $pctC_biologico=25;
      $pctMecanico=15;
      $pctServiciosocial=85;
      $pctLiterario=45;
      $pctPersuasivo=5;
      $pctArtistico=15; 
      $pctMusico=95;

        return $this->render('test/grafico.html.twig', array(
               'pctCalculo' => $pctCalculo, 'pctC_fisico' => $pctC_fisico, 'pctC_biologico' => $pctC_biologico, 'pctMecanico' => $pctMecanico, 'pctServiciosocial' => $pctServiciosocial, 'pctLiterario' => $pctLiterario, 'pctPersuasivo' => $pctPersuasivo, 'pctArtistico' => $pctArtistico, 'pctMusico' => $pctMusico
            ));

    }
   
}
