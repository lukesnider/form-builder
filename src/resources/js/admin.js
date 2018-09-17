import Vue from 'vue'
import FormPage from './components/FormPage.vue'
import '../css/admin.css';
import '../../../node_modules/@fortawesome/fontawesome-free/js/all.min.js';
import '../../../node_modules/bootstrap/dist/css/bootstrap.min.css';


try {
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');
} catch (e) {}




if(document.getElementById("swd-form-builder-plugin-page")){
  const App = new Vue({
    el: '#swd-form-builder-plugin-page',
    render: h => h(FormPage)
  })
}
