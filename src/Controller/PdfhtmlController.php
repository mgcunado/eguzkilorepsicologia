<?php
namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PdfhtmlController extends Controller {

    /**
     * @Route("/ficha-tecnica", name="app_download_specifications")
     */
    public function downloadSpecifications() {
        $html = $this->renderView('download-specifications/pdf.html.twig');

        $filename = sprintf('specifications-%s.pdf', date('Y-m-d-hh-ss'));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            ]
        );
    }
}
