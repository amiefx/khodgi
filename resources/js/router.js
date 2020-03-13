import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from './views/Home';
import LoginComponent from './components/LoginComponent';
import RegisterComponent from './components/RegisterComponent';
import ForgotpasswordComponent from './components/ForgotpasswordComponent';
import ResetpasswordComponent from './components/ResetpasswordComponent';
import User from './account/User';
import Profile from './account/Profile';
import AdminComponent from './admin/AdminComponent';
import RolesComponent from './admin/RolesComponent';
import UserComponent from './admin/UserComponent';
import AttributeSets from './admin/AttributeSets';
import Attribute from './admin/Attribute';
import Category from './admin/Category';
import Test from './admin/Test';
import Test2 from './admin/Test2';

import HomeSlide from './admin/HomeSlide';
import HomeSection from './admin/HomeSection';



const routes = [
    { path: '/', component: Home, name: 'home' },
    { path: '/test', component: Test, name: 'test' },
    { path: '/test2', component: Test2, name: 'test2' },
    { path: '/login', component: LoginComponent, name: 'Login' },
    { path: '/register', component: RegisterComponent, name: 'Register' },
    { path: '/forgotpassword', component: ForgotpasswordComponent, name: 'Forgotpassword' },
    { path: '/resetpassword/:token', component: ResetpasswordComponent, name: 'Resetpassword' },
    { path: '/account', component: User, name: 'account',
        children: [
             { path: 'profile', component: Profile, name: 'profile' },
            // { path: 'users', component: UserComponent, name: 'User' }
        ],
        beforeEnter: (to, from, next) => {
            axios.get('/api/verify')
                .then(res => next())
                .catch(err => next('/login'))
        }
    },
    {
        path: '/admin', component: AdminComponent, name: 'Admin',
        children: [
             { path: 'roles', component: RolesComponent, name: 'Roles' },
             { path: 'users', component: UserComponent, name: 'User' },
             { path: 'home-slides', component: HomeSlide, name: 'home.slides' },
             { path: 'home-sections', component: HomeSection, name: 'home.sections' },
             { path: 'attribute-sets', component: AttributeSets, name: 'attribute.sets' },
             { path: 'attributes', component: Attribute, name: 'attributes' },
             { path: 'categories', component: Category, name: 'categories' },
        ],
        beforeEnter: (to, from, next) => {
            axios.get('/api/verify')
                .then(res => next())
                .catch(err => next('/login'))
        }
    },
    // { path: '/', redirect: '/login' },
    // { path: '/store', component: Store, name: 'Store' },
    // { path: '/forgotpassword', component: ForgotpasswordComponent, name: 'Forgotpassword' },
    // { path: '/resetpassword/:token', component: ResetpasswordComponent, name: 'Resetpassword' },

  ]

  const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: 'history'
  })

  router.beforeEach((to, from, next) => {
      const token = localStorage.getItem('token') || null
        window.axios.defaults.headers['Authorization'] = 'Bearer ' + token;
        next();
    })


export default router
