document.addEventListener("DOMContentLoaded", function() {

    // Vérifiez si l'utilisateur a donné la permission de recevoir des notifications
    if (!("Notification" in window)) {
        console.log("Ce navigateur ne supporte pas les notifications desktop");
    } else if (Notification.permission === "granted") {
        console.log("Permission de recevoir des notifications accordée");
    } else if (Notification.permission !== "denied") {
        // Demandez la permission si elle n'est pas déjà définie
        Notification.requestPermission().then(function (permission) {
            if (permission === "granted") {
                console.log("Permission de recevoir des notifications accordée");
            } else {
                console.log("Permission de recevoir des notifications refusée");
            }
        });
    }

    // Pusher Configuration
    Pusher.logToConsole = false; // Consider turning this off for production

    const pusher = new Pusher(window.PusherConfig.key, {
        cluster: window.PusherConfig.cluster,
        encrypted: true,
        authEndpoint: '/pusher/auth', // Add this line to set the auth endpoint
        auth: {
            headers: {
                'X-CSRF-Token': window.csrfToken // Add this line to send the CSRF token with the auth request
            }
        }
    });
    
    var groupId = window.groupId;
    

    var channelName = "private-chat-" + groupId; // Formatez le nom du canal en fonction des ID triés
    const channel = pusher.subscribe(channelName);
    
    channel.bind('pusher:subscription_error', function(status) {
        console.error('Failed to subscribe to the channel', status);
    });

    channel.bind('new-message', function(data) {

        // Vérifiez si l'utilisateur a donné la permission de recevoir des notifications
        if (Notification.permission === "granted") {
            // Si c'est le cas, créez une nouvelle notification
            var notification = new Notification("Nouveau message", {
                body: data.message.content,
                icon: null // Vous pouvez ajouter une icône ici si vous le souhaitez
            });

            console.log('Notification créée :', notification);

            // Vous pouvez également ajouter un écouteur d'événements pour que quelque chose se produise lorsque l'utilisateur clique sur la notification
            notification.onclick = function(event) {
                event.preventDefault(); // Empêche le navigateur de se concentrer sur la fenêtre de la notification
                window.open(window.location.href, '_blank'); // Ouvre une nouvelle fenêtre avec l'URL de la discussion
                notification.close(); // Ferme la notification
            };
        }

        const messagesContainer = document.querySelector('.message-list');
        
        // Determine if the current user is the sender
        const isSender = data.message.user_id.toString() === window.userId.toString();
            
        // Create the list item for the new message
        const newMessageElement = document.createElement('li');
        newMessageElement.className = `message ${isSender ? 'sender' : 'receiver'}`;
    
        const messageContent = document.createElement('div');
        messageContent.className = 'message-content';
    
        // Create the user name element
        const userNameElement = document.createElement('small');
        userNameElement.textContent = isSender ? 'Moi' : data.message.user.firstname + ' ' + data.message.user.lastname;
        messageContent.appendChild(userNameElement);
    
        messageContent.innerHTML += `<p>${data.message.content}</p>`;
        
        if (data.message.file_path) {
            const fileLink = document.createElement('a');
            // Remove the incorrect prefix from the file path
            const correctFilePath = data.message.file_path.replace('public/', '/storage/');
            console.log('Original file path:', data.message.file_path);
            console.log('Corrected file path:', correctFilePath);
            fileLink.href = correctFilePath;
            fileLink.textContent = 'Télécharger le fichier';
            fileLink.download = '';
            messageContent.appendChild(fileLink);
        }
    
        const timeSpan = document.createElement('span');
        timeSpan.className = 'time';
        let messageDate = new Date(data.message.created_at);

        let day = '0' + messageDate.getDate();
        let month = messageDate.getMonth() + 1; // Les mois sont indexés à partir de 0
        month = month < 10 ? '0' + month : month;
        let year = messageDate.getFullYear();
        
        let hours = messageDate.getHours();
        let minutes = messageDate.getMinutes();
        let seconds = messageDate.getSeconds();
        let ampm = hours >= 12 ? 'PM' : 'AM';
        
        hours = hours % 24;
        hours = hours ? hours : 24; // the hour '0' should be '24'
        minutes = minutes < 10 ? '0'+minutes : minutes;
        seconds = seconds < 10 ? '0'+seconds : seconds;
        
        let strTime = day + '-' + month + '-' + year + ' ' + hours + ':' + minutes + ':' + seconds + ' ' + ampm;
        timeSpan.textContent = strTime;

        messageContent.appendChild(timeSpan);
    
        newMessageElement.appendChild(messageContent);
        
        // Add the new message to the top of the list
        messagesContainer.append(newMessageElement);
    });
});