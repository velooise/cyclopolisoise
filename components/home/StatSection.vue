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
          <li> - Schéma de la Communauté de Communes de l'Aire Cantilienne (99%) </li>
          <li> - Schéma de l'ARC & Plan Vélo (Agglomération de Compiègne)  (1% en cours)</li>
          <li> - Schéma de l'ACSO (10%)</li>
          <li> - Schéma du Clermontois (10%)</li>
          <li> - Schéma de la ville de Senlis (100%)  </li>
          <li> - Schéma de la ville de Chantilly (0%)  </li>
            
        </ul>
      
        D'autres schémas viendront s'adjoindre à cet outil. L'objectif de l'outil est de suivre le déploiement des différents plans et de constituer un historique des différents aménagements. C'est un travail un peu fastidieux à réaliser et <b>tous les volontaires sont invités à participer</b>. Il suffit de manipuler un peu en informatique, nous pouvons vous former, si vous connaissez github, les formats json et markdown, c'est un plus.
      </div>
    </div>
   
</template>
<script setup lang="ts">
const { getRevName, getNbVoiesCyclables } = useConfig();

</script>
