import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';



import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

const userIdd = document.querySelector('meta[name="user-id"]').content;
window.Echo.private('user.'+ userIdd)
    .listen('.private-notification',(notification) => {
        document.getElementById('js_count_admin').innerHTML = parseInt(document.getElementById('js_count_admin').innerHTML) + 1
        var beep = new Audio();
        beep.src ="../../new-message-sound.mp3";
        beep.play();
});


//Presence channel
// window.Echo.join(`notification`)
//     .here((users) => {
//         console.log("Admins en ligne:", users[0].id);
//         var beep = new Audio();
//         beep.src ="../../new-message-sound.mp3";
//         beep.play();
//     })
//     .joining((user) => {
//         console.log("Admin connecté:", user);
//     })
//     .leaving((user) => {
//         console.log("Admin déconnecté:", user);

//     });
