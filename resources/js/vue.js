window.Vue = require("vue");

// importato App dalla cartella js/views
import App from "./views/App.vue";
import router from "./router";

// vue validate
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component("contact-form", require("./components/ContactForm.vue"));

const app = new Vue({
    el: "#app",
    render: (h) => h(App),
    router: router,
});
