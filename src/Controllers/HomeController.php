<?php

namespace App\Controllers;

use Validator\Validator;
use App\Models\Image;
use DateTime;

class HomeController extends BaseController
{
    public function index()
    {
        $this->render('home');
    }

    public function store()
    {
        $validator = new Validator;
        $validator->validate(
            $this->request->post,
            [
                'width' => 'numeric|required',
                'height' => 'numeric|required',
                'file' => 'image|required',
            ]
        );

        if ($validator->isError()) {
            return $this->render('home', ['errors' => $validator->getErrors()]);
        }

        $width = $this->request->post['width'];
        $height = $this->request->post['height'];
        $img = $_FILES['file']['tmp_name'];

        $image = new Image($width, $height, $img);
        $image->resize();
        $image->save();

        $imageData = $image->getImageData();
        $date = new DateTime();
        $date->setTimestamp($imageData['FileDateTime']);

        // var_dump($imageData['COMPUTED']);exit;
        $this->logger->info("New image: $image", [
            'width' => $imageData['COMPUTED']['Width'],
            'height' => $imageData['COMPUTED']['Height'],
            'size' => $imageData['FileSize'],
            'created_at' => $date->format('Y-m-d H:i:s'),
        ]);

        return $this->render('home', ['image' => $image->setSymlink()]);
    }
}
