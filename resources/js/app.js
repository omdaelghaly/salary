/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'


import store from './store/store.js'




Vue.use(VueRouter)


// Vue.prototype.$xxx= 'allllllllllli'


import Mynav from './components/inc/Mynav'
import Login from './components/log/Login'
import Register from './components/log/Register'
import Home from './components/home/Home'
import Addnewschool from './components/home/Addnewschool'
import  Editschool from './components/home/Editschool'
import  Salary from './components/salary/Salary'
import  Addemp from './components/salary/Addemp'
// import  Editemp from './components/salary/Editemp'

const routes = [
    { path: '/', component: Home  },
    { path: '/login', component: Login},
    { path: '/register', component: Register },
    { path: '/addnewschool', component: Addnewschool  },
    { path: '/editschool/:id', component: Editschool , name:'editschool' },
    { path: '/salary/:id', component: Salary  },
    { path: '/addemp', component: Addemp  },
    // { path: '/editemp', component: Editemp  },

  ]
  
  const router = new VueRouter({
    mode:'history',
    routes ,
  })

const app = new Vue({ 
    el: '#app',
    store,
    router,

    components:{
        Mynav,
        Login,Register,Home,
        //Salary,Editemp,Addemp
    }
});
