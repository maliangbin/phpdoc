<?php
/**
 * @package: workspace
 * @description: Word2007.php
 * @author: maliangbin Email:maliangbin@hoge.cn
 * @link: http://www.hoge.cn
 * @version: 1.0
 * @date: 18/4/27
 */
namespace phpdoc\src;

class Word2007 implements DocInterface
{
    public $file;
    public $indexes;

    public function __construct()
    {

    }

    public function load($file)
    {
        // TODO: Implement load() method.
        $this->file = $file;
    }

    public function saveImages($path)
    {
        if (is_dir($path)) {
            mkdir($path, 0777, true);
        }
        $return = array();
        $ZipArchive = new \ZipArchive;
        if (true === $ZipArchive->open($this->file)) {
            for ($i = 0; $i < $ZipArchive->numFiles; $i++) {
                $zip_element = $ZipArchive->statIndex($i);
                if (preg_match("([^\s]+(\.(?i)(jpg|jpeg|png|gif|bmp))$)", $zip_element['name'])) {
                    $imagename = explode('/', $zip_element['name']);
                    $imagename = end($imagename);
                    $this->indexes[$imagename] = $i;
                }
            }
            if (count($this->indexes) == 0) {
                throw new \Exception("No images found .");
            }
            foreach ($this->indexes as $key => $index) {
                $filename = uniqid() . '.' . pathinfo($key, PATHINFO_EXTENSION);
                file_put_contents($path . '/' . $filename, $ZipArchive->getFromIndex($index));
                $return[] = $filename;
            }
        }
        $ZipArchive->close();
        return $return;
    }
}