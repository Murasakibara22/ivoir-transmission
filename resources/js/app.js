import './bootstrap';


window.Echo.channel('notification').listen('TestNotification', (e) => {
    console.log('event is :',e);
});


const userId = document.querySelector('meta[name="user-id"]').content;
window.Echo.private(`user.${userId}`).listen('.private-notification', (e) => {
    alert(e.message);
});
