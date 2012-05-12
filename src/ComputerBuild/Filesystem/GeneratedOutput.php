<?php

namespace ComputerBuild\Filesystem;

/**
 * Generated Output
 *
 * @author Luis Cordova <cordoval@gmail.com>
 * @author Raul Rodriguez <raulrodriguez782@gmail.com>
 * @author
 */
class GeneratedOutput
{
    protected $filename = "";
    protected $path = "";
    protected $fullfilename ="";

    protected $outputMode;

    const STD_OUT = 0;
    const FILE_SYSTEM = 1;

    /*
    * Pass name of file
    */
    public function __construct($filename = null, $path = null)
    {
        if (!is_null($filename) && !is_null($path))
        {
            $this->filename = $filename;
            $this->path = $path;
            $this->fullfilename = $path.$filename;
            $this->outputMode = self::FILE_SYSTEM;
        } else {
            $this->outputMode = self::STD_OUT;
        }
    }


    /*
     * Get filename
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /*
     * Get path
     */
    public function getPath()
    {
        return $this->path;
    }

    /*
    * Get full filename
    */
    public function getFullfilename()
    {
        return $this->fullfilename;
    }

    public function setPath($path){
        if (!empty($path) && !is_null($path)) {
            $this->path = $path;
            $this->fullfilename = $this->path.$this->filename;
        }
    }

    public function setFilename($filename){
        if (!empty($filename) && !is_null($filename)) {
            $this->filename = $filename;
            $this->fullfilename = $this->path.$this->filename;
        }
    }


    /**
     * Print line to either stderror or to file
     */
    public function printLine($string)
    {
        if ($this->outputMode == self::STD_OUT) {
            //fwrite(STDOUT, $string . "\n");
            echo $string;
        } elseif ($this->outputMode == self::FILE_SYSTEM) {
            $this->write($string);
        }
    }

    public function write($text, $mode = "w+")
    {
        if (!$handle = fopen($this->fullfilename, $mode)){
            echo "Cannot open file ($this->fullfilename)";
            exit;
        }

        if (fwrite($handle, $text) === FALSE) {
            echo "Cannot write to file ($this->fullfilename)";
            exit;
        }
        fclose($handle);
    }

}