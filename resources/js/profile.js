document.getElementById('modify-button').addEventListener('click', function () {
    const form = document.createElement('form');
    form.setAttribute('method', 'POST')
    form.appendChild(document.getElementById('container'));
    const box = document.getElementById('profile-box');
    box.appendChild(form);

    const fields = document.getElementsByTagName('td');
    for (let i=0; i<fields.length; i++) {
        let field = fields[i];
        if (!field.classList.contains('set')) {
            const val = field.innerHTML
            field.innerHTML = '<input value="' + val + '">'
        }
    }

    const buttons = document.getElementById('end-btn');
    buttons.innerHTML = '<button class="btn main" id="cancel-button">Annuler</button>' +
        '<button class="btn main" type="submit">Valider</button>  '

    document.getElementById('cancel-button').addEventListener('click', function () {
        location.reload();
    })
})
