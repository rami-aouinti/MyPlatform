<?php

declare(strict_types=1);

namespace App\Service;

use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
use setasign\Fpdi\PdfParser\Filter\FilterException;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfParser\Type\PdfTypeException;
use setasign\Fpdi\PdfReader\PdfReaderException;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class PdfConverter
 * @package App\Service
 */
class PdfConverter
{

    /** KernelInterface $appKernel */
    private KernelInterface $appKernel;

    /**
     * PdfConverter constructor.
     * @param KernelInterface $appKernel
     */
    public function __construct(KernelInterface $appKernel)
    {
        $this->appKernel = $appKernel;
    }

    /**
     * @param $data
     * @param $template
     * @throws CrossReferenceException
     * @throws FilterException
     * @throws PdfParserException
     * @throws PdfTypeException
     * @throws PdfReaderException
     */
    public function generateResume($data, $template)
    {
        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($this->appKernel->getProjectDir() . $template);
        $pageId = $pdf->importPage($pageCount);

        $pdf->addPage();
        $pdf->useImportedPage($pageId, 0, 0, 250);
        // now write some text above the imported page
        $pdf->SetFont('Helvetica');
        $pdf->SetXY(70, 30);
        $pdf->Write(0, 'Formation');
        foreach ($data['formations'] as $formation) {
            $pdf->Write(0, $formation->getName());
        }
        $pdf->Write(0, 'Experience');
        foreach ($data['references'] as $reference) {
            $pdf->Write(0, $reference->getTitle());
        }
        $pdf->Write(0, 'SKILLS');
        foreach ($data['skills'] as $skill) {
            $pdf->Write(0, $skill->getName());
        }

        $pdf->Output('I', 'generated.pdf');
    }
}
