<footer class="<?= $css ?? '' ?>">
    <div class="middle-footer">
        <div class="d-flex justify-content-around">
            <div class="d-flex align-items-center me-4">
                <i class="fa-solid fa-truck-fast"></i>
                <p>Livraison gratuite à partir de 50€ d'achats</p>
            </div>
            <div class="d-flex align-items-center me-4">
                <i class="fa-regular fa-credit-card"></i>
                <p>Paiement CB sécurisé</p>
            </div>
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-temperature-low"></i>
                <p>Fraîcheur garantie, camions frigorifiques</p>
            </div>
        </div>
    </div>
    <div class="nav-footer">
        <nav>
            <ul>
                <li><a id="" href="<?= addLink('legalite', 'show') ?>"><i class="fa-solid fa-scale-balanced pe-2"></i>Voir nos CGV</a></li>
                <li><a id="" href="{{ path('app_mentions') }}"><i class="fa-solid fa-book-open pe-2"></i>Mentions légales</a></li>
                <li><a id="" href="{{ path('app_info_entreprise') }}"><i class="fa-solid fa-person-circle-question pe-2"></i>Qui sommes-nous?</a></li>
            </ul>
        </nav>
    </div>
</footer>
</body>

</html>