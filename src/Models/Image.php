<?php

namespace App\Models;

class Image
{
    protected $width;

    protected $height;

    protected $name;

    protected $type;

    protected $image;

    protected $filename;

    public function __construct(int $width, int $height, string $name)
    {
        $this->width = $width;
        $this->height = $height;
        $this->name = $name;
        $this->type = exif_imagetype($this->name) === IMAGETYPE_JPEG ? 'jpeg' : 'png';
    }

    public function __toString()
    {
        return $this->filename;
    }

    public function resize()
    {
        list($width, $height) = getimagesize($this->name);

        $src = $this->imageCreateFrom($this->name);
        $dst = imagecreatetruecolor($this->width, $this->height);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $this->width, $this->height, $width, $height);

        $this->image = $dst;
        return $dst;
    }

    public function getImageDir()
    {
        return ROOT . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
    }

    public function imageCreateFrom(string $filename)
    {
        $function = sprintf('imagecreatefrom%s', $this->type);
        return $function($filename);
    }

    public function imageSave()
    {
        $function = sprintf('image%s', $this->type);
        return $function($this->image, $this->getImageDir() . $this->filename);
    }

    public function save()
    {
        $this->filename = currentDateTime() . '.' . $this->type;
        $this->imageSave();
    }

    public function setSymlink()
    {
        $symlink = 'image';
        $image = glob(ROOT . DIRECTORY_SEPARATOR . storage . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $this->filename);
        if (readlink($symlink)) {
            unlink($symlink);
        }
        symlink($image[0], $symlink);

        return $symlink;
    }

    /**
     * Get the value of filename
     */
    public function getImageData()
    {
        return exif_read_data($this->getImageDir() . $this->filename);
    }
}
