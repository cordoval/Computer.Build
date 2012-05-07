<?php

namespace ComputerBuild\Filesystem;

/**
 * Generated Output
 *
 * @author Luis Cordova <cordoval@gmail.com>
 * @author Raul Rodriguez <raulrodriguez782@gmail.com>
 */
class GeneratedOutput
{
    protected $filename = "";
    protected $path = "";
    protected $fullfilename ="";

    const NEWLINE = 0x0A;
    const CARRIAGE = 0x0D;

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
        }
    }

    /**
     * Print line to either stderror or to file
     */
    public function printLine($string)
    {
        if ($this->outputMode == 'stdout') {
            echo $string;
        } elseif ($this->outputMode == 'filesystem') {
            $this->write($string);
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

    public function write($text, $mode = "w+")
    {
        if ($this->is__writable($this->path)) {
            if (!$handle = fopen($this->fullfilename, $mode)){
                echo "Cannot open file ($this->fullfilename)";
                exit;
            }

            if (fwrite($handle, $text) === FALSE) {
                echo "Cannot write to file ($this->fullfilename)";
                exit;
            }

            $echo = "Success, wrote ($text) to file ($this->fullfilename)";

            fclose($handle);
        } else {
            echo "The file $this->fullfilename is not writable";
        }
    }

    /**
     * Get Content of a Plain File
     */
    public function getContents()
    {
        return file_get_contents($this->fullfilename);
    }

    /**
     * Checks if Directory has written permission
     */
    private function is__writable($path) {

        if ($path{strlen($path)-1}=='/')
            return $this->is__writable($path.uniqid(mt_rand()).'.tmp');

        if (file_exists($path)) {
            if (!($f = @fopen($path, 'r+')))
                return false;
            fclose($f);
            return true;
        }

        if (!($f = @fopen($path, 'w')))
            return false;
        fclose($f);
        unlink($path);
        return true;
    }
}