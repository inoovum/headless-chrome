<?php
namespace SteinbauerIT\Neos\HeadlessChrome\Command;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;
use SteinbauerIT\Neos\HeadlessChrome\Print2Pdf;

/**
 * @Flow\Scope("singleton")
 */
class PrintCommandController extends CommandController
{

    /**
     * @Flow\Inject
     * @var Print2Pdf
     */
    protected $print2Pdf;

    /**
     * Print a PDF document (for testing purposes)
     *
     * @param string $source
     * @param string $targetPath
     * @return void
     */
    public function pdfCommand(string $source, string $targetPath): void
    {
        $print2Pdf = new Print2Pdf();
        $print2Pdf->setSource($source);
        $print2Pdf->setTargetDirectory($targetPath);
        $result = $print2Pdf->execute();
        $this->outputLine('PDF document is printed to file: ' . $result);
    }

}
