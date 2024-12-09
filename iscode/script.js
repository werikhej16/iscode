document.addEventListener('DOMContentLoaded', () => {
    const messageInput = document.querySelector('#messageInput');
    const sendButton = document.querySelector('#sendButton');
    const chatContainer = document.querySelector('#chatContainer');

    sendButton.addEventListener('click', () => {
        const message = messageInput.value.trim();
        if (!message) return;

        // Add user message to the chat
        const userMessageDiv = document.createElement('div');
        userMessageDiv.className = 'message user';
        userMessageDiv.textContent = message;
        chatContainer.appendChild(userMessageDiv);

        // Clear input field
        messageInput.value = '';

        // Send message to backend
        fetch('/send-message', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ message }),
        })
            .then(response => response.json())
            .then(data => {
                // Add bot reply to the chat
                const botMessageDiv = document.createElement('div');
                botMessageDiv.className = 'message bot';
                botMessageDiv.textContent = data.reply;
                chatContainer.appendChild(botMessageDiv);
            })
            .catch(error => console.error('Error:', error));
    });
});
