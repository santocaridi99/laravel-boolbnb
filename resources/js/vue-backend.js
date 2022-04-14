window.Vue = require("vue");

Vue.component(
    "form-coords",
    require("./components/forms/FormCoords.vue").default
);

const app = new Vue({
    el: "#root",
});