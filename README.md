FactAutos69 v3
===============

=> Dummy project to learn/improve my knowledge on:

    * Symfony2
    * Git
    * Web stuff  (Twitter Bootstrap, jQuery, highcharts.js, etc)

Installation:
--------------

    * git clone
    * php composer.phar update
    * configurer app/config/parameters.yml
    * php app/console doctrine:schema:create
    * php app/console doctrine:fixtures:load
    * charger les données à partir du job TALEND
    * exécuter le script SQL suivant: UPDATE bill SET `vatRate_id` = (SELECT id FROM vat where isCurrent = 1);

Problèmes connus:
------------------

    * Mineure / cosmétique:
        * Nouvelle facture / étape 2 (Véhicule): Si on tente de passer à l'étape suivante sans véhicule, l'autocomplete des immatriculations affiche une ligne vide
        * Nouvelle facture / impression: Revoir la popup (moche avec les ascenceurs, voir pour utiliser le même module que pour la recherche de facture)