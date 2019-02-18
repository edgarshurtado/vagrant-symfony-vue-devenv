import Vue from 'vue'
import Vuetify from 'vuetify'
import AppShell from './AppShell.vue'
import 'vuetify/dist/vuetify.min.css'
import './assets/scss/styles.scss'
import VueRouter from 'vue-router'
import Home from './Home.vue'

Vue.use(Vuetify)
Vue.use(VueRouter)

const router = new VueRouter({
    routes:[
        {path: '/', component: Home}
    ]
})

const app = new Vue({
    router,
    el: '#app',
    render: h => h(AppShell)
})
