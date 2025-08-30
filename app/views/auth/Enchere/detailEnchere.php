<h1>Détails du timbre : </h1>

<div style="display:flex; gap:20px;">
    <!-- Image principale avec effet loupe -->
    <div style="flex:1; position:relative; overflow:hidden;">
        <img id="mainImage"
            src="/Projet_web1/stampee/public/<?= htmlspecialchars($timbre['image_principale']) ?>"
            alt="<?= htmlspecialchars($timbre['nom']) ?>"
            style="width:100%; transition: transform 0.3s; cursor: zoom-in;">
    </div>

    <!-- Infos du timbre -->
    <div style="flex:1;">
        <p><strong>Nom :</strong> <?= htmlspecialchars($timbre['nom']) ?></p>
        <p><strong>Date de création :</strong> <?= htmlspecialchars($timbre['date_creation']) ?></p>
        <p><strong>Couleurs :</strong> <?= htmlspecialchars($timbre['couleurs']) ?></p>
        <p><strong>Pays :</strong> <?= htmlspecialchars($timbre['pays_origine']) ?></p>
        <p><strong>État :</strong> <?= htmlspecialchars($timbre['etat']) ?></p>
        <p><strong>Tirage :</strong> <?= htmlspecialchars($timbre['tirage']) ?></p>
        <p><strong>Dimensions :</strong> <?= htmlspecialchars($timbre['dimensions']) ?></p>
        <p><strong>Certifié :</strong> <?= $timbre['certifie'] ? 'Oui' : 'Non' ?></p>
    </div>
</div>

<!-- Galerie images supplémentaires -->
<?php if (!empty($timbre['images_supplementaires'])): ?>
    <h2>Images supplémentaires :</h2>
    <div style="display:flex; flex-wrap:wrap; gap:10px;">
        <?php foreach ($timbre['images_supplementaires'] as $img): ?>
            <img class="thumb"
                src="/Projet_web1/stampee/public/<?= htmlspecialchars($img) ?>"
                alt="Supplémentaire"
                style="width:100px; height:auto; cursor:pointer;"
                onclick="openLightbox(this.src)">
        <?php endforeach; ?>
    </div>
<?php endif; ?>


<?php if ($meilleureOffre): ?>
    <p>
        Meilleure offre : <?= $meilleureOffre['montant'] ?> $ par
        <?= $meilleureOffre['prenom'] . ' ' . $meilleureOffre['nom'] ?>
        (<?= $meilleureOffre['date_offre'] ?>)
    </p>
<?php else: ?>
    <p>Aucune offre pour le moment.</p>
<?php endif; ?>

<a href="index.php?action=listeEncheres">Retour à la liste</a>

<!-- Lightbox -->
<div id="lightbox" onclick="closeLightbox()"
    style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
            background: rgba(0,0,0,0.8); justify-content:center; align-items:center;">
    <img id="lightboxImg" src="" style="max-width:90%; max-height:90%;">
</div>

<script>
    // Zoom sur image principale
    const mainImage = document.getElementById('mainImage');
    mainImage.addEventListener('mouseover', () => mainImage.style.transform = 'scale(1.5)');
    mainImage.addEventListener('mouseout', () => mainImage.style.transform = 'scale(1)');

    // Lightbox galerie
    function openLightbox(src) {
        document.getElementById('lightbox').style.display = 'flex';
        document.getElementById('lightboxImg').src = src;
    }

    function closeLightbox() {
        document.getElementById('lightbox').style.display = 'none';
    }
</script>