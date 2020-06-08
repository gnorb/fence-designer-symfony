<?php
namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\FenceDesignerService;

use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class FenceDesignerController extends Controller
{
    /**
     * @Route("/pdf", name="app_api_pdf", methods={"GET"})
     */
    public function pdf(Request $request, FenceDesignerService $fenceDesignerService)
    {
        $data = [];
        $image = $request->query->get('image');
        $data['imagePath'] = $fenceDesignerService->saveBase64Image($image);
        $pdfData = $fenceDesignerService->createFencePdf($data);

        $response = new BinaryFileResponse($pdfData['path']);
        $disposition = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $pdfData['filename']
        );
        $response->headers->set('Content-Disposition', $disposition);
        $response->deleteFileAfterSend(true);
        return $response;
    }
}