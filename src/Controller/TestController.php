<?php
namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Testkarlhereford;
use App\Entity\Testintocupacionales;
use App\Entity\Testintaptitudes;
use App\Entity\Realizadostkh;
use App\Form\TestkarlherefordFormType;
use App\Form\TestintocupacionalesFormType;
use App\Form\TestintaptitudesFormType;
use App\Form\UpdateFormType;

use Symfony\Component\HttpFoundation\Response;

use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;

/**
 * @Route("/testadmin")
 */
class TestController extends Controller
{
  /** @var EntityManagerInterface */
  private $entityManager;

  /** @var \Doctrine\Common\Persistence\ObjectRepository */
  private $testkarlherefordRepository;

  /**
   * @param EntityManagerInterface $entityManager
   */
  public function __construct(EntityManagerInterface $entityManager)
  {
    $this->entityManager = $entityManager;
    $this->testkarlherefordRepository = $entityManager->getRepository('App:Testkarlhereford');
  }


  /**
   * @Route("/", name="test_listado")
   *
   * @param Request $request
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function testListadoAction(Request $request)
  {

       $em = $this->getDoctrine()->getManager();
      $ppp1 = $em->getRepository('App:Menu')->findMenus();
      $linka = 8;

   
     return $this->render('test/test_listado.html.twig', [
      'ppp1' => $ppp1, 'linka' => $linka
    ]);
  } 


  /**
   * @Route("/pdfkarlhereford", name="test_karlhereford_pdf")
   *
   * @param Request $request
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function pdfKarlherefordAction(Request $request)
  {

       $em = $this->getDoctrine()->getManager();
      $ppp1 = $em->getRepository('App:Menu')->findMenus();
      $linka = 8;

      $nombre = $_GET['nombre'];
      $edad = $_GET['edad'];
      $sexo = $_GET['sexo'];
      $Calculo = $_GET['Calculo'];
      $C_fisico = $_GET['C_fisico'];
      $C_biologico = $_GET['C_biologico'];
      $Mecanico = $_GET['Mecanico'];
      $Serviciosocial = $_GET['Serviciosocial'];
      $Literario = $_GET['Literario'];
      $Persuasivo = $_GET['Persuasivo'];
      $Artistico = $_GET['Artistico'];
      $Musico = $_GET['Musico'];

      $arrayordenado = $_GET['arrayordenado'];

      $pctCalculo = $_GET['pctCalculo'];
      $pctC_fisico = $_GET['pctC_fisico'];
      $pctC_biologico = $_GET['pctC_biologico'];
      $pctMecanico = $_GET['pctMecanico'];
      $pctServiciosocial = $_GET['pctServiciosocial'];
      $pctLiterario = $_GET['pctLiterario'];
      $pctPersuasivo = $_GET['pctPersuasivo'];
      $pctArtistico = $_GET['pctArtistico'];
      $pctMusico = $_GET['pctMusico'];

     
       $html = $this->renderView('test/pdfkarlhereford.html.twig', [
        'nombre' => $nombre, 'edad' => $edad, 'sexo' => $sexo, 'Calculo' => $Calculo, 'C_fisico' => $C_fisico, 'C_biologico' => $C_biologico, 'Mecanico' => $Mecanico, 'Serviciosocial' => $Serviciosocial, 'Literario' => $Literario, 'Persuasivo' => $Persuasivo, 'Artistico' => $Artistico, 'Musico' => $Musico, 'arrayordenado' => $arrayordenado, 'pctCalculo' => $pctCalculo, 'pctC_fisico' => $pctC_fisico, 'pctC_biologico' => $pctC_biologico, 'pctMecanico' => $pctMecanico, 'pctServiciosocial' => $pctServiciosocial, 'pctLiterario' => $pctLiterario, 'pctPersuasivo' => $pctPersuasivo, 'pctArtistico' => $pctArtistico, 'pctMusico' => $pctMusico, 'ppp1' => $ppp1, 'linka' => $linka
      ]);

      // nombre para el archivo pdf generado
      $filename = sprintf('Test_KarlHereford-%s.pdf', date('Y-m-d-Hi'));

      return new PdfResponse(
        $this->get('knp_snappy.pdf')->getOutputFromHtml($html, [
          'images' => true,
          'enable-javascript' => true,
          'page-size' => 'A4',
          'viewport-size' => '1280x1024',
          'margin-left' => '10mm',
          'margin-right' => '10mm',
          'margin-top' => '15mm',
          'margin-bottom' => '15mm',
        ]),        
        $filename,
        [
          'Content-Type'        => 'application/pdf',
          'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
        ]
      ); 
  } 

  /**
   * @Route("/pdfintaptitudes", name="test_intaptitudes_pdf")
   *
   * @param Request $request
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function pdfIntaptitudesAction(Request $request)
  {

       $em = $this->getDoctrine()->getManager();
      $ppp1 = $em->getRepository('App:Menu')->findMenus();
      $linka = 8;

      $nombre = $_GET['nombre'];
      $edad = $_GET['edad'];
      $sexo = $_GET['sexo'];
      $Verbal = $_GET['Verbal'];
      $Numericas = $_GET['Numericas'];
      $Mecanica_constructiva = $_GET['Mecanica_constructiva'];
      $Artistico_plastica = $_GET['Artistico_plastica'];
      $Musical = $_GET['Musical'];
      $Cientifica = $_GET['Cientifica'];
      $Social = $_GET['Social'];
      $Destreza_manual = $_GET['Destreza_manual'];
      $Practica = $_GET['Practica'];
      $Ejecutiva = $_GET['Ejecutiva'];
      $Trabajo_de_oficina = $_GET['Trabajo_de_oficina'];
      $arrayordenado = $_GET['arrayordenado'];
      
         /*$html = $this->renderView('test/pdfprueba.html.twig', [
        'nombre' => $nombre, 'edad' => $edad, 'sexo' => $sexo, 'ppp1' => $ppp1, 'linka' => $linka
      ]);*/

