import Echo from "laravel-echo";

window.Echo = new Echo({
    broadcaster: "pusher",
    key: "659f841275de77b67a5f",
    cluster: "ap2",
    forceTLS: true,
});

var channel = Echo.private("App.Models.User." + userID);
channel.notification(function (data) {
    alert(JSON.stringify(data));
});
