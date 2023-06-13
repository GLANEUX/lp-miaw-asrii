<!-- Affiche l'espace entreprise -->
<!-- Accessible uniquement pour les Entreprises -->
<!-- Accessible sur /home (Connecté en entreprise) -->

<section class="bg-custom-grey p-4 pb-0">
    <div class=" py-2 px-3 rounded bg-white">
        <h2>Bienvenue - Entreprise</h2>
    </div>
</section>
<section class="bg-custom-grey px-5 py-3">

    <div class="row g-5 py-2">
        <div class="col-6">
            <div class="text-right py-3">
                <a href="#" class="bg-custom-purple txt-color-black button-font py-2 px-3 rounded">Ajouter un Projet</a>
            </div>
            <div class="bg-custom-black p-2 text-white">Projets tuteuré</div>
            <div class="bg-white p-3">
                 <iframe id="iframeI"src="<?= URL ?>/projets/list" frameborder="0"
                    width="100%" height="100%"></iframe>
                </div>
        </div>
        <div class="col-6">
            <div class="text-right py-3">
                <a href="#" class="bg-custom-purple txt-color-black button-font py-2 px-3 rounded">Ajouter une offre</a>
            </div>
            <div class="bg-custom-black p-2 text-white">Offre d'alternance</div>
            <div class="bg-white p-3">Contenu de la boîte 1</div>
        </div>
    </div>

</section>

<a href="<?= URL ?>/alternances"> Alternances </a> <br />
<a href="<?= URL ?>/emplois-du-temps"> Emplois du temps </a> <br />
<a href="<?= URL ?>/projets"> Projets </a> <br />
<a href="<?= URL ?>/supports"> Supports de cours </a> <br />