<?php

/**
 * Summary of namespace Controller
 */

namespace Controller\Admin;

use Controller\BaseController;
use Model\Entity\Produits;
use Form\ProduitsHandleRequest;
use Model\Repository\ProduitsRepository;
use Service\BackgroundManager;
use Service\Session;

/**
 * Summary of ProductController
 */
class ProduitsController extends BaseController
{
    private ProduitsRepository $productRepository;
    private ProduitsHandleRequest $form;
    private Produits $product;

    public function __construct()
    {
        $this->productRepository = new ProduitsRepository;
        $this->form = new ProduitsHandleRequest;
        $this->product = new Produits;
    }

    public function list()
    {
        $products = $this->productRepository->findAll($this->product);

        $cheminDossier = [];
        foreach ($products as $p) {
            $cheminDossier[$p->getId()] = BackgroundManager::chooseProductFolder($p->getCategorie());
        }

        $this->render("admin/product/index.html.php", [
            "h1" => "Liste des produits",
            "products" => $products,
            'cheminDossier' => $cheminDossier
        ]);
    }

    /**
     * Summary of edit
     * @param mixed $id
     * @return void
     */
    public function edit($id)
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        $product = $this->productRepository->findById('produits', $id);
        // d_die($product);

        $this->form->handleEditForm($product);
        // d_die($this->form);
        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $this->productRepository->updateProduct($product);
            echo json_encode(['success' => 'Le produit a bien été mis à jour', 'modifs' => $this->form->getModifElement()]);
            return;
        } else if (!$this->form->isSubmitted() && !$this->form->isValid()) {
            echo json_encode(['error', 'Il y\'a eu un problème avec la mise à jour du produit']);
            return;
        }

        $errors = $this->form->getEerrorsForm();
        return $this->render("admin/product/edit_product.html.php", [
            "h1" => "Update du produit n° $id",
            "product" => $product,
            "errors" => $errors
        ]);
    }

    public function delete($id)
    {
        if (!empty($id) && $id > 0) {
            if (is_numeric($id)) {

                $this->product = $this->productRepository->findById('produits', $id);
                if ($this->product) {
                    $this->productRepository->remove($this->product);
                    return $this->redirectToRoute(['admin/produits', 'list']);
                }
            } else {
                $this->setMessage("danger",  "ERREUR 404 : la page demandé n'existe pas");
            }
        } else {
            $this->setMessage("danger",  "ERREUR 404 : la page demandé n'existe pas");
        }
    }

    public function show($id)
    {
        if ($id) {
            if (is_numeric($id)) {
            } else {
                $this->setMessage("danger",  "Erreur 404 : cette page n'existe pas");
            }
        } else {
            $this->setMessage("danger",  "Erreur 403 : vous n'avez pas accès à cet URL");
            redirection(addLink("product", "list"));
        }

        $this->render("product/show.html.php", [
            "h1" => "Fiche product"
        ]);
    }

    public function new()
    {
        $this->form->handleInsertForm();

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            Session::addMessage('success', 'Votre produit a bien été ajouté à la liste');
        }
        $this->render('admin/product/add_product.html.php');
    }
}
