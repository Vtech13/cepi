<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
 

// Ajoutez ce code à un fichier JavaScript chargé sur la page où se trouve votre formulaire Elementor

document.addEventListener('DOMContentLoaded', function() {
    fetch('https://preprod.clinique-cepi.fr/proxy.php')
        .then(response => response.json())
        .then(data => {
            document.querySelector('input[name="_token"]').value = data.csrf_token;
        })
        .catch(error => console.error('Erreur lors de la récupération du jeton CSRF :', error));
});

document.addEventListener('DOMContentLoaded', function() {
    // Sélectionner le formulaire Elementor
    const form = document.querySelector('#login');

    // Ajouter un écouteur d'événements pour la soumission du formulaire
    form.addEventListener('submit', function(event) {
        // Empêcher le comportement par défaut du formulaire
        event.preventDefault();

        // Récupérer les valeurs des champs email, password et token
        const email = document.querySelector('input[name="email"]').value;
        const password = document.querySelector('input[name="password"]').value;
        const token = document.querySelector('input[name="_token"]').value;

        // Construire les données à envoyer
        const formData = new URLSearchParams();
        formData.append('_token', token);
        formData.append('email', email);
        formData.append('password', password);

        // Envoyer une requête POST à la route /authenticate
        fetch('https://clinique-cepi.fr/authenticate', {
            method: 'POST',
            body: formData,
			credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
        .then(response => {
            if (response.ok) {
                // Rediriger l'utilisateur ou effectuer d'autres actions nécessaires
                window.location.href = 'https://clinique-cepi.fr/plateforme';
            } else {
                // Gérer les erreurs de la requête
                console.error('Erreur lors de la requête POST');
            }
        })
        .catch(error => console.error('Erreur lors de l\'envoi de la requête :', error));
    });
});
</script>
<!-- end Simple Custom CSS and JS -->
