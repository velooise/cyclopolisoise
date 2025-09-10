<template>
  <div class="bg-white pt-12 sm:pt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
          Les {{ getRevName() }}, c'est quoi ?
        </h2>
            </div>

        <p class="mt-3 text-xl text-gray-500 sm:mt-4">
          Plusieurs communes et communautés de communes du Sud de l'Oise ont réalisé un schéma cyclable, VélOOise a participé à la plupart de ces concertations. Un schéma c'est une projection pour les dix années à venir environ qui identifie les liaisons cyclables souhaitées, leur type et une estimation du coût.  L'ensemble doit créer un maillage cyclable sans discontinuités.
        </p>
       <P>
        Les schémas cyclables qui sont incorporés dans CycloPolis de VélOOise :
         </P>
        <ul>
          <li> - Schéma de la Communauté de Communes de l'Aire Cantilienne (intègré TR) lignes 1 à 39 - 2021 - <a href=https://nuage.velooise.fr/index.php/s/iTc7NrdKcF6p47G>Programme</a> </li>
          <li> - Schéma de la CCSSO (Communauté de Communes Senlis Sud Oise)  (intégré NH+TR) lignes 200-299 - 2020 <a href=https://nuage.velooise.fr/index.php/s/7J8ECTzccJ5dgmL>Programme</a> </li>
          <li> - Schéma de l'ARC & Plan Vélo (Agglomération de Compiègne)  (intègré TR) lignes 100-199 <a href=https://geo.compiegnois.fr/adws/app/9f32f5a7-1f4a-11eb-9fe5-85eb52a29e6a/index.html>Plan Vélo 2021-2026</a> </li>
          <li> - Schéma de l'ACSO (10%) lignes 300-399 - 2019 - <a href=https://nuage.velooise.fr/index.php/s/XbaPero22LJQHGz>Programme</a></li>
          <li> - Schéma de la Communauté de Communes du Liancourtois et de la Vallée Dorée (100%) lignes 600-799 - 2022 - <a href=https://nuage.au5v.fr/index.php/s/4yjttrmBdQsZdZX>Programme</a></li>
          <li> - Schéma du Clermontois (10%) lignes 400-499 - 2022 - <a href=https://nuage.velooise.fr/index.php/s/5psYyQNQz9T9jf2>Programme</a></li>
         <li> - Schéma de la CCPOH (Communauté de Communes du Pays d'Oise et d'Halatte) - 2021 (intègré TR) lignes 500-599 <a href=https://nuage.au5v.fr/index.php/s/Tr7gjdXyYPnPa8p>Scénario Retenu</a> </li>
          <li> - Schéma de la ville de Senlis (intègré TR) lignes 40 à 59 - Septembre 2022 - <a href=https://nuage.velooise.fr/index.php/s/kfCECc6bbQyBZPq>Programme</a> </li>
          <li> - Schéma de la ville de Chantilly (0%) lignes 500 - 599 - Mars 2022 - <a href=https://nuage.velooise.fr/index.php/s/487T6HwCcsYtoQF>Programme</a> </li>
            
        </ul>
      
        D'autres schémas viendront s'adjoindre à cet outil. L'objectif de l'outil est de suivre le déploiement des différents plans et de constituer un historique des différents aménagements. C'est un travail un peu fastidieux à réaliser et <b>tous les volontaires sont invités à participer</b>. Il suffit de manipuler un peu en informatique, nous pouvons vous former, si vous connaissez github, les formats json et markdown, c'est un plus.
      </div>
    </div>
   
</template>
<script setup lang="ts">
const { getRevName, getNbVoiesCyclables } = useConfig();

</script>
