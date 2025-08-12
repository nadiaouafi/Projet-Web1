<h1>Bienvenue <?= htmlspecialchars($user['prenom']) ?> <?= htmlspecialchars($user['nom']) ?></h1>
<p>Email : <?= htmlspecialchars($user['email']) ?></p>
<a href="/deconnexion">Se déconnecter</a>