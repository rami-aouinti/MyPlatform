<?php
/*
 *
 * Date : 08/04/2021, 22:57
 * Author : rami
 * Class PdfComposer.php
 */

namespace App\Service;

use setasign\Fpdi\Fpdi;

/**
 * Class PdfComposer
 * @package App\Service
 */
class PdfComposer
{
    public function generatePdf($data, $template)
    {
        $pdf = $this->createPdf($template);
        $this->addContent($pdf, $data);
    }

    /**
     * @param $template
     * @return Fpdi
     * @throws \setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException
     * @throws \setasign\Fpdi\PdfParser\Filter\FilterException
     * @throws \setasign\Fpdi\PdfParser\PdfParserException
     * @throws \setasign\Fpdi\PdfParser\Type\PdfTypeException
     * @throws \setasign\Fpdi\PdfReader\PdfReaderException
     */
    private function createPdf($template)
    {
        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($this->appKernel->getProjectDir() . $template);
        $pageId = $pdf->importPage($pageCount);
        $pdf->addPage();
        $pdf->useImportedPage($pageId, 0, 0, 250);

        return $pdf;
    }

    /**
     * @param $pdf
     * @param $data
     */
    private function addContent($pdf, $data)
    {
        // now write some text above the imported page
        $pdf->SetFont('Helvetica');
        $pdf->SetXY(70, 30);

        $parts = [];

        foreach ($data as $keys) {
            $parts[] = $keys['name'];
        }

        foreach ($parts as $part) {
            $pdf->Write(0, $part);
            foreach ($data[$part] as $section) {
                $pdf->Write(0, $section->getName());
            }
        }

        $pdf->Output('I', 'generated.pdf');
    }
}
