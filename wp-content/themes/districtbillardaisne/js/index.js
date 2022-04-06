window.onload = () => {
    //scan pour remplacer les div par des images
    let previewSystem = new IntersectionObserver(function (entries) {
        for (let image of entries) {
            if (image.isIntersecting) {
                let newElement = document.createElement('img')
                newElement.src = image.target.dataset.src;
                newElement.alt = image.target.dataset.alt;
                newElement.classList = image.target.classList;
                newElement.classList.remove('preview')

                let parent = image.target.parentNode;
                parent.insertBefore(newElement, image.target)
                image.target.remove()
            }
        }
    });
    //execute le scan des div -> images pour toutes les elements de classe "preview"
    let previews = document.querySelectorAll('.preview')
    for (let preview of previews) {
        previewSystem.observe(preview)
    }
}