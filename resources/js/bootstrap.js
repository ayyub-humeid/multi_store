import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

// window.Echo = new Echo({
//     broadcaster: "pusher",
//     key: "659f841275de77b67a5f",
//     cluster: "ap2",
//     forceTLS: true,
// });
