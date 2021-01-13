<?php
namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/juegos")
 */
class JuegosController extends Controller
{
	/** @var EntityManagerInterface */
	private $entityManager;
	/** @var \Doctrine\Common\Persistence\ObjectRepository */
	private $imagesRepository;
	/**
	 * @param EntityManagerInterface $entityManager
	 */
	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->entityManager = $entityManager;
		$this->imagesRepository = $entityManager->getRepository('App:Images');
	}

	/**
	 * @Route("/{tipo}", defaults={"tipo" = NULL}, name="juegos")
	 */
	public function juegosAction(Request $request, $tipo)
	{
		$em = $this->getDoctrine()->getManager();

		$ppp1 = $em->getRepository('App:Menu')->findMenus(); 
		$linka = 11;

		if(!isset($_GET['cantidadimages'])){
			$cantidadimages = 0;
		} else {
			$cantidadimages = $_GET['cantidadimages'];
			if($tipo == 'geometria'){
        $cantimgdesaparecidas = $_GET['cantimgdesaparecidas'];
          } else if ($tipo != 'formarpares') {
				$ppp3 = $em->getRepository('App:Images')->findRowsfixrand($cantidadimages, $tipo);
				$ppp2 = $em->getRepository('App:Images')->findRowsoriginal($tipo);
			}
		}


		if($tipo == NULL){
			return $this->render('juegos/index.html.twig', [
				'ppp1' => $ppp1, 'linka' => $linka
			]);
		} else {
			if($cantidadimages == 0){
				return $this->render('juegos/index1.html.twig', [
					'ppp1' => $ppp1, 'tipo' => $tipo, 'linka' => $linka
				]);
			} else {
			if($tipo == 'geometria'){
					return $this->redirectToRoute('observando', [
						'tipo' => $tipo, 'cantidadimages' => $cantidadimages, 'cantimgdesaparecidas' => $cantimgdesaparecidas
					]);
         } else if($tipo == 'formarpares'){
					return $this->redirectToRoute('pares', [
						'tipo' => $tipo, 'cantidadimages' => $cantidadimages
					]);
				} else {

					return $this->render('juegos/index2.html.twig', [
						'ppp1' => $ppp1, 'ppp2' => $ppp2, 'linka' => $linka, 'tipo' => $tipo, 'cantidadimages' => $cantidadimages
					]);         
				}
			}
		}
	}

	/**
	 * @Route("/{tipo}/ordenarimages", defaults={"tipo" = NULL}, name="ordenarimages")
	 */
	public function ordenarimagesAction(Request $request, $tipo)
	{
		$em = $this->getDoctrine()->getManager();

		$ppp1 = $em->getRepository('App:Menu')->findMenus(); 
		$ppp2 = $em->getRepository('App:Images')->findRowsrand($tipo);

		$linka = 11;

		//$cantidadimages = $_GET['cantidadimages'];

		return $this->render('juegos/ordenar.html.twig', [
			'ppp1' => $ppp1, 'ppp2' => $ppp2, 'tipo' => $tipo, 'linka' => $linka
		]);         
	}



	/**
	 * @Route("/{tipo}/updateordenarimages", defaults={"tipo" = NULL}, name="updateordenarimages")
	 */
	public function updateordenarimagesAction(Request $request, $tipo)
	{
		$em = $this->getDoctrine()->getManager();

		//$ppp1 = $em->getRepository('App:Menu')->findMenus();

		//get images id and generate ids array
		$idarray = explode(",",$_POST['ids']);

		$ppp2 = $em->getRepository('App:Images')->findUpdateorder($idarray, $tipo);

		//$linka = 11;

		//$cantidadimages = $_GET['cantidadimages'];

		return $this->redirectToRoute('resultadoimages', [
			'tipo' => $tipo
		]);
	}      

	/**
	 * @Route("/{tipo}/resultadoimages", defaults={"tipo" = NULL }, name="resultadoimages")
	 */
	public function resultadoimagesAction(Request $request, $tipo)
	{
		$em = $this->getDoctrine()->getManager();

		//$iraresultados = $this->get('session')->getFlashBag()->get('iraresultado');


		//if($iraresultados != NULL){
		//get images id and generate ids array
		/*$idarray = explode(",",$_POST['ids']);
		$ppp0 = $em->getRepository('App:Images')->findUpdateorder($idarray);*/
		//$iraresultados = 1;
		//$this->get('session')->getFlashBag()->add('iraresultados', $iraresultados);
		//return $this->redirectAction('resultadoimages');
		//} else {

		$ppp1 = $em->getRepository('App:Menu')->findMenus();
		$ppp2 = $em->getRepository('App:Images')->findRows($tipo);
		$ppp3 = $em->getRepository('App:Images')->findRowsoriginal($tipo);

		$linka = 11;

		return $this->render('juegos/resultadoimages.html.twig', [
			'ppp1' => $ppp1, 'ppp2' => $ppp2, 'ppp3' => $ppp3, 'tipo' => $tipo, 'linka' => $linka
		]);
		//}
	}

	/**
	 * @Route("/{tipo}/observando", defaults={"tipo" = NULL}, name="observando")
	 */
	public function observandoAction(Request $request, $tipo)
	{
		$em = $this->getDoctrine()->getManager();

		$ppp1 = $em->getRepository('App:Menu')->findMenus(); 
		$linka = 11;

	$cantidadimages = $_GET['cantidadimages'];
	$cantimgdesaparecidas = $_GET['cantimgdesaparecidas'];

		$xarray = [];
		$yarray = [];

		for ($i=0; $i<10; $i++){
			$xelement = rand(10,85);
			$yelement = rand(10,85);
			array_push($xarray,$xelement);
			array_push($yarray,$yelement);
		}


		$ordinales = array("uno", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve", "diez");
		$b = array_rand($ordinales, $cantidadimages);

		$imagenes = array("circlebig.gif", "circulogris.gif", "elipseamarillo.gif", "elipsenegro.gif", "rectanguloazul.gif", "rectangulopurpura.gif", "trianguloblanco.gif", "triangulorojo.gif", "circuloamarillo.gif", "circulonegro.gif", "elipseazul.gif", "elipsepurpura.gif", "rectanguloblanco.gif", "rectangulorojo.gif", "triangulogris.gif", "circuloazul.gif", "circulopurpura.gif", "elipseblanco.gif", "elipserojo.gif", "rectangulogris.gif", "trianguloamarillo.gif", "triangulonegro.gif", "circuloblanco.gif", "circulorojo.gif", "elipsegris.gif", "rectanguloamarillo.gif", "rectangulonegro.gif", "trianguloazul.gif", "triangulopurpura.gif");
		$z = array_rand($imagenes, $cantidadimages);



		$c = [];
		$y = [];

		for ($i=0; $i<$cantidadimages; $i++){
			array_push($c,$ordinales[$b[$i]]);
			array_push($y,$imagenes[$z[$i]]);
		}


		$d = array_rand($c, $cantimgdesaparecidas);

		$primerdesaparecido = $c[$d[0]];
		$segundodesaparecido = $c[$d[1]];
		if(isset($d[2])){$tercerdesaparecido = $c[$d[2]];} else {$tercerdesaparecido = NULL;}
		if(isset($d[3])){$cuartodesaparecido = $c[$d[3]];} else {$cuartodesaparecido = NULL;}



		return $this->render('juegos/observando2.html.twig', [
			'ppp1' => $ppp1, 'linka' => $linka, 'xarray' => $xarray, 'yarray' => $yarray, 'c' => $c, 'primerdesaparecido' => $primerdesaparecido,  'segundodesaparecido' => $segundodesaparecido, 'tercerdesaparecido' => $tercerdesaparecido,  'cuartodesaparecido' => $cuartodesaparecido,'tipo' => $tipo, 'cantidadimages' => $cantidadimages, 'y' => $y
		]);         
	}


   /**
	 * @Route("/{tipo}/pares", defaults={"tipo" = NULL}, name="pares")
	 */
	public function paresAction(Request $request, $tipo)
	{
		$em = $this->getDoctrine()->getManager();

		$ppp1 = $em->getRepository('App:Menu')->findMenus(); 
		$linka = 11;

	$cantidadimages = $_GET['cantidadimages'];

	/*		$xarray = [140, 360, 580, 800, 1020, 140, 360, 580, 800, 1020, 140, 360, 580, 800, 1020, 140, 360, 580, 800, 1020 ];
   $yarray = [580, 580, 580, 580, 580, 730, 730, 730, 730, 730, 880, 880, 880, 880, 880, 1030, 1030, 1030, 1030, 1030];*/

	$xarray = [5, 24, 43, 62, 81, 5, 24, 43, 62, 81, 5, 24, 43, 62, 81, 5, 24, 43, 62, 81 ];
		$yarray = [6, 6, 6, 6, 6, 28, 28, 28, 28, 28, 50, 50, 50, 50, 50, 72, 72, 72, 72, 72];

	$ordinales = array("uno", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve", "diez", "once", "doce", "trece", "catorce", "quince", "dieciseis", "diecisiete", "dieciocho", "diecinueve", "veinte");
      $ordinalesenorden = $ordinales;
      shuffle($ordinales);

	$imagenes = array("1.jpg", "2.jpg", "3.jpg", "4.jpg", "5.jpg", "6.jpg", "7.jpg", "8.jpg", "9.jpg", "10.jpg", "1.jpg", "2.jpg", "3.jpg", "4.jpg", "5.jpg", "6.jpg", "7.jpg", "8.jpg", "9.jpg", "10.jpg");


		return $this->render('juegos/pares22.html.twig', [
			'ppp1' => $ppp1, 'linka' => $linka, 'xarray' => $xarray, 'yarray' => $yarray, 'tipo' => $tipo, 'cantidadimages' => $cantidadimages, 'ordinales' => $ordinales, 'ordinalesenorden' => $ordinalesenorden, 'imagenes' => $imagenes
		]);         
	}

}
