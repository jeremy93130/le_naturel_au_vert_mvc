<div class="achat-accueil <?= $css ?> bg-details container-height">
    <form action="" method="post" class="text-warning">
        <h1>Laissez votre commentaire</h1>
        <section id='laisser_commentaire_principale'>
            <div id="laisser_commentaire_img">
                <img src="" alt="">
            </div>
            <div id="laisser_commentaire_avis">
                <p>
                    <input type="hidden" value="0" name="nbEtoiles" id="nbEtoiles">
                    <i class="fa-regular fa-star" onclick="changeStar(this, 1)"></i>
                    <i class="fa-regular fa-star" onclick="changeStar(this, 2)"></i>
                    <i class="fa-regular fa-star" onclick="changeStar(this, 3)"></i>
                    <i class="fa-regular fa-star" onclick="changeStar(this, 4)"></i>
                    <i class="fa-regular fa-star" onclick="changeStar(this, 5)"></i>
                </p>
                <textarea name="avis" cols="50" rows="5" maxlength="240" placeholder="240 caractères maximum"></textarea>
            </div>
            <input type="submit" name="submit_avis">
    </form>
</div>