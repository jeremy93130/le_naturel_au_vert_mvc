<div class="container-height">
  <?php if (isset($_SESSION['confirmation_paiement'])) { ?>
    <div class="container text-center text-warning">
      <h1>{{ message }}</h1>
      <p>
        À très vite chez
        <span class="titre-site">Le Naturel Au Vert</span>
      </p>
      <a href="{{ path('app_home') }}" class="text-warning">Retour à l'accueil</a>
    </div>
  <?php } else { ?>
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
              <td class="td-prix"><?= $d['prix'] ?>€</td>
              <td class="td-prix"><?= $d['prixTTC'] ?>€</td>
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
      <?php if (isset($_SESSION['adresseValide']) || (isset($adresseInfos) && $adresseInfos !== null)) { ?>
        <div class="adresse_livraison_facture">
          <div>
            <h3 class="livraison_factureh3">Adresse de Facturation :</h3>
            <div class="livraison_facture">
              <div>
                <p>Mme/Mr</p>
                <p>{{ adresseFactureInfos.nomComplet }}</p>
                <p>{{ adresseFactureInfos.adresse }}</p>
                <p>{{ adresseFactureInfos.codePostal }}
                  {{ adresseFactureInfos.ville }}
                </p>
                <p>{{ adresseFactureInfos.pays }}</p>
                <p>{{ adresseFactureInfos.telephone }}</p>
              </div>
              <a href="{{ path('app_adresse_facture') }}" class="modif-adresse">Modifier</a>
            </div>
          </div>
          <div>
            <h3 class="livraison_factureh3">Adresse de livraison :</h3>
            <div class="livraison_facture">
              <div>
                <p>Mme/Mr</p>
                <p>{{ adresseInfos.nomComplet }}</p>
                <p>{{ adresseInfos.adresse }}</p>
                <p>{{ adresseInfos.codePostal }}
                  {{ adresseInfos.ville }}
                </p>
                <p>{{ adresseInfos.pays }}</p>
                <p>{{ adresseInfos.telephone }}</p>
                <p>{{ adresseInfos.instructionLivraison }}</p>
              </div>
              <a href="{{ path('app_adresse') }}" class="modif-adresse">Modifier</a>
            </div>
          </div>
        </div>
      <?php } else { ?>
        <div class="adresse_livraison_facture">
          <div class="adresse_vierge">
            <div class="adresse_link">
              <a class="paiement_links" href="<?= addLink('adresse', 'index'); ?>">Définir l'adresse de livraison</a>
            </div>
          </div>
        </div>
        <?php if (isset($erreur_adresse) && $erreur_adresse !== null) { ?>
          <div>
            <p class="alert alert-danger text-center">{{ erreur_adresse }}</p>
          </div>
      <?php }
      } ?>
      <div class="paiement_div">
        <a class="paiement_links" href="<?php echo 'app_paiement.php?ids=' . implode(',', array_column($dataCommande['commandeData'], 'id')) . '&total=' . $dataCommande['totalGeneral']; ?>"><img src="<?= ROOT ?>uploads/logos/Logo_CB.png" alt="Logo CB"></a>
      </div>
    </div>
  <?php } ?>
</div>