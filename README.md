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

    * Aucun