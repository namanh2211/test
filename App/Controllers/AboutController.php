<?php 
namespace App\Controllers;

use App\Models\AboutModel;

class AboutController
{
    public function index()
    {
        $aboutModel = new AboutModel();
        $aboutData = $aboutModel->getAboutData();

        

        require __DIR__ . '/../Views/Client/about.php';
    }
}