       $html = $this->renderView('test/pdfintaptitudes.html.twig', [
        'nombre' => $nombre, 'edad' => $edad, 'sexo' => $sexo, 'Verbal' => $Verbal, 'Numericas' => $Numericas, 'Mecanica_constructiva' => $Mecanica_constructiva, 'Artistico_plastica' => $Artistico_plastica, 'Musical' => $Musical, 'Cientifica' => $Cientifica, 'Social' => $Social, 'Destreza_manual' => $Destreza_manual, 'Practica' => $Practica, 'Ejecutiva' => $Ejecutiva, 'Trabajo_de_oficina' => $Trabajo_de_oficina, 'arrayordenado' => $arrayordenado, 'ppp1' => $ppp1, 'linka' => $linka
      ]);

      // nombre para el archivo pdf generado
      $filename = sprintf('Test_InteresesAptitudes-%s.pdf', date('Y-m-d-Hi'));

      return new PdfResponse(
        $this->get('knp_snappy.pdf')->getOutputFromHtml($html, [
          'images' => true,
          'enable-javascript' => true,
          'page-size' => 'A4',
          'viewport-size' => '1280x1024',
          'margin-left' => '10mm',
          'margin-right' => '10mm',
          'margin-top' => '15mm',
          'margin-bottom' => '15mm',
        ]),        
        $filename,
        [
          'Content-Type'        => 'application/pdf',
          'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
        ]
      ); 
  }  

  /**
   * @Route("/pdfintocupacionales", name="test_intocupacionales_pdf")
   *
   * @param Request $request
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function pdfIntocupacionalesAction(Request $request)
  {

       $em = $this->getDoctrine()->getManager();
      $ppp1 = $em->getRepository('App:Menu')->findMenus();
      $linka = 8;

      $nombre = $_GET['nombre'];
      $edad = $_GET['edad'];
      $sexo = $_GET['sexo'];
      $Aire_libre = $_GET['Aire_libre'];
      $Mecanicos = $_GET['Mecanicos'];
      $De_calculo = $_GET['De_calculo'];
      $Cientificos = $_GET['Cientificos'];
      $Persuasivo = $_GET['Persuasivo'];
      $Artistico_plasticos = $_GET['Artistico_plasticos'];
      $Literarios = $_GET['Literarios'];
      $Musicales = $_GET['Musicales'];
      $De_servicio_social = $_GET['De_servicio_social'];
      $Oficina = $_GET['Oficina'];
      $arrayordenado = $_GET['arrayordenado'];
      
         /*$html = $this->renderView('test/pdfprueba.html.twig', [
        'nombre' => $nombre, 'edad' => $edad, 'sexo' => $sexo, 'ppp1' => $ppp1, 'linka' => $linka
      ]);*/

       $html = $this->renderView('test/pdfintocupacionales.html.twig', [
        'nombre' => $nombre, 'edad' => $edad, 'sexo' => $sexo, 'Aire Libre' => $Aire_libre, 'Mecánicos' => $Mecanicos, 'De Cálculo' => $De_calculo, 'Científicos' => $Cientificos, 'Persuasivo' => $Persuasivo, 'Artístico Plásticos' => $Artistico_plasticos, 'Literarios' => $Literarios, 'Musicales' => $Musicales, 'De Servicio Social' => $De_servicio_social, 'Oficina' =>$Oficina, 'arrayordenado' => $arrayordenado, 'ppp1' => $ppp1, 'linka' => $linka
      ]);

      // nombre para el archivo pdf generado
      $filename = sprintf('Test_InteresesOcupacionales-%s.pdf', date('Y-m-d-Hi'));

      return new PdfResponse(
        $this->get('knp_snappy.pdf')->getOutputFromHtml($html, [
          'images' => true,
          'enable-javascript' => true,
          'page-size' => 'A4',
          'viewport-size' => '1280x1024',
          'margin-left' => '10mm',
          'margin-right' => '10mm',
          'margin-top' => '15mm',
          'margin-bottom' => '15mm',
        ]),        
        $filename,
        [
          'Content-Type'        => 'application/pdf',
          'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
        ]
      ); 
  } 

  /**
   * @Route("/test-karlhereford", name="test_karlhereford")
   *
   * @param Request $request
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function testKarlherefordAction(Request $request)
  {
    $testkarlhereford = new Testkarlhereford();

    $form = $this->createForm(TestkarlherefordFormType::class, $testkarlhereford);
    $form->handleRequest($request);

    // Check is valid
    if ($form->isSubmitted() && $form->isValid()) {
      //$this->entityManager->persist($testkarlhereford);
      //$this->entityManager->flush($testkarlhereford);

      $this->addFlash('success', 'Felicidades! Tu test ha sido enviado');

      $Calculo = $_POST['3'] + $_POST['11'] + $_POST['22'] + $_POST['32'] + $_POST['37'] + $_POST['48'] + $_POST['59'] + $_POST['64'] + $_POST['73'] + $_POST['88'];
      $C_fisico = $_POST['8'] + $_POST['14'] + $_POST['30'] + $_POST['39'] + $_POST['45'] + $_POST['53'] + $_POST['57'] + $_POST['68'] + $_POST['81'] + $_POST['84'];
      $C_biologico = $_POST['5'] + $_POST['18'] + $_POST['24'] + $_POST['36'] + $_POST['40'] + $_POST['51'] + $_POST['61'] + $_POST['69'] + $_POST['76'] + $_POST['90'];
      $Mecanico = $_POST['1'] + $_POST['16'] + $_POST['26'] + $_POST['34'] + $_POST['43'] + $_POST['46'] + $_POST['63'] + $_POST['66'] + $_POST['79'] + $_POST['82'];
      $Serviciosocial = $_POST['6'] + $_POST['13'] + $_POST['19'] + $_POST['21'] + $_POST['29'] + $_POST['49'] + $_POST['56'] + $_POST['71'] + $_POST['77'] + $_POST['86'];
      $Literario = $_POST['9'] + $_POST['12'] + $_POST['25'] + $_POST['28'] + $_POST['42'] + $_POST['52'] + $_POST['62'] + $_POST['67'] + $_POST['78'] + $_POST['83'];
      $Persuasivo = $_POST['2'] + $_POST['17'] + $_POST['27'] + $_POST['35'] + $_POST['38'] + $_POST['47'] + $_POST['55'] + $_POST['72'] + $_POST['75'] + $_POST['87'];
      $Artistico = $_POST['7'] + $_POST['10'] + $_POST['20'] + $_POST['31'] + $_POST['44'] + $_POST['50'] + $_POST['58'] + $_POST['65'] + $_POST['80'] + $_POST['85'];
      $Musico = $_POST['4'] + $_POST['15'] + $_POST['23'] + $_POST['33'] + $_POST['41'] + $_POST['54'] + $_POST['60'] + $_POST['70'] + $_POST['74'] + $_POST['89'];

      //percentiles
      $sexo = $form["sexo"]->getData();
      if ($sexo == 'Masculino'){
        if ($Calculo <= 12){$pctCalculo = 1; }
        else if ($Calculo >12 && $Calculo <= 17){$pctCalculo = 5; }
        else if ($Calculo >17 && $Calculo <= 20){$pctCalculo = 10; }
        else if ($Calculo >20 && $Calculo <= 25){$pctCalculo = 20; }
        else if ($Calculo >25 && $Calculo <= 30){$pctCalculo = 30; }
        else if ($Calculo >30 && $Calculo <= 34){$pctCalculo = 40; }
        else if ($Calculo >34 && $Calculo <= 37){$pctCalculo = 50; }
        else if ($Calculo >37 && $Calculo <= 39){$pctCalculo = 60; }
        else if ($Calculo >39 && $Calculo <= 42){$pctCalculo = 70; }
        else if ($Calculo >42 && $Calculo <= 44){$pctCalculo = 80; }
        else if ($Calculo >44 && $Calculo <= 47){$pctCalculo = 90; }
        else if ($Calculo == 48){$pctCalculo = 95; }
        else if ($Calculo >48){$pctCalculo = 99; }

        if ($C_fisico <= 18){$pctC_fisico = 1; }
        else if ($C_fisico >18 && $C_fisico <= 24){$pctC_fisico = 5; }
        else if ($C_fisico >24 && $C_fisico <= 27){$pctC_fisico = 10; }
        else if ($C_fisico >27 && $C_fisico <= 30){$pctC_fisico = 20; }
        else if ($C_fisico >30 && $C_fisico <= 32){$pctC_fisico = 30; }
        else if ($C_fisico >32 && $C_fisico <= 34){$pctC_fisico = 40; }
        else if ($C_fisico >34 && $C_fisico <= 36){$pctC_fisico = 50; }
        else if ($C_fisico >36 && $C_fisico <= 38){$pctC_fisico = 60; }
        else if ($C_fisico >38 && $C_fisico <= 39){$pctC_fisico = 70; }
        else if ($C_fisico >39 && $C_fisico <= 41){$pctC_fisico = 80; }
        else if ($C_fisico >41 && $C_fisico <= 44){$pctC_fisico = 90; }
        else if ($C_fisico >44 && $C_fisico <= 46){$pctC_fisico = 95; }
        else if ($C_fisico >46){$pctC_fisico = 99; }

        if ($C_biologico <= 15){$pctC_biologico = 1; }
        else if ($C_biologico >15 && $C_biologico <= 20){$pctC_biologico = 5; }
        else if ($C_biologico >20 && $C_biologico <= 22){$pctC_biologico = 10; }
        else if ($C_biologico >22 && $C_biologico <= 26){$pctC_biologico = 20; }
        else if ($C_biologico >26 && $C_biologico <= 27){$pctC_biologico = 30; }
        else if ($C_biologico >27 && $C_biologico <= 29){$pctC_biologico = 40; }
        else if ($C_biologico >29 && $C_biologico <= 32){$pctC_biologico = 50; }
        else if ($C_biologico >32 && $C_biologico <= 35){$pctC_biologico = 60; }
        else if ($C_biologico >35 && $C_biologico <= 37){$pctC_biologico = 70; }
        else if ($C_biologico >37 && $C_biologico <= 40){$pctC_biologico = 80; }
        else if ($C_biologico >40 && $C_biologico <= 44){$pctC_biologico = 90; }
        else if ($C_biologico >44 && $C_biologico <= 46){$pctC_biologico = 95; }
        else if ($C_biologico >46){$pctC_biologico = 99; }

        if ($Mecanico <= 16){$pctMecanico = 1; }
        else if ($Mecanico >16 && $Mecanico <= 22){$pctMecanico = 5; }
        else if ($Mecanico >22 && $Mecanico <= 26){$pctMecanico = 10; }
        else if ($Mecanico >26 && $Mecanico <= 30){$pctMecanico = 20; }
        else if ($Mecanico >30 && $Mecanico <= 32){$pctMecanico = 30; }
        else if ($Mecanico >32 && $Mecanico <= 34){$pctMecanico = 40; }
        else if ($Mecanico >34 && $Mecanico <= 36){$pctMecanico = 50; }
        else if ($Mecanico >36 && $Mecanico <= 38){$pctMecanico = 60; }
        else if ($Mecanico >38 && $Mecanico <= 40){$pctMecanico = 70; }
        else if ($Mecanico >40 && $Mecanico <= 42){$pctMecanico = 80; }
        else if ($Mecanico >42 && $Mecanico <= 45){$pctMecanico = 90; }
        else if ($Mecanico >45 && $Mecanico <= 47){$pctMecanico = 95; }
        else if ($Mecanico >47){$pctMecanico = 99; }

        if ($Serviciosocial <= 19){$pctServiciosocial = 1; }
        else if ($Serviciosocial >19 && $Serviciosocial <= 24){$pctServiciosocial = 5; }
        else if ($Serviciosocial >24 && $Serviciosocial <= 25){$pctServiciosocial = 10; }
        else if ($Serviciosocial >25 && $Serviciosocial <= 27){$pctServiciosocial = 20; }
        else if ($Serviciosocial >27 && $Serviciosocial <= 31){$pctServiciosocial = 30; }
        else if ($Serviciosocial >31 && $Serviciosocial <= 32){$pctServiciosocial = 40; }
        else if ($Serviciosocial >32 && $Serviciosocial <= 34){$pctServiciosocial = 50; }
        else if ($Serviciosocial >34 && $Serviciosocial <= 36){$pctServiciosocial = 60; }
        else if ($Serviciosocial >36 && $Serviciosocial <= 37){$pctServiciosocial = 70; }
        else if ($Serviciosocial >37 && $Serviciosocial <= 39){$pctServiciosocial = 80; }
        else if ($Serviciosocial >39 && $Serviciosocial <= 41){$pctServiciosocial = 90; }
        else if ($Serviciosocial >41 && $Serviciosocial <= 43){$pctServiciosocial = 95; }
        else if ($Serviciosocial >43){$pctServiciosocial = 99; }

        if ($Literario <= 15){$pctLiterario = 1; }
        else if ($Literario >15 && $Literario <= 22){$pctLiterario = 5; }
        else if ($Literario >22 && $Literario <= 23){$pctLiterario = 10; }
        else if ($Literario >23 && $Literario <= 26){$pctLiterario = 20; }
        else if ($Literario >26 && $Literario <= 28){$pctLiterario = 30; }
        else if ($Literario >28 && $Literario <= 30){$pctLiterario = 40; }
        else if ($Literario >30 && $Literario <= 32){$pctLiterario = 50; }
        else if ($Literario >32 && $Literario <= 33){$pctLiterario = 60; }
        else if ($Literario >33 && $Literario <= 35){$pctLiterario = 70; }
        else if ($Literario >35 && $Literario <= 37){$pctLiterario = 80; }
        else if ($Literario >37 && $Literario <= 40){$pctLiterario = 90; }
        else if ($Literario >40 && $Literario <= 42){$pctLiterario = 95; }
        else if ($Literario >42){$pctLiterario = 99; }

        if ($Persuasivo <= 18){$pctPersuasivo = 1; }
        else if ($Persuasivo >18 && $Persuasivo <= 22){$pctPersuasivo = 5; }
        else if ($Persuasivo >22 && $Persuasivo <= 23){$pctPersuasivo = 10; }
        else if ($Persuasivo >23 && $Persuasivo <= 25){$pctPersuasivo = 20; }
        else if ($Persuasivo >25 && $Persuasivo <= 27){$pctPersuasivo = 30; }
        else if ($Persuasivo >27 && $Persuasivo <= 29){$pctPersuasivo = 40; }
        else if ($Persuasivo >29 && $Persuasivo <= 31){$pctPersuasivo = 50; }
        else if ($Persuasivo >31 && $Persuasivo <= 33){$pctPersuasivo = 60; }
        else if ($Persuasivo >33 && $Persuasivo <= 35){$pctPersuasivo = 70; }
        else if ($Persuasivo >35 && $Persuasivo <= 37){$pctPersuasivo = 80; }
        else if ($Persuasivo >37 && $Persuasivo <= 40){$pctPersuasivo = 90; }
        else if ($Persuasivo >40 && $Persuasivo <= 42){$pctPersuasivo = 95; }
        else if ($Persuasivo >42){$pctPersuasivo = 99; }

        if ($Artistico <= 18){$pctArtistico = 1; }
        else if ($Artistico >18 && $Artistico <= 21){$pctArtistico = 5; }
        else if ($Artistico >21 && $Artistico <= 23){$pctArtistico = 10; }
        else if ($Artistico >23 && $Artistico <= 26){$pctArtistico = 20; }
        else if ($Artistico >26 && $Artistico <= 28){$pctArtistico = 30; }
        else if ($Artistico >28 && $Artistico <= 30){$pctArtistico = 40; }
        else if ($Artistico >30 && $Artistico <= 33){$pctArtistico = 50; }
        else if ($Artistico >33 && $Artistico <= 35){$pctArtistico = 60; }
        else if ($Artistico >35 && $Artistico <= 36){$pctArtistico = 70; }
        else if ($Artistico >36 && $Artistico <= 39){$pctArtistico = 80; }
        else if ($Artistico >39 && $Artistico <= 42){$pctArtistico = 90; }
        else if ($Artistico >42 && $Artistico <= 45){$pctArtistico = 95; }
        else if ($Artistico >45){$pctArtistico = 99; }

        if ($Musico <= 16){$pctMusico = 1; }
        else if ($Musico >16 && $Musico <= 21){$pctMusico = 5; }
        else if ($Musico >21 && $Musico <= 23){$pctMusico = 10; }
        else if ($Musico >23 && $Musico <= 26){$pctMusico = 20; }
        else if ($Musico >26 && $Musico <= 29){$pctMusico = 30; }
        else if ($Musico >29 && $Musico <= 31){$pctMusico = 40; }
        else if ($Musico >31 && $Musico <= 33){$pctMusico = 50; }
        else if ($Musico >33 && $Musico <= 34){$pctMusico = 60; }
        else if ($Musico >34 && $Musico <= 36){$pctMusico = 70; }
        else if ($Musico >36 && $Musico <= 38){$pctMusico = 80; }
        else if ($Musico >38 && $Musico <= 40){$pctMusico = 90; }
        else if ($Musico >40 && $Musico <= 43){$pctMusico = 95; }
        else if ($Musico >43){$pctMusico = 99; }

      } else if ($sexo == 'Femenino'){
        if ($Calculo <= 11){$pctCalculo = 1; }
        else if ($Calculo >11 && $Calculo <= 14){$pctCalculo = 5; }
        else if ($Calculo >14 && $Calculo <= 17){$pctCalculo = 10; }
        else if ($Calculo >17 && $Calculo <= 20){$pctCalculo = 20; }
        else if ($Calculo >20 && $Calculo <= 23){$pctCalculo = 30; }
        else if ($Calculo >23 && $Calculo <= 25){$pctCalculo = 40; }
        else if ($Calculo >25 && $Calculo <= 30){$pctCalculo = 50; }
        else if ($Calculo >30 && $Calculo <= 33){$pctCalculo = 60; }
        else if ($Calculo >33 && $Calculo <= 37){$pctCalculo = 70; }
        else if ($Calculo >37 && $Calculo <= 41){$pctCalculo = 80; }
        else if ($Calculo >41 && $Calculo <= 45){$pctCalculo = 90; }
        else if ($Calculo >45 && $Calculo <= 48){$pctCalculo = 95; }
        else if ($Calculo >48){$pctCalculo = 99; }

        if ($C_fisico <= 18){$pctC_fisico = 1; }
        else if ($C_fisico >18 && $C_fisico <= 22){$pctC_fisico = 5; }
        else if ($C_fisico >22 && $C_fisico <= 23){$pctC_fisico = 10; }
        else if ($C_fisico >23 && $C_fisico <= 27){$pctC_fisico = 20; }
        else if ($C_fisico >27 && $C_fisico <= 29){$pctC_fisico = 30; }
        else if ($C_fisico >29 && $C_fisico <= 32){$pctC_fisico = 40; }
        else if ($C_fisico >32 && $C_fisico <= 34){$pctC_fisico = 50; }
        else if ($C_fisico >34 && $C_fisico <= 36){$pctC_fisico = 60; }
        else if ($C_fisico >36 && $C_fisico <= 38){$pctC_fisico = 70; }
        else if ($C_fisico >38 && $C_fisico <= 40){$pctC_fisico = 80; }
        else if ($C_fisico >40 && $C_fisico <= 43){$pctC_fisico = 90; }
        else if ($C_fisico >43 && $C_fisico <= 46){$pctC_fisico = 95; }
        else if ($C_fisico >46){$pctC_fisico = 99; }

        if ($C_biologico <= 16){$pctC_biologico = 1; }
        else if ($C_biologico >16 && $C_biologico <= 22){$pctC_biologico = 5; }
        else if ($C_biologico >22 && $C_biologico <= 24){$pctC_biologico = 10; }
        else if ($C_biologico >24 && $C_biologico <= 26){$pctC_biologico = 20; }
        else if ($C_biologico >26 && $C_biologico <= 29){$pctC_biologico = 30; }
        else if ($C_biologico >29 && $C_biologico <= 31){$pctC_biologico = 40; }
        else if ($C_biologico >31 && $C_biologico <= 34){$pctC_biologico = 50; }
        else if ($C_biologico >34 && $C_biologico <= 36){$pctC_biologico = 60; }
        else if ($C_biologico >36 && $C_biologico <= 38){$pctC_biologico = 70; }
        else if ($C_biologico >38 && $C_biologico <= 40){$pctC_biologico = 80; }
        else if ($C_biologico >40 && $C_biologico <= 45){$pctC_biologico = 90; }
        else if ($C_biologico >45 && $C_biologico <= 47){$pctC_biologico = 95; }
        else if ($C_biologico >47){$pctC_biologico = 99; }

        if ($Mecanico <= 15){$pctMecanico = 1; }
        else if ($Mecanico >15 && $Mecanico <= 17){$pctMecanico = 5; }
        else if ($Mecanico >17 && $Mecanico <= 20){$pctMecanico = 10; }
        else if ($Mecanico >20 && $Mecanico <= 22){$pctMecanico = 20; }
        else if ($Mecanico >22 && $Mecanico <= 24){$pctMecanico = 30; }
        else if ($Mecanico >24 && $Mecanico <= 26){$pctMecanico = 40; }
        else if ($Mecanico >26 && $Mecanico <= 28){$pctMecanico = 50; }
        else if ($Mecanico >28 && $Mecanico <= 30){$pctMecanico = 60; }
        else if ($Mecanico >30 && $Mecanico <= 32){$pctMecanico = 70; }
        else if ($Mecanico >32 && $Mecanico <= 36){$pctMecanico = 80; }
        else if ($Mecanico >36 && $Mecanico <= 39){$pctMecanico = 90; }
        else if ($Mecanico >39 && $Mecanico <= 42){$pctMecanico = 95; }
        else if ($Mecanico >42){$pctMecanico = 99; }

        if ($Serviciosocial <= 25){$pctServiciosocial = 1; }
        else if ($Serviciosocial >25 && $Serviciosocial <= 28){$pctServiciosocial = 5; }
        else if ($Serviciosocial >28 && $Serviciosocial <= 30){$pctServiciosocial = 10; }
        else if ($Serviciosocial >30 && $Serviciosocial <= 32){$pctServiciosocial = 20; }
        else if ($Serviciosocial >32 && $Serviciosocial <= 35){$pctServiciosocial = 30; }
        else if ($Serviciosocial >35 && $Serviciosocial <= 37){$pctServiciosocial = 40; }
        else if ($Serviciosocial >37 && $Serviciosocial <= 38){$pctServiciosocial = 50; }
        else if ($Serviciosocial >38 && $Serviciosocial <= 40){$pctServiciosocial = 60; }
        else if ($Serviciosocial >40 && $Serviciosocial <= 42){$pctServiciosocial = 70; }
        else if ($Serviciosocial >42 && $Serviciosocial <= 44){$pctServiciosocial = 80; }
        else if ($Serviciosocial >44 && $Serviciosocial <= 46){$pctServiciosocial = 90; }
        else if ($Serviciosocial >46 && $Serviciosocial <= 47){$pctServiciosocial = 95; }
        else if ($Serviciosocial >47){$pctServiciosocial = 99; }

        if ($Literario <= 15){$pctLiterario = 1; }
        else if ($Literario >15 && $Literario <= 24){$pctLiterario = 5; }
        else if ($Literario >24 && $Literario <= 25){$pctLiterario = 10; }
        else if ($Literario >25 && $Literario <= 28){$pctLiterario = 20; }
        else if ($Literario >28 && $Literario <= 30){$pctLiterario = 30; }
        else if ($Literario >30 && $Literario <= 32){$pctLiterario = 40; }
        else if ($Literario >32 && $Literario <= 34){$pctLiterario = 50; }
        else if ($Literario >34 && $Literario <= 36){$pctLiterario = 60; }
        else if ($Literario >36 && $Literario <= 38){$pctLiterario = 70; }
        else if ($Literario >38 && $Literario <= 40){$pctLiterario = 80; }
        else if ($Literario >40 && $Literario <= 43){$pctLiterario = 90; }
        else if ($Literario >43 && $Literario <= 46){$pctLiterario = 95; }
        else if ($Literario >46){$pctLiterario = 99; }

        if ($Persuasivo <= 15){$pctPersuasivo = 1; }
        else if ($Persuasivo >15 && $Persuasivo <= 20){$pctPersuasivo = 5; }
        else if ($Persuasivo >20 && $Persuasivo <= 23){$pctPersuasivo = 10; }
        else if ($Persuasivo >23 && $Persuasivo <= 26){$pctPersuasivo = 20; }
        else if ($Persuasivo >26 && $Persuasivo <= 28){$pctPersuasivo = 30; }
        else if ($Persuasivo >28 && $Persuasivo <= 29){$pctPersuasivo = 40; }
        else if ($Persuasivo >29 && $Persuasivo <= 31){$pctPersuasivo = 50; }
        else if ($Persuasivo >31 && $Persuasivo <= 33){$pctPersuasivo = 60; }
        else if ($Persuasivo >33 && $Persuasivo <= 35){$pctPersuasivo = 70; }
        else if ($Persuasivo >35 && $Persuasivo <= 37){$pctPersuasivo = 80; }
        else if ($Persuasivo >37 && $Persuasivo <= 41){$pctPersuasivo = 90; }
        else if ($Persuasivo >41 && $Persuasivo <= 43){$pctPersuasivo = 95; }
        else if ($Persuasivo >43){$pctPersuasivo = 99; }

        if ($Artistico <= 20){$pctArtistico = 1; }
        else if ($Artistico >20 && $Artistico <= 25){$pctArtistico = 5; }
        else if ($Artistico >25 && $Artistico <= 27){$pctArtistico = 10; }
        else if ($Artistico >27 && $Artistico <= 30){$pctArtistico = 20; }
        else if ($Artistico >30 && $Artistico <= 32){$pctArtistico = 30; }
        else if ($Artistico >32 && $Artistico <= 34){$pctArtistico = 40; }
        else if ($Artistico >34 && $Artistico <= 35){$pctArtistico = 50; }
        else if ($Artistico >35 && $Artistico <= 37){$pctArtistico = 60; }
        else if ($Artistico >37 && $Artistico <= 40){$pctArtistico = 70; }
        else if ($Artistico >40 && $Artistico <= 43){$pctArtistico = 80; }
        else if ($Artistico >43 && $Artistico <= 47){$pctArtistico = 90; }
        else if ($Artistico >47 && $Artistico <= 48){$pctArtistico = 95; }
        else if ($Artistico >48){$pctArtistico = 99; }

        if ($Musico <= 21){$pctMusico = 1; }
        else if ($Musico >21 && $Musico <= 22){$pctMusico = 5; }
        else if ($Musico >22 && $Musico <= 28){$pctMusico = 10; }
        else if ($Musico >28 && $Musico <= 32){$pctMusico = 20; }
        else if ($Musico >32 && $Musico <= 35){$pctMusico = 30; }
        else if ($Musico >35 && $Musico <= 36){$pctMusico = 40; }
        else if ($Musico >36 && $Musico <= 37){$pctMusico = 50; }
        else if ($Musico >37 && $Musico <= 38){$pctMusico = 60; }
        else if ($Musico >38 && $Musico <= 40){$pctMusico = 70; }
        else if ($Musico >40 && $Musico <= 42){$pctMusico = 80; }
        else if ($Musico >42 && $Musico <= 45){$pctMusico = 90; }
        else if ($Musico >45 && $Musico <= 47){$pctMusico = 95; }
        else if ($Musico >47){$pctMusico = 99; }

      }  

      $arrayordenado = array("Cálculo" => $Calculo, "Científico Físico" => $C_fisico, "Científico Biologico" => $C_biologico, "Mecánico" => $Mecanico, "Servicio Social" => $Serviciosocial, "Literario" => $Literario, "Persuasivo" => $Persuasivo, "Artístico" => $Artistico, "Músico" => $Musico);

      $arraypercentiles = array("Cálculo" => $pctCalculo, "Científico Físico" => $pctC_fisico, "Científico Biologico" => $pctC_biologico, "Mecánico" => $pctMecanico, "Servicio Social" => $pctServiciosocial, "Literario" => $pctLiterario, "Persuasivo" => $pctPersuasivo, "Artístico" => $pctArtistico, "Músico" => $pctMusico);


      $nombre = $form["nombre"]->getData();
      $edad = $form["edad"]->getData();
      $sexo = $form["sexo"]->getData();

      $respuestas = '0';

      for($i=1; $i<91; $i++){
        $respuestas = $respuestas . $_POST[$i];
      }


      $respuestastkh = new Realizadostkh();
      $respuestastkh->setNombre($nombre);
      $respuestastkh->setEdad($edad);
      $respuestastkh->setSexo($sexo);
      $respuestastkh->setRespuestas($respuestas);
      $em = $this->getDoctrine()->getManager();
      $em->persist($respuestastkh);
      $em->flush();  
      $ppp1 = $em->getRepository('App:Menu')->findMenus();
      $linka = 8;


      return $this->render('test/realizado_karlhereford.html.twig', [
        'form' => $form->createView(), 'nombre' => $nombre, 'edad' => $edad, 'sexo' => $sexo, 'Calculo' => $Calculo, 'C_fisico' => $C_fisico, 'C_biologico' => $C_biologico, 'Mecanico' => $Mecanico, 'Serviciosocial' => $Serviciosocial, 'Literario' => $Literario, 'Persuasivo' => $Persuasivo, 'Artistico' => $Artistico, 'Musico' => $Musico, 'arrayordenado' => $arrayordenado, 'pctCalculo' => $pctCalculo, 'pctC_fisico' => $pctC_fisico, 'pctC_biologico' => $pctC_biologico, 'pctMecanico' => $pctMecanico, 'pctServiciosocial' => $pctServiciosocial, 'pctLiterario' => $pctLiterario, 'pctPersuasivo' => $pctPersuasivo, 'pctArtistico' => $pctArtistico, 'pctMusico' => $pctMusico, 'ppp1' => $ppp1, 'linka' => $linka
      ]);

      //return $this->redirectToRoute('admin_entries');
    }

    $em = $this->getDoctrine()->getManager();

    $ppp1 = $em->getRepository('App:Menu')->findMenus();
    $ppp2 = $em->getRepository('App:Testkarlhereford')->findPreguntas(); 
    $linka = 8;

    return $this->render('test/test_karlhereford.html.twig', [
      'form' => $form->createView(), 'ppp1' => $ppp1, 'ppp2' => $ppp2, 'linka' => $linka
    ]);
  }    

  /**
   * @Route("/test-ocupacionales", name="test_ocupacionales")
   *
   * @param Request $request
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function testOcupacionalesAction(Request $request)
  {
    $testintocupacionales = new Testintocupacionales();

    $form = $this->createForm(TestintocupacionalesFormType::class, $testintocupacionales);
    $form->handleRequest($request);

    // Check is valid
    if ($form->isSubmitted() && $form->isValid()) {

      $this->addFlash('success', 'Felicidades! Tu test ha sido enviado');

      $Aire_libre = $_POST['1'] + $_POST['2'] + $_POST['3'] + $_POST['4'] + $_POST['5'] + $_POST['6'];
      $Mecanicos = $_POST['7'] + $_POST['8'] + $_POST['9'] + $_POST['10'] + $_POST['11'] + $_POST['12'];
      $De_calculo = $_POST['13'] + $_POST['14'] + $_POST['15'] + $_POST['16'] + $_POST['17'] + $_POST['18'];
      $Cientificos = $_POST['19'] + $_POST['20'] + $_POST['21'] + $_POST['22'] + $_POST['23'] + $_POST['24'];
      $Persuasivo = $_POST['25'] + $_POST['26'] + $_POST['27'] + $_POST['28'] + $_POST['29'] + $_POST['30'];
      $Artistico_plasticos = $_POST['31'] + $_POST['32'] + $_POST['33'] + $_POST['34'] + $_POST['35'] + $_POST['36'];
      $Literarios = $_POST['37'] + $_POST['38'] +  $_POST['39'] + $_POST['40'] + $_POST['41'] + $_POST['42'];
      $Musicales = $_POST['43'] + $_POST['44'] + $_POST['45'] + $_POST['46'] + $_POST['47'] + $_POST['48'];
      $De_servicio_social = $_POST['49'] + $_POST['50'] + $_POST['51'] + $_POST['52'] + $_POST['53'] + $_POST['54'];
      $Oficina = $_POST['55'] + $_POST['56'] + $_POST['57'] + $_POST['58'] + $_POST['59'] + $_POST['60'];

      $arrayordenado = array('Aire Libre' => $Aire_libre, 'Mecánicos' => $Mecanicos, 'De Cálculo' => $De_calculo, 'Científicos' => $Cientificos, 'Persuasivo' => $Persuasivo, 'Artístico Plásticos' => $Artistico_plasticos, 'Literarios' => $Literarios, 'Musicales' => $Musicales, 'De Servicio Social' => $De_servicio_social, 'Oficina' =>$Oficina);


      $nombre = $form["nombre"]->getData();
      $edad = $form["edad"]->getData();
      $sexo = $form["sexo"]->getData();

      $respuestas = '0';

      for($i=1; $i<61; $i++){
        $respuestas = $respuestas . $_POST[$i];
      }


      $respuestastkh = new Realizadostkh();
      $respuestastkh->setNombre($nombre);
      $respuestastkh->setEdad($edad);
      $respuestastkh->setSexo($sexo);
      $respuestastkh->setRespuestas($respuestas);
      $em = $this->getDoctrine()->getManager();
      $em->persist($respuestastkh);
      $em->flush();  
      $ppp1 = $em->getRepository('App:Menu')->findMenus();
      $linka = 8;


      return $this->render('test/realizado_intocupacionales.html.twig', [
        'form' => $form->createView(), 'nombre' => $nombre, 'edad' => $edad, 'sexo' => $sexo, 'Aire_libre' => $Aire_libre, 'Mecanicos' => $Mecanicos, 'De_calculo' => $De_calculo, 'Cientificos' => $Cientificos, 'Persuasivo' => $Persuasivo, 'Artistico_plasticos' => $Artistico_plasticos, 'Literarios' => $Literarios, 'Musicales' => $Musicales, 'De_servicio_social' => $De_servicio_social, 'Oficina' =>$Oficina, 'arrayordenado' => $arrayordenado, 'ppp1' => $ppp1, 'linka' => $linka
      ]);

    }

    $em = $this->getDoctrine()->getManager();

    $ppp1 = $em->getRepository('App:Menu')->findMenus();
    $ppp2 = $em->getRepository('App:Testkarlhereford')->findPreguntasocup(); 
    $linka = 8;

    return $this->render('test/test_intocupacionales.html.twig', [
      'form' => $form->createView(), 'ppp1' => $ppp1, 'ppp2' => $ppp2, 'linka' => $linka
    ]);
  }    

  /**
   * @Route("/test-aptitudes", name="test_aptitudes")
   *
   * @param Request $request
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function testAptitudesAction(Request $request)
  {
    $testintaptitudes = new Testintaptitudes();

    $form = $this->createForm(TestintaptitudesFormType::class, $testintaptitudes);
    $form->handleRequest($request);

    // Check is valid
    if ($form->isSubmitted() && $form->isValid()) {

      $this->addFlash('success', 'Felicidades! Tu test ha sido enviado');

      $Verbal = $_POST['1'] + $_POST['2'] + $_POST['3'] + $_POST['4'] + $_POST['5'];
      $Numericas = $_POST['6'] + $_POST['7'] + $_POST['8'] + $_POST['9'] + $_POST['10'];
      $Mecanica_constructiva = $_POST['11'] + $_POST['12'] + $_POST['13'] + $_POST['14'] + $_POST['15'];
      $Artistico_plastica = $_POST['16'] + $_POST['17'] + $_POST['18'] + $_POST['19'] + $_POST['20'];
      $Musical = $_POST['21'] + $_POST['22'] + $_POST['23'] + $_POST['24'] + $_POST['25'];
      $Cientifica = $_POST['26'] + $_POST['27'] + $_POST['28'] + $_POST['29'] + $_POST['30'];
      $Social = $_POST['31'] + $_POST['32'] + $_POST['33'] + $_POST['34'] + $_POST['35'];
      $Destreza_manual = $_POST['36'] + $_POST['37'] + $_POST['38'] + $_POST['39'] + $_POST['40'];
      $Practica = $_POST['41'] + $_POST['42'] + $_POST['43'] + $_POST['44'] + $_POST['45'];
      $Ejecutiva = $_POST['46'] + $_POST['47'] + $_POST['48'] + $_POST['49'] + $_POST['50'];
      $Trabajo_de_oficina = $_POST['51'] + $_POST['52'] + $_POST['53'] + $_POST['54'] + $_POST['55'];

      $arrayordenado = array('Verbal' => $Verbal, 'Numéricas' => $Numericas, 'Mecánica Constructiva' => $Mecanica_constructiva, 'Artístico Plástica' => $Artistico_plastica, 'Musical' => $Musical, 'Científica' => $Cientifica, 'Social' => $Social, 'Destreza Manual' => $Destreza_manual, 'Práctica' => $Practica, 'Ejecutiva' => $Ejecutiva, 'Trabajo de Oficina' => $Trabajo_de_oficina);


      $nombre = $form["nombre"]->getData();
      $edad = $form["edad"]->getData();
      $sexo = $form["sexo"]->getData();

      $respuestas = '0';

      for($i=1; $i<56; $i++){
        $respuestas = $respuestas . $_POST[$i];
      }


      $respuestastkh = new Realizadostkh();
      $respuestastkh->setNombre($nombre);
      $respuestastkh->setEdad($edad);
      $respuestastkh->setSexo($sexo);
      $respuestastkh->setRespuestas($respuestas);
      $em = $this->getDoctrine()->getManager();
      $em->persist($respuestastkh);
      $em->flush();  
      $ppp1 = $em->getRepository('App:Menu')->findMenus();
      $linka = 8;


      return $this->render('test/realizado_intaptitudes.html.twig', [
        'form' => $form->createView(), 'nombre' => $nombre, 'edad' => $edad, 'sexo' => $sexo, 'Verbal' => $Verbal, 'Numericas' => $Numericas, 'Mecanica_constructiva' => $Mecanica_constructiva, 'Artistico_plastica' => $Artistico_plastica, 'Musical' => $Musical, 'Cientifica' => $Cientifica, 'Social' => $Social, 'Destreza_manual' => $Destreza_manual, 'Practica' => $Practica, 'Ejecutiva' => $Ejecutiva, 'Trabajo_de_oficina' => $Trabajo_de_oficina, 'arrayordenado' => $arrayordenado, 'ppp1' => $ppp1, 'linka' => $linka
]);


    }

    $em = $this->getDoctrine()->getManager();

    $ppp1 = $em->getRepository('App:Menu')->findMenus();
    $ppp2 = $em->getRepository('App:Testkarlhereford')->findPreguntasaptitudes(); 
    $linka = 8;

    return $this->render('test/test_intaptitudes.html.twig', [
      'form' => $form->createView(), 'ppp1' => $ppp1, 'ppp2' => $ppp2, 'linka' => $linka
    ]);




  }    

}
