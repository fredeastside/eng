<?php

class fmakeNews extends fmakeCore {

    public $table = "news";
    public $order = "position";
    public $fileDirectory = "images/sitemodul_image/";

    function addFile($tempName, $name) {
        $dirs = explode("/", $this->fileDirectory . '/' . $this->id);
        $dirname = ROOT . "/";

        foreach ($dirs as $dir) {
            $dirname = $dirname . $dir . "/";
            if (!is_dir($dirname))
                mkdir($dirname);
        }

        $images = new imageMaker($name);
        $images->imagesData = $tempName;
        $images->resize(640, 480, false, $dirname, '', false);
        $images->resize(201, 113, true, $dirname, 'vb', false);
        $images->resize(120, 80, true, $dirname, 'vm', false);
        $images->resize(70, 47, true, $dirname, 'mini', false);

        $this->addParam('picture', $name);
        $this->update();
    }

}

?>
