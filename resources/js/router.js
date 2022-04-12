import Vue from "vue";
// importo vue router plugin di vue
import VueRouter from "vue-router";
// componenti Vue
import Home from "./pages/Home.vue";
import Apartment from "./pages/apartments/Index.vue";
import ApartmentShow from "./pages/apartments/Show.vue";
import Message from "./pages/Messages.vue";

// diciamo a vue di utilizzare il plugin
// avendo indicato tramite metodo statico a vue che vogliamo usare VueRouter,
// allora vue farà sì che venga aggiunta da vue router la chiave router
Vue.use(VueRouter);

// questo oggetto conterrà tutte le configurazioni di vue router
const router = new VueRouter({ 
    mode:"history",
    routes: [
    {
        path: "//",
        component: Home,
        name: "home.index",
        meta: { title: "Homepage", linkText: "Home" },
    },
    {
        path: "/apartments",
        component: Apartment,
        name: "apartments.index",
        meta: { title: "Alloggi", linkText: "Alloggi" },
    },
    {
        path: "/apartments/:apartment",
        component: ApartmentShow,
        name: "apartments.show",
        meta: {title: "Dettagli appartamento"}
    },
    {
        path: "/messages",
        component: Message,
        name: "messages.index",
        meta: { title: "Contatta l'Host"},
    },
]
});

router.beforeEach((to, from, next) => {
    //permette di cambiare il titolo della pagina in base al meta
    document.title = to.meta.title;

    next();
});

// esport istanza per renderla pubblica e farla utilizzare da vue.js
export default router;
