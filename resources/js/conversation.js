function addMessage(pseudo, message) {
    const messageDiv = document.createElement('div');
    messageDiv.classList.add('message');

    const senderDiv = document.createElement('div');
    senderDiv.classList.add('sender');
    senderDiv.appendChild(document.createTextNode(pseudo + ' :'));
    messageDiv.appendChild(senderDiv);

    const textDiv = document.createElement('div');
    textDiv.classList.add('text');
    textDiv.appendChild(document.createTextNode(message));
    messageDiv.appendChild(textDiv);

    window.conversation.messagesDiv.appendChild(messageDiv);

    window.conversation.messagesDiv.scrollTop = window.conversation.messagesDiv.scrollHeight - window.conversation.messagesDiv.clientHeight;
}

document.addEventListener('DOMContentLoaded', function () {
    window.conversation.form = document.getElementById('envoi');
    window.conversation.messageInput = window.conversation.form.getElementsByClassName('text')[0];
    window.conversation.messagesDiv = document.getElementsByClassName('messages')[0];

    window.conversation.messagesDiv.scrollTop = window.conversation.messagesDiv.scrollHeight - window.conversation.messagesDiv.clientHeight;

    window.conversation.form.addEventListener('submit', function (event) {
        event.preventDefault();
        let formData = new FormData(window.conversation.form);
        window.axios.post(window.conversation.conversationLink, formData);
        window.conversation.messageInput.value = '';
    });

    Echo.private('conversation.' + window.conversation.conversationId)
        .listen('.message.received', (e) => {
            addMessage(e.user.pseudo, e.message.message)
        });
});
