<?php
/**
 * Summary of namespace Controller
 */
namespace Controller;

/**
 * Summary of ProductController
 */
class ImagesController extends BaseController
{
    public function index(): void
    {
        
    }

    public function show()
    {


        $this->render("panier/panier.html.php", [
           
        ]);

    }

    public function edit($id)
    {

    }

    public function delete($id)
    {

    }

}