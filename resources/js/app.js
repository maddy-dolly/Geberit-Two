import 'es6-promise/auto'
import axios from 'axios'
import './bootstrap'
import Vue from 'vue'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import Index from './Index'
import auth from './auth'
import router from './router'
import 'bootstrap';


import XLSX from 'xlsx'
Vue.use(XLSX)

//validation libarery
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)

//for vue model
import VModal from 'vue-js-modal'
Vue.use(VModal, { dialog: true })
Vue.use(VModal)



//v-data-table libarery
import DataTable from 'v-data-table'
Vue.use(DataTable)

//import toster
import Toasted from 'vue-toasted';
  
Vue.config.productionTip = false
Vue.use(Toasted, {
  duration: 3000,
  position: "top-center"
})

//import el-button libarery
import VueElElements from 'vue-el-element'
Vue.use(VueElElements)

// Set Vue globally
window.Vue = Vue
// Set Vue router
Vue.router = router
Vue.use(VueRouter)
// Set Vue authentication
Vue.use(VueAxios, axios)
axios.defaults.baseURL = `/api`
Vue.use(VueAuth, auth)
//import vue-loader
import 'vue-loaders/dist/vue-loaders.css';
import VueLoaders from 'vue-loaders';
 
Vue.use(VueLoaders);

//import components
import Navbar from './pages/admin/Navbar'
Vue.component('navbar', Navbar);
import Footerr from './pages/admin/Footerr'
Vue.component('footerr', Footerr);
import LineChart from './pages/admin/LineChart'
Vue.component('line-chart', LineChart);

import Rejectquotation from './pages/admin/Quotation/Rejectquotation'
Vue.component('rejectquotation', Rejectquotation);


router.beforeEach((to, from, next) => {
  document.title = to.meta.title
  next()
});

// Load Index
Vue.component('index', Index)
const app = new Vue({
  el: '#app',
  router,
  
});