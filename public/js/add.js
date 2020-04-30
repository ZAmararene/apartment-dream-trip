$('#add-image').click(function () {
    //Je récupère le numéro des futurs champs que je veux créer
    const index = +$('#widgets-counter').val();

    // je récupère le prototype des entrées en HTML(les sous formulaires)
    const template = $('#ad_images').data('prototype').replace(/__name__/g, index);

    //j'injecte ce code au sein de la div
    $('#ad_images').append(template);

    $('#widgets-counter').val(index + 1);

    // Gestion du bouton suppression
    handleDeleteButtons();
});

// Gérer les bouttons de suppression
function handleDeleteButtons() {
    $('button[data-action="delete"]').click(function () {
        const target = this.dataset.target;
        $(target).remove();
    });
}

function updateCounter() {
    const count = +$('#ad_images div.form-group').length;

    $('#widgets-counter').val(count);
}

updateCounter();
handleDeleteButtons();