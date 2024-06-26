<div
  class="container-height">
    <?php if (isset($_SESSION['commande'])) ?>
    <div class="recap">
      <h1>Récapitulatif de la commande</h1>
      <table class="table">
        <thead>
          <tr>
            <th>Produit</th>
            <th class="td-quantite">Quantité</th>
            <th class="td-quantite">Lot de :</th>
            <th class="td-prix">Total HT</th>
            <th class="td-prix">Total TTC</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data as $d) { ?>
            <tr>
              <td class="td-nom"><?= $d['alt']; ?></td>
              <td class="td-quantite"><?= $d['quantite']; ?></td>
              <td class="td-quantite"><?= $d['lot'] * $d['quantite'] ?></td>
              <td class="td-prix"><?= $d['prix'] * $d['quantite']; ?>€</td>
              <td class="td-prix"><?= $d['prixTTC'] * $d['quantite']?>€</td>
            </tr>
          <?php }
          if ($totalGeneral < 50) { ?>
            <tr>
              <td class="td-nom" colspan="3">Frais de Livraison</td>
              <td class="td-prix">3.33€</td>
              <td class="td-prix">3.99€</td>
            </tr>
          <?php } else { ?>
            <tr>
              <td class="td-nom" colspan="3">Frais de Livraison</td>
              <td class="td-prix" colspan="2">Offerts</td>
            </tr>
          <?php } ?>
        </tbody>
        <tfoot>
          <tr>
            <td class="ttG"></td>
            <td class="ttG"></td>
            <td class="ttG"></td>
            <td class="ttG" colspan="2"><?= $totalGeneral < 50 ? $totalGeneral + 3.99 : $totalGeneral ?>€</td>
          </tr>
        </tfoot>
      </table>
      <?php if ($adresse_livraison !== null && $adresse_facturation !== null) { ?>
        <div class="adresse_livraison_facture">
          <div>
            <h3 class="livraison_factureh3">Adresse de Facturation :</h3>
            <div class="livraison_facture">
              <div>
                <p>Mme/Mr</p>
                <p><?= $adresse_facturation->getNomComplet(); ?></p>
                <p><?= $adresse_facturation->getAdresse(); ?></p>
                <p><?= $adresse_facturation->getCodePostal(); ?>
                  <?= $adresse_facturation->getVille(); ?>
                </p>
                <p><?= $adresse_facturation->getPays(); ?></p>
                <p><?= $adresse_facturation->getTelephone(); ?></p>
              </div>
              <a href="<?= addLink('adresse', 'adresseFacturation') ?>" class="modif-adresse">Modifier</a>
            </div>
          </div>
          <div>
            <h3 class="livraison_factureh3">Adresse de livraison :</h3>
            <div class="livraison_facture">
              <div>
                <p>Mme/Mr</p>
                <p><?= $adresse_livraison->getNomComplet(); ?></p>
                <p><?= $adresse_livraison->getAdresse(); ?></p>
                <p><?= $adresse_livraison->getCodePostal(); ?>
                  <?= $adresse_livraison->getVille(); ?>
                </p>
                <p><?= $adresse_livraison->getPays(); ?></p>
                <p><?= $adresse_livraison->getTelephone(); ?></p>
                <p><?= $adresse_livraison->getInstruction_livraison(); ?></p>
              </div>
              <a href="<?= addLink('adresse', 'adresseLivraison'); ?>" class="modif-adresse">Modifier</a>
            </div>
          </div>
        </div>
      <?php } else { ?>
        <div class="adresse_livraison_facture">
          <div class="adresse_vierge">
            <div class="adresse_link">
              <h3 class="text-warning mb-5">
                <u>Aucune adresse n'est actuellement enregistrée</u>
              </h3>
              <a class="paiement_links" href="<?= addLink('adresse', 'adresseLivraison'); ?>">Définir l'adresse de livraison</a>
            </div>
          </div>
        </div>
        <?php if (isset($erreur_adresse) && $erreur_adresse !== null) { ?>
          <div>
            <p class="alert alert-danger text-center">{{ erreur_adresse }}</p>
          </div>
        <?php }
      } ?>
      <?php if (isset($_SESSION['erreur_adresse'])) { ?>
        <div class="alert alert-danger">
          <p class="text-center"><?= $_SESSION['erreur_adresse']; ?></p>
        </div>
      <?php }
      unset($_SESSION['erreur_adresse']); ?>
      <div class="paiement_div">
        <a class="paiement_links" href="<?= addLink('paiement', 'stripeCheckout') ?>?<?= http_build_query($url) ?>"><img src="<?= ROOT ?>uploads/logos/Logo_CB.png" alt="Logo CB"></a>
      </div>
    </div>
</div>

