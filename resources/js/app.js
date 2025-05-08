import './bootstrap';


window.Echo.channel('notification').listen('TestNotification', (e) => {
    console.log('event is :',e);
});
