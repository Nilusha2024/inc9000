import "./bootstrap";

import Vue from "vue";
window.Vue = Vue;

const app = new Vue({
    el: "#TV",
    created() {
        Echo.channel("job-broadcasts")
            .listen("JobInserted", (e) => {
                window.location.reload();
            })
            .listen("JobUpdated", (e) => {
                window.location.reload();
            })
            .listen("JobStatusChanged", (e) => {
                window.location.reload();
            });
    },
});
