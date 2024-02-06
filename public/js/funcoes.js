function showImage(imageSrc) {
    document.getElementById('largerImage').src = imageSrc;
    document.getElementById('largerImageContainer').style.display = 'flex';

    // Adicione previews das outras imagens abaixo
    var thumbnailsContainer = document.getElementById('thumbnailsContainer');
    thumbnailsContainer.innerHTML = '';

    // Coloque aqui todas as miniaturas, exceto a que foi clicada
    var thumbnails = [
        'imagem1.jpg',
        'imagem2.jpg',
        // Adicione mais miniaturas conforme necessário
    ];

    thumbnails.forEach(function(thumbnailSrc) {
        if (thumbnailSrc !== imageSrc) {
            var previewThumbnail = document.createElement('img');
            previewThumbnail.src = thumbnailSrc;
            previewThumbnail.alt = 'Preview';
            previewThumbnail.className = 'previewThumbnail';
            previewThumbnail.onclick = function() {
                showImage(thumbnailSrc);
            };
            thumbnailsContainer.appendChild(previewThumbnail);
        }
    });
}

function closeImage() {
    document.getElementById('largerImageContainer').style.display = 'none';
}

$event.addEvent