import './bootstrap';
import { createApp } from 'vue';

import ViewUIPlus from 'view-ui-plus';
import 'view-ui-plus/dist/styles/viewuiplus.css';

import '../../public/assets/vendor/fonts/boxicons.css'
import '../../public/assets/vendor/fonts/fontawesome.css'
import '../../public/assets/vendor/fonts/flag-icons.css'
import '../../public/assets/vendor/css/rtl/core-dark.css'
import '../../public/assets/vendor/css/rtl/theme-default-dark.css'
import '../../public/assets/css/demo.css'
import '../../public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css'
import '../../public/assets/vendor/libs/typeahead-js/typeahead.css'

//Pages CSS
import '../../public/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css'
import '../../public/assets/vendor/css/pages/page-auth.css'


import '../../public/assets/vendor/libs/apex-charts/apex-charts.css'
import '../../public/assets/vendor/js/helpers.js'

// import '../../public/assets/vendor/js/template-customizer.js'
// import '../../public/assets/js/config.js'


import '../../public/assets/js/dashboards-ecommerce.js'
import '../../public/assets/vendor/libs/jquery/jquery.js'
import '../../public/assets/vendor/libs/popper/popper.js'
import '../../public/assets/vendor/js/bootstrap.js'
import '../../public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js'
import '../../public/assets/vendor/libs/hammer/hammer.js'
import '../../public/assets/vendor/libs/i18n/i18n.js'
import '../../public/assets/vendor/libs/typeahead-js/typeahead.js'
import '../../public/assets/vendor/js/menu.js'
import '../../public/assets/vendor/libs/apex-charts/apexcharts.js'
import '../../public/assets/js/main.js'



//Pages JS
import '../../public/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js'
import '../../public/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js'
import '../../public/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js'
import '../../public/assets/js/pages-auth.js'



//import vue-router
import router from './router';
//Import mixin
import commonMixin from './mixin/common';
import formActionMixin from './mixin/form-action'
import store from './store';

axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://127.0.0.1:8000/api/v1';

const token = localStorage.getItem('accessToken');
if (token) {
    axios.defaults.headers.common['Authorization'] = token;
}

store.dispatch('getUser', token)
    .then((response) => {
        //console.log(response.data)
    })
    .catch((error) => {
        //console.log(error.data)
    })



//Global Component Import

import MainApp from './components/MainApp.vue';

import BaseInput from './Form/BaseInput.vue';
import BaseTextarea from './Form/BaseTextarea.vue';

import VSimpleTable from './components/common/v-table/VSimpleTable.vue';
import VTableHead from './components/common/v-table/VTableHead.vue';
import VPaginate from './components/common/v-table/VPaginate.vue';

import NotFound from './components/common/NotFound.vue';

import OverlayPreloader from './components/common/OverlayPreloader.vue';
import ListPreloader from './components/common/ListPreloader.vue';


const app = createApp({});

app.component('main-app', MainApp);
app.component('BaseInput', BaseInput);
app.component('BaseTextarea', BaseTextarea);

app.component('v-simple-table', VSimpleTable);
app.component('v-table-head', VTableHead);
app.component('v-paginate', VPaginate);


app.component('not-found', NotFound);

app.component('overlay-preloader', OverlayPreloader);
app.component('list-preloader', ListPreloader);

app.use(router);
app.use(ViewUIPlus);
app.use(store);
app.mixin(commonMixin);
app.mixin(formActionMixin);
app.mount('#app')
