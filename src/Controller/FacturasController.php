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

class FacturasController extends Controller
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $facturasRepository;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->facturasRepository = $entityManager->getRepository('App:Facturas');
    }

    /**
     * @Route("/admin/impfacturas", name="impfacturas")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function impfacturasAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $ppp1 = $em->getRepository('App:Facturas')->findUltimasfacturas();
        $ultimafactura = $ppp1[0]['numerofactura'];
        $penultimafactura = $ppp1[1]['numerofactura'];
        $terceraultimafactura = $ppp1[2]['numerofactura'];
        $cuartaultimafactura = $ppp1[3]['numerofactura'];
        $quintaultimafactura = $ppp1[4]['numerofactura'];
        $sextaultimafactura = $ppp1[5]['numerofactura'];
        $septimaultimafactura = $ppp1[6]['numerofactura'];
        $octavaultimafactura = $ppp1[7]['numerofactura'];
        $novenaultimafactura = $ppp1[8]['numerofactura'];
        $decimaultimafactura = $ppp1[9]['numerofactura'];

        $imprimirfactura = new Facturas();

        $form = $this->createForm(FacturasFormType::class, $imprimirfactura, ['ultimafactura' => $ultimafactura, 'penultimafactura' => $penultimafactura, 'terceraultimafactura' => $terceraultimafactura, 'cuartaultimafactura' => $cuartaultimafactura, 'quintaultimafactura' => $quintaultimafactura, 'sextaultimafactura' => $sextaultimafactura, 'septimaultimafactura' => $septimaultimafactura, 'octavaultimafactura' => $octavaultimafactura, 'novenaultimafactura' => $novenaultimafactura, 'decimaultimafactura' => $decimaultimafactura]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $numerofactura = $form["numerofactura"]->getData();

            $em = $this->getDoctrine()->getManager();

            $ppp1 = $em->getRepository('App:Facturas')->findFactura($numerofactura);

            return $this->render('facturas/factura.html.twig', [
                'ppp1' => $ppp1
            ]);
        }

        return $this->render('facturas/form_factura.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/pdfimpfacturas", name="pdfimpfacturas")
     */
    public function pdfimpfacturasAction()
    {
        $em = $this->getDoctrine()->getManager();
        $numerofactura = $_GET['numerofactura'];
        $ppp1 = $em->getRepository('App:Facturas')->findFactura($numerofactura);

        $html = $this->renderView('facturas/pdffactura.html.twig', [
            'ppp1' => $ppp1
        ]);

        // nombre para el archivo pdf generado
        $filename = sprintf('factura%s.pdf', $numerofactura);

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
}
