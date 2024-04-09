<div class="container-height">
  <?php if (!$commande) { ?>
      <div class="historiqueVide">
        <h1>Vous n'avez aucune commande passée actuellement</h1>
        <a href="{{ path('app_home') }}">Retour à l'accueil</a>
      </div>
  <?php } else { ?>
      <h1 class="historiqueH1">Historique des commandes</h1>
      <table class="table table_historic">
        <thead>
          <tr class="text-warning">
            <th>Date de la commande</th>
            <th>Adresse de facturation</th>
            <th>Adresse de livraison</th>
            <th>Produit(s)</th>
            <th>prix</th>
            <th>Quantité</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody class="historic_body">
          <?php foreach ($commande as $c) {
            if ($c !== null) {
              ?>
                <tr class="text-warning">
                  <td>
                    <p><?= date_create($c['commande']->getDateCommande())->format('d-m-y'); ?></p>
                  </td>
                  <?php if (isset($c['adresse']) && is_array($c['adresse'])) {
                    foreach ($c['adresse'] as $facturation) {
                      if ($facturation->getType() == 'facturation') {
                        ?>
                          <td>
                            <p>
                              <?= $facturation->getNomComplet(); ?>
                            </p>
                            <p>
                              <?= $facturation->getAdresse() ?>,
                            </p>
                            <p>
                              <?= $facturation->getCodePostal(); ?>
                              ,
                              <?= $facturation->getVille(); ?>
                              ,
                              <?= $facturation->getPays(); ?>
                            </p>
                          </td>
                        <?php }
                    }
                    foreach ($c['adresse'] as $livraison) {
                      if ($livraison->getType() == 'livraison') {
                        ?>
                            <td>
                              <p>
                                <?= $livraison->getNomComplet(); ?>
                              </p>
                              <p>
                                <?= $livraison->getAdresse() ?>,
                              </p>
                              <p>
                                <?= $livraison->getCodePostal(); ?>
                                ,
                                <?= $livraison->getVille(); ?>
                                ,
                                <?= $livraison->getPays(); ?>
                              </p>
                            </td>
                        <?php }
                    }
                  } ?>
                    <td>
                      <?php foreach ($c['produits'] as $produit) { ?>
                          <p>
                            <?= $produit['produit']->getNomProduit(); ?>
                            <?php if ($produit !== end($c['produits'])) { ?>
                                ,
                            <?php } ?>
                          </p>
                      <?php } ?>
                    </td>
                    <td>
                      <?php foreach ($c['produits'] as $produit) { ?>
                          <div style="padding: 8px 0 ;">
                            <p>
                              <?= $produit['produit']->getPrixProduit() ?>€
                            </p>
                          </div>
                      <?php } ?>
                    </td>
                    <td>
                      <?php foreach ($c['produits'] as $quantite) { ?>
                          <p>
                            <?= $quantite['quantite']; ?>
                          </p>
                      <?php } ?>
                    </td>
                    <td>
                      <p>
                        <?= $c['commande']->getTotal(); ?>
                        €
                      </p>
                    </td>
                  </tr>
              <?php } ?>
          <?php }
  } ?>
      </tbody>
    </table>
  </div>

