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
use App\Service\Percentiles;
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

        $html = $this->renderView('test/pdfintocupacionales.html.twig', [
            'nombre' => $nombre, 'edad' => $edad, 'sexo' => $sexo, 'Aire Libre' => $Aire_libre, 'Mecánicos' => $Mecanicos, 'De Cálculo' => $De_calculo, 'Científicos' => $Cientificos, 'Persuasivo' => $Persuasivo, 'Artístico Plásticos' => $Artistico_plasticos, 'Literarios' => $Literarios, 'Musicales' => $Musicales, 'De Servicio Social' => $De_servicio_social, 'Oficina' => $Oficina, 'arrayordenado' => $arrayordenado, 'ppp1' => $ppp1, 'linka' => $linka
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
    public function testKarlherefordAction(Request $request, Percentiles $percentiles)
    {
        $testkarlhereford = new Testkarlhereford();

        $form = $this->createForm(TestkarlherefordFormType::class, $testkarlhereford);
        $form->handleRequest($request);

        // Check is valid
        if ($form->isSubmitted() && $form->isValid()) {
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

            $sexo = $form["sexo"]->getData();

            $arrayordenado = array("Cálculo" => $Calculo, "Científico Físico" => $C_fisico, "Científico Biologico" => $C_biologico, "Mecánico" => $Mecanico, "Servicio Social" => $Serviciosocial, "Literario" => $Literario, "Persuasivo" => $Persuasivo, "Artístico" => $Artistico, "Músico" => $Musico);

            $arraypercentiles = $percentiles->calcPercentil($sexo, $Calculo, $C_fisico, $C_biologico, $Mecanico, $Serviciosocial, $Literario, $Persuasivo, $Artistico, $Musico);

            $nombre = $form["nombre"]->getData();
            $edad = $form["edad"]->getData();
            $sexo = $form["sexo"]->getData();

            $respuestas = '0';

            for ($i = 1; $i < 91; $i++) {
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
                'form' => $form->createView(), 'nombre' => $nombre, 'edad' => $edad, 'sexo' => $sexo, 'Calculo' => $Calculo, 'C_fisico' => $C_fisico, 'C_biologico' => $C_biologico, 'Mecanico' => $Mecanico, 'Serviciosocial' => $Serviciosocial, 'Literario' => $Literario, 'Persuasivo' => $Persuasivo, 'Artistico' => $Artistico, 'Musico' => $Musico, 'arrayordenado' => $arrayordenado, 'pctCalculo' => $arraypercentiles['Cálculo'], 'pctC_fisico' => $arraypercentiles['Científico Físico'], 'pctC_biologico' => $arraypercentiles['Científico Biologico'], 'pctMecanico' => $arraypercentiles['Mecánico'], 'pctServiciosocial' => $arraypercentiles['Servicio Social'], 'pctLiterario' => $arraypercentiles['Literario'], 'pctPersuasivo' => $arraypercentiles['Persuasivo'], 'pctArtistico' => $arraypercentiles['Artístico'], 'pctMusico' => $arraypercentiles['Músico'], 'ppp1' => $ppp1, 'linka' => $linka
            ]);
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

            $arrayordenado = array('Aire Libre' => $Aire_libre, 'Mecánicos' => $Mecanicos, 'De Cálculo' => $De_calculo, 'Científicos' => $Cientificos, 'Persuasivo' => $Persuasivo, 'Artístico Plásticos' => $Artistico_plasticos, 'Literarios' => $Literarios, 'Musicales' => $Musicales, 'De Servicio Social' => $De_servicio_social, 'Oficina' => $Oficina);

            $nombre = $form["nombre"]->getData();
            $edad = $form["edad"]->getData();
            $sexo = $form["sexo"]->getData();

            $respuestas = '0';

            for ($i = 1; $i < 61; $i++) {
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
                'form' => $form->createView(), 'nombre' => $nombre, 'edad' => $edad, 'sexo' => $sexo, 'Aire_libre' => $Aire_libre, 'Mecanicos' => $Mecanicos, 'De_calculo' => $De_calculo, 'Cientificos' => $Cientificos, 'Persuasivo' => $Persuasivo, 'Artistico_plasticos' => $Artistico_plasticos, 'Literarios' => $Literarios, 'Musicales' => $Musicales, 'De_servicio_social' => $De_servicio_social, 'Oficina' => $Oficina, 'arrayordenado' => $arrayordenado, 'ppp1' => $ppp1, 'linka' => $linka
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

            for ($i = 1; $i < 56; $i++) {
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
