<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
 

// Ajoutez cet écouteur d'événements sur https://preprod.clinique-cepi.fr/index.php/espace-praticiens/
document.addEventListener('DOMContentLoaded', function() {
	document.querySelector('#login').addEventListener('submit', function(e) {
	  e.preventDefault();

	  // Récupérer les valeurs
	  const email = document.querySelector('#form-field-email').value;
	  const password = document.querySelector('#form-field-password').value;

	  // Stocker les valeurs de manière sécurisée
	  sessionStorage.setItem('email', email);
	  sessionStorage.setItem('password', password);

	  // Rediriger vers le formulaire de connexion du second domaine
	  window.location.href = 'http://www.clinique-cepi.fr/login';
	});
});

</script>
<!-- end Simple Custom CSS and JS -->
