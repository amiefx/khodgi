import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import ExampleComponent from './components/ExampleComponent';



const routes = [
    { path: '/example', component: ExampleComponent, name: 'ExampleComponent' },
    // { path: '/', redirect: '/login' },
    // { path: '/login', component: LoginComponent, name: 'Login' },
    // { path: '/store', component: Store, name: 'Store' },
    // { path: '/forgotpassword', component: ForgotpasswordComponent, name: 'Forgotpassword' },
    // { path: '/resetpassword/:token', component: ResetpasswordComponent, name: 'Resetpassword' },
    // {
    //     path: '/admin', component: AdminComponent, name: 'Admin',
    //     children: [
    //         { path: 'roles', component: RolesComponent, name: 'Roles' },
    //         { path: 'users', component: UserComponent, name: 'User' }
    //     ],
    //     beforeEnter: (to, from, next) => {
    //         axios.get('/api/verify')
    //             .then(res => next())
    //             .catch(err => next('/login'))
    //     }
    // },

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
