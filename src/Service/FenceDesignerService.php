<?php
namespace App\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use TCPDF;

class FenceDesignerService
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function saveBase64Image (string $base64image) {
        $now = (new \DateTime())->format('Ymdhis');
        $fileName = $now . '_image.png';
        $base64 = str_replace('data:image/png;base64,', '', $base64image);
        $path = $this->container->getParameter('pdf_dir') . $fileName;
        $file = fopen($path, 'wb');
        fwrite($file, base64_decode($base64));
        fclose($file);

        return $path;
    }

    public function createFencePdf (array $data) {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Fence Designer');
        $pdf->SetTitle('Projekt ogrodzenia');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetFont('times', 'BI', 20);
        $pdf->AddPage();

        $html = $this->container->get('templating')->render('default/mypdf.html.twig', [
            'title' => "Welcome to our PDF Test",
            'image' => $data['imagePath']
        ]);

        $pdf->writeHTML($html, true, false, true, false, '');

        $filename = (new \DateTime())->format('Ymdhis') . '_pdf.pdf';

        $path = $this->container->getParameter('pdf_dir') . $filename;
        $pdf->Output($path, 'F');

        $return['filename'] = $filename;
        $return['path'] = $path;
        unlink($data['imagePath']);

        return $return;
    }
}