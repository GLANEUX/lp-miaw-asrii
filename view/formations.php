<!-- Page formations -->
<!-- Accessible pour tous le monde -->
<!-- Accessible sur /formations -->

<section class="banner background-image" style="background-image: url('<?= URL ?>/public/img/Banner-formation.jpg')">
  <div class="banner-overlay " ></div>
  <div class="banner-content" >
    <h1 class="">ASRII</h1>
    <h2 class="text-font">FORMATION</h2>
  </div>
</section>
<div class="container py-5 d-flex">
    <!-- Main content -->
    <div class="main-content col lg-9">
        <ul class="nav nav-pills flex-column flex-sm-row" id="myTabs">
            <li class="nav-item mx-5">
                <a class="flex-sm-fill text-sm-center nav-link-formation active py-3 px-4 rounded text-uppercase" id="presentation-tab" data-toggle="tab" href="#presentation">Présentation</a>
            </li>
            <li class="nav-item mx-5">
                <a class="flex-sm-fill text-sm-center nav-link-formation py-3 px-4 rounded text-uppercase" id="enseignement-tab" data-toggle="tab" href="#enseignement">Enseignement</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <!-- presentation -->
            <div class="tab-pane fade show active p-5" id="presentation">
                <h4 class="">Pour y accéder</h4>
                <p class="text-justify">Le BUT Gestion des Entreprises et des Administrations (GEA) se prépare dans un Institut Universitaire de Technologie (IUT), 
                    en 3 ans et est organisé en unités d'enseignement (UE) capitalisables, facilement évaluables en unités de compte européennes 
                    (ECTS), avec un découpage en six semestres ouvrant droit à l'attribution de 30 ECTS chacun.
                </p>

                <h4>Programme</h4>
                <ul>
                    <li>Sécurité Réseaux et des Applications</li>
                    <li>Interconnexion des réseaux locaux</li>
                    <li>Administration et configuration des Services intranet et internet (Windows / Linux)</li>
                    <li>Programmation systèmes / Supervision</li>
                    <li>Projets tutorés</li>
                </ul>

                <h4>Objectifs de la formation</h4>
                <p class="text-justify">La Licence Métiers de l'Informatique: Applications Web offre un parcours spécifique, ASRII, qui vise à former des jeunes de 
                    niveau BAC+2 aux métiers de l'Internet et de responsable informatique. Cette formation ASRII a des objectifs scientifiques et 
                    professionnels clairement définis et s'inscrit dans l'offre globale de l'établissement en tant que parcours distinct de la 
                    formation MIAW DAW2I.
                </p>

                <h4>Parcours</h4>
                <p class="text-justify">Pour la formation Administration et Sécurisation des Réseaux et services Internet et Intranet (ASR2I), il est chargé de 
                    l'administration et la gestion d'un parc informatique, la supervision et la sécurisation d'un réseau local, et de l'intégration 
                    de produits et de services Intranet ou/et Internet. Les postes visés sont intermédiaires entre des techniciens supérieurs et des 
                    ingénieurs. Savoir-faire et compétences à l'issue de ce parcours:
                </p>
                <ul>
                    <li class="text-justify">Modéliser des données pour mieux intégrer les services web, concevoir et réaliser des sites web Intranet et Internet, CMS, programmer côté client et serveur.</li>
                    <li class="text-justify">Configurer un réseau local pour un ensemble de postes informatiques, dans un environnement hétérogène (Windows, Linux) et assurer l'interconnexion avec le monde extérieur.</li>
                    <li class="text-justify">Administrer au quotidien un parc hétérogène de postes serveurs et bureautiques rattachés au réseau informatique pour garantir, en permanence, leur disponibilité et leur sécurité.</li>
                    <li class="text-justify">Intégrer des solutions de sécurité des applications et des données.</li>
                </ul>
            </div>
            <!-- enseignement -->
            <div class="tab-pane fade p-5" id="enseignement">
                <h4>SEMESTRE 1</h4>
                <div class="table-responsive">  
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="bg-light">Enseignements</th>
                                <th class="bg-light">ECTS</th>
                                <th class="bg-light">TP/TD</th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th colspan="" class="">
                                    <a data-toggle="collapse" href="#" data-target=".ue11-content"class="collapsed text-decoration-none text-body" aria-expanded="collapsed">
                                    <span class="fas fa-chevron-down m-2"></span>
                                    UE11 Connaissance de l'entreprise
                                    </a>
                                </th>
                                <th>6</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="collapse ue11-content">
                                <td>Organisation et Gestion des entreprises</td>
                                <td>6</td>
                                <td>20h</td>
                            </tr>
                            <tr class="collapse ue11-content">
                                <td>Gestion et management des projets</td>
                                <td>6</td>
                                <td>20h</td>
                            </tr>
                            <tr class="collapse ue11-content">
                                <td>La qualité en entreprise</td>
                                <td>2</td>
                                <td>16h</td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="" class="">
                                    <a data-toggle="collapse" href="#" data-target=".ue12-content"class="collapsed text-decoration-none text-body" aria-expanded="collapsed">
                                    <span class="fas fa-chevron-down m-2"></span>
                                    UE12 Modélisation de données et intégration de réseaux locaux
                                </th>
                                <th>7</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="collapse ue12-content">
                                <td>Réseaux locaux</td>
                                <td>2</td>
                                <td>24h</td>
                            </tr>
                            <tr class="collapse ue12-content">
                                <td>Bases de données relationnelles</td>
                                <td>1.5</td>
                                <td>20h</td>
                            </tr>
                            <tr class="collapse ue12-content">
                                <td>Outils de configuration SHELL</td>
                                <td>1.5</td>
                                <td>24h</td>
                            </tr>
                            <tr class="collapse ue12-content">
                                <td>Programmation objet en python</td>
                                <td>2</td>
                                <td>24h</td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="" class="">
                                    <a data-toggle="collapse" href="#" data-target=".ue13-content"class="collapsed text-decoration-none text-body" aria-expanded="collapsed">
                                    <span class="fas fa-chevron-down m-2"></span>
                                    UE13 Développement et programmation des services web
                                </th>
                                <th>8</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="collapse ue13-content">
                                <td>Programmation XML</td>
                                <td>2</td>
                                <td>20h</td>
                            </tr>
                            <tr class="collapse ue13-content">
                                <td>Développement en JavaScript</td>
                                <td>2</td>
                                <td>20h</td>
                            </tr>
                            <tr class="collapse ue13-content">
                                <td>Programmation PHP</td>
                                <td>2</td>
                                <td>20h</td>
                            </tr>
                            <tr class="collapse ue13-content">
                                <td>Programmation HTML/CSS</td>
                                <td>2</td>
                                <td>20h</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h4>SEMESTRE 2</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="bg-light">Enseignements</th>
                                <th class="bg-light">ECTS</th>
                                <th class="bg-light">TP/TD</th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th colspan="" class="">
                                    <a data-toggle="collapse" href="#" data-target=".ue21-content"class="collapsed text-decoration-none text-body" aria-expanded="collapsed">
                                    <span class="fas fa-chevron-down m-2"></span>
                                    UE21 Compétences transversales
                                    </a>
                                </th>
                                <th>4</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="collapse ue21-content">
                                <td>Anglais</td>
                                <td>2</td>
                                <td>24h</td>
                            </tr>
                            <tr class="collapse ue21-content">
                                <td>Communication et techniques de recherche d'emploi</td>
                                <td>2</td>
                                <td>20h</td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="" class="">
                                    <a data-toggle="collapse" href="#" data-target=".ue22-content"class="collapsed text-decoration-none text-body" aria-expanded="collapsed">
                                    <span class="fas fa-chevron-down m-2"></span>
                                    UE22 Administration des réseaux hétérogènes (Windows, Linux)
                                </th>
                                <th>10</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="collapse ue22-content">
                                <td>Administration Windows et Configuration des services</td>
                                <td>2.5</td>
                                <td>20h</td>
                            </tr>
                            <tr class="collapse ue22-content">
                                <td>Administration Linux et Configuration des services</td>
                                <td>2.5</td>
                                <td>20h</td>
                            </tr>
                            <tr class="collapse ue22-content">
                                <td>Virtualisation</td>
                                <td>2.5</td>
                                <td>20h</td>
                            </tr>
                            <tr class="collapse ue22-content">
                                <td>Programmation Systèmes/Supervision</td>
                                <td>2.5</td>
                                <td>20h</td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="" class="">
                                    <a data-toggle="collapse" href="#" data-target=".ue23-content"class="collapsed text-decoration-none text-body" aria-expanded="collapsed">
                                    <span class="fas fa-chevron-down m-2"></span>
                                    UE23 Interconnexion des réseaux et sécurisation des applications
                                </th>
                                <th>5</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="collapse ue23-content">
                                <td>Interconnexion des réseaux locaux</td>
                                <td>2.5</td>
                                <td>20h</td>
                            </tr>
                            <tr class="collapse ue23-content">
                                <td>Sécurité réseaux et des applications</td>
                                <td>2.5</td>
                                <td>24h</td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="" class="">
                                    <a data-toggle="collapse" href="#" data-target=".ue24-content"class="collapsed text-decoration-none text-body" aria-expanded="collapsed">
                                    <span class="fas fa-chevron-down m-2"></span>
                                    UE24 Pratique professionnelle
                                </th>
                                <th>12</th>
                                <th></th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th colspan="" class="">
                                    <a data-toggle="collapse" href="#" data-target=".ue25-content"class="collapsed text-decoration-none text-body" aria-expanded="collapsed">
                                    <span class="fas fa-chevron-down m-2"></span>
                                    UE25 Projet tuteuré
                                </th>
                                <th>8</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- sidebar -->
    <div class="sidebar bg-custom-black col-lg-3">
        <div class="py-3 px-4 border-bottom border-white border-4">
            <h5 class="text-uppercase text-center titre-sidebar">Informations</h5>
        </div>
        <div class="d-flex justify-content-center p-4 border-bottom border-white border-4">
            <a class="button btn" target="_blank" href="<?= URL ?>/public/img/program-licence-professionnelle-metiers-de-l-informatique-application-web.PDF">BROCHURE</a>
        </div>
        <div class="p-5">
            <i class="fa-solid fa-graduation-cap"></i>
            <h3 class="titre-sidebar text-center">DÉPARTEMENT</h3>
            <p><a href="https://www.iut-evry.fr/iut/les-departements/departement-geii-genie-electrique-et-informatique-industrielle//" target="_blank">Génie Électrique et Informatique Industrielle (GEII)</a></p>
        </div>
    </div>
</div>
