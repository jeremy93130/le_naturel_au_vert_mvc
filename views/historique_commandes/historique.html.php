<div class="container-height">
  <?php if (!$commande) { ?>
      <div class="historiqueVide">
        <h1>Vous n'avez aucune commande passée actuellement</h1>
        <a href="{{ path('app_home') }}">Retour à l'accueil</a>
      </div>
  <?php } else { ?>
      <h1 class="historiqueH1">Historique des commandes</h1>
      <table class="table table_historic">
        <tr class="text-warning">
          <th>Date de la commande</th>
          <th>Adresse de facturation</th>
          <th>Adresse de livraison</th>
          <th>Produit(s)</th>
          <th>prix</th>
          <th>Quantité</th>
          <th>Total</th>
        </tr>
        <?php foreach ($commande as $c) { ?>
            <tr class="text-warning">
              <td><?= date_create($c['commande']->getDateCommande())->format('d-m-y'); ?></td>
              <?php if (isset($c['adresse']) && $c['adresse']->getType() == 'facturation') { ?>
                  <td>
                    <?= $c['adresse']->getNomComplet(); ?>
                    <br/>
                    <?= $c['adresse']->getAdresse() ?>,
                    <br/><?= $c['code_postal']; ?>
                    ,
                    <?= $c['ville']; ?>
                    ,
                    <?= $c['pays']; ?>
                  </td>
                <?php }
              foreach ($c['adresse'] as $adresse) {
                if ($c['commande']->getAdresse()->getType() == 'livraison') { ?>
                      <td>
                        <?= $adresse->getNomComplet(); ?>
                        <br/>
                        <?= $c['adresse']; ?>,
                        <br/>{{ commande.adresse_livraison.code_postal }}
                        ,
                        {{ commande.adresse_livraison.ville }}
                        ,
                        {{ commande.adresse_livraison.pays }},
                        <br/>{{ commande.adresse_livraison.instruction_livraison }}
                      </td>

                  <?php }
              } ?>
                <td>
                  {{ plante.produit }}

                  ,<div style="padding: 8px 0 ;"></div>

                </td>
                <td>


                  <div style="padding: 8px 0 ;"></div>

                </td>
                <td>


                  <div style="padding: 8px 0 ;"></div>

                </td>
                <td>{{ commande.total|number_format(2, ',', 'fr') }}
                  €</td>
              </tr>
          <?php } ?>
        </table>
    <?php } ?>
  </div>

