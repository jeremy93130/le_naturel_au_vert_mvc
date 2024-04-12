<div class="container container-height">
  <div id="div-infos-perso">
    <h1><?= $h1 ?></h1>
    <div>
      <p>
        Nom :
        <span id="nom"><?= $user->getNom(); ?></span>
      </p>
      <a class="modifInfos" data-field="nom" data-url="<?= addLink('user', 'infoUpdateUser'); ?>">Modifier</a>
    </div>
    <div>
      <p>
        Prénom :
        <span id="prenom"><?= $user->getPrenom(); ?></span>
      </p>
      <a class="modifInfos" data-field="prenom" data-url="<?= addLink('user', 'infoUpdateUser'); ?>">Modifier</a>

    </div>
    <div>
      <p>
        Email :
        <span id="email"><?= $user->getEmail(); ?></span>
      </p>
      <a class="modifInfos" data-field="email" data-url="<?= addLink('user', 'infoUpdateUser'); ?>">Modifier</a>

    </div>
    <div>
      <p>
        Mot de Passe :
        <span id="motDePasse">***************</span>
      </p>
      <div class="d-flex flex-column" id="inputs-mdp">
        <p>
          <span id="ancien-mdp"></span>
        </p>
        <p>
          <span id="nouveau-mdp"></span>
        </p>
        <p>
          <span id="confirm-nouveau-mdp"></span>
        </p>
      </div>
      <a class="modifInfos" data-field="motDePasse" data-url="<?= addLink('user', 'infoUpdateUser'); ?>">Modifier</a>

    </div>
    <div id="div-mdp"></div>
    <div>
      <p>
        Numéro de téléphone :
        <span id="telephone"><?= $user->getPhone(); ?></span>
      </p>
      <a class="modifInfos" data-field="telephone" data-url="<?= addLink('user', 'infoUpdateUser'); ?>">Modifier</a>

    </div>
    <div id="confirm-infos"></div>
  </div>
</div>

