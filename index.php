<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Récupérer les données du formulaire
  $prenom = $_POST['prenom'];
  $nom = $_POST['nom'];
  $entreprise = $_POST['entreprise'];
  $email = $_POST['email'];
  $telephone = $_POST['telephone'];
  $pays = $_POST['pays'];
  $ville = $_POST['ville'];
  $nombre_vehicules = $_POST['nombre_vehicules'];

  // Construction du message WhatsApp
  $message = "Prénom: $prenom\n";
  $message .= "Nom: $nom\n";
  $message .= "Entreprise: $entreprise\n";
  $message .= "Email: $email\n";
  $message .= "Téléphone: $telephone\n";
  $message .= "Pays: $pays\n";
  $message .= "Ville: $ville\n";
  $message .= "Nombre de véhicules: $nombre_vehicules\n";

  // Configuration des informations d'authentification
  $base_url = "https://api.whatsapp.com/";
  $api_endpoint = "send_message"; // Endpoint pour envoyer un message via WhatsApp Business API
  $access_token = "TON_ACCESS_TOKEN"; // Ton access token pour WhatsApp Business API

  // Construction de l'URL d'appel API
  $url = $base_url . $api_endpoint . "?token=" . $access_token;

  // Préparation des données pour l'appel API
  $data = array(
    'message' => $message,
    'phone' => '+2438519591265' // Numéro de téléphone du destinataire
  );

  // Envoi de la requête HTTP POST à WhatsApp Business API
  $options = array(
    'http' => array(
      'header' => "Content-type: application/x-www-form-urlencoded\r\n",
      'method' => 'POST',
      'content' => http_build_query($data)
    )
  );
  $context = stream_context_create($options);
  $response = file_get_contents($url, false, $context);

  // Vérification de la réponse
  if ($response === false) {
    echo "Erreur lors de l'envoi du message WhatsApp.";
  } else {
    echo "Message WhatsApp envoyé avec succès.";
  }
}
?>