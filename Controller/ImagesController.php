<?php
/**
 * Summary of namespace Controller
 */
namespace Controller;

use Form\ImagesHandleRequest;
use Model\Entity\Images;
use Model\Repository\ImagesRepository;

/**
 * Summary of ProductController
 */
class ImagesController extends BaseController
{
    private ImagesHandleRequest $imagesHandleRequest;
    private Images $images;
    private ImagesRepository $imagesRepository;

    public function __construct()
    {
        $this->imagesHandleRequest = new ImagesHandleRequest;
        $this->images = new Images;
        $this->imagesRepository = new ImagesRepository;
    }

    public function add()
    {
        $this->imagesHandleRequest->handleInsertForm($this->images);

        if($this->imagesHandleRequest->isSubmitted() && $this->imagesHandleRequest->isValid()){
            $this->imagesRepository->insertImages($this->images->getProduitId(), $this->images->getImageName());
            $this->redirectToRoute(['home', 'details']);
        }
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