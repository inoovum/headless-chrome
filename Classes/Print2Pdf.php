<?php
namespace SteinbauerIT\Neos\HeadlessChrome;

/*
 * This file is part of the SteinbauerIT.Neos.HeadlessChrome package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Exception;

class Print2Pdf
{

    /**
     * @Flow\InjectConfiguration(package="SteinbauerIT.Neos.HeadlessChrome", path="chromeExecutable")
     * @var string
     */
    protected $chromeExecutable;

    /**
     * @Flow\InjectConfiguration(package="SteinbauerIT.Neos.HeadlessChrome", path="defaultAttributes")
     * @var array
     */
    protected $defaultAttributes = [];

    /**
     * @var string
     */
    private $source = '';

    /**
     * @var string
     */
    private $targetDirectory = '';

    /**
     * @var array
     */
    private $attributes = [];

    /**
     * @var mixed
     */
    private $targetFilename = null;

    /**
     * @param string $source
     * @return void
     */
    public function setSource(string $source): void
    {
        $this->source = $source;
    }

    /**
     * @param string $targetDirectory
     * @return void
     */
    public function setTargetDirectory(string $targetDirectory): void
    {
        $this->targetDirectory = $targetDirectory;
    }

    /**
     * @param string $targetFilename
     * @return void
     */
    public function setTargetFilename(string $targetFilename): void
    {
        $this->targetFilename = $targetFilename;
    }

    /**
     * @param array $attributes
     * @return void
     */
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function execute(): string
    {
        if($this->source === '') {
            throw new Exception('There is no "source" set.', 1347145549);
        }
        if($this->targetDirectory === '') {
            throw new Exception('There is no "targetDirectory" set.', 1347145543);
        }
        return $this->printPdf();
    }

    /**
     * @return string
     */
    private function printPdf(): string
    {
        $targetFilename = $this->targetFilename;
        if($targetFilename === null) {
            $targetFilename = time() . '.pdf';
        }
        $target = $this->targetDirectory . ($this->hasTrailingSlash($this->targetDirectory) ? '' : '/') . $targetFilename;
        shell_exec($this->chromeExecutable . ' --headless --print-to-pdf=' . $target . ' ' . $this->attributesToString() . $this->source);
        return $target;
    }

    /**
     * @param string $targetDirectory
     * @return bool
     */
    private function hasTrailingSlash(string $targetDirectory): bool
    {
        return substr($targetDirectory, -1) === '/';
    }

    /**
     * @return string
     */
    private function attributesToString(): string
    {
        $result = '';
        foreach ($this->defaultAttributes as $defaultAttribute) {
            $result .= '--' . $defaultAttribute . ' ';
        }
        foreach ($this->attributes as $attribute) {
            $result .= '--' . $attribute . ' ';
        }
        return $result;
    }

}
