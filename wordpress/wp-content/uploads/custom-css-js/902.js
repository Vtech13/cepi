<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour mettre à jour l'affichage basé sur la sélection actuelle
    function updateDisplay(selectId, blockClass) {
        var select = document.getElementById(selectId);
        var block = document.querySelector('.' + blockClass); // Sélectionne le premier élément avec cette classe

        if (select.value === 'Oui') {
            if (block) block.style.display = 'block'; // Affiche le bloc, s'il existe
        } else {
            if (block) block.style.display = 'none'; // Masque le bloc, s'il existe
        }
    }

    // Mettre à jour les états initiaux
    updateDisplay('form-field-fumeur', 'elementor-field-group-quantitecigarette');
    updateDisplay('form-field-cannabis', 'elementor-field-group-quantitecannabis');

    // Ajouter des écouteurs d'événements pour les changements
    document.getElementById('form-field-fumeur').addEventListener('change', function() {
        updateDisplay('form-field-fumeur', 'elementor-field-group-quantitecigarette');
    });

    document.getElementById('form-field-cannabis').addEventListener('change', function() {
        updateDisplay('form-field-cannabis', 'elementor-field-group-quantitecannabis');
    });
});
</script>
<!-- end Simple Custom CSS and JS -->
