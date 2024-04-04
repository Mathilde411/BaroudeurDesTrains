function addPlayer(user) {
    if(document.getElementById('player-' + user.id) !== null)
        return;

    const playerTr = document.createElement('tr');
    playerTr.id = 'player-' + user.id;

    const pseudoTd = document.createElement('td');
    pseudoTd.innerText = user.pseudo;

    playerTr.appendChild(pseudoTd)

    window.game.playersTableBody.appendChild(playerTr);
}

function removePlayer(user) {
    const playerTr = document.getElementById('player-' + user.id);
    if(playerTr !== null) {
        playerTr.remove();
    }
}

function startGame() {
    window.axios.post(window.game.startRoute);
}


window.addEventListener("DOMContentLoaded", (_) => {
    window.game.playersTableBody = document.getElementById('players');

    Echo.join('game.' + window.game.slug)
        .here((users) => {
            users.forEach(addPlayer)
        })
        .joining(addPlayer)
        .leaving(removePlayer)
        .listen('.game.start', (_) => {
            location.reload();
        });

    const startButton = document.getElementById('startGame');
    if(startButton !== null) {
        startButton.addEventListener('click', startGame);
    }
});
