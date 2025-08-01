<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
 

document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour vérifier si c'est la première visite de l'utilisateur sur la page d'accueil lors de la session en cours
    function checkFirstVisit() {
        // Vérifier si l'utilisateur est sur la page d'accueil
        if (window.location.pathname === "/" || window.location.pathname === "/index.html") {
            if (sessionStorage.getItem("alreadyVisited")) {
                // L'utilisateur a déjà visité la page d'accueil durant cette session, ne fait rien
                console.log("Utilisateur déjà visité la page d'accueil durant cette session");
            } else {
                // C'est la première visite sur la page d'accueil durant cette session
                alert("Information importante :\nla docteure PAGBE sera absente et non-remplacée\nà partir du 16 février 2024 pour congés maternité.");
                // Marquer comme visité pour cette session
                sessionStorage.setItem("alreadyVisited", true);
            }
        }
    }

    // Appeler la fonction checkFirstVisit
    checkFirstVisit();
});
</script>
<!-- end Simple Custom CSS and JS -->
