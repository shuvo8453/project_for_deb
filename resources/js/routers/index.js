import { createRouter, createWebHistory } from 'vue-router'


const routes = [
    {
        path: '/',
        name: 'login',
        meta: {
          title: 'Login',
          redirectIfAuthenticated: true,
        },
        component: () => import(/* webpackChunkName: "Login" */'../views/auth/login.vue'),
    },
    {
        path: '/registation',
        name: 'registation',
        meta: {
          title: 'Registation',
          redirectIfAuthenticated: true,
        },
        component: () => import(/* webpackChunkName: "registation" */'../views/auth/registation.vue'),
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        meta: {
          title: 'Welcome',
          requireAuth: true,
        },
        component: () => import(/* webpackChunkName: "dashboard" */'../views/dashboard/index.vue'),
    },
    {
        path: '/team-mate/create',
        name: 'manager.teammate.create',
        meta: {
          title: 'Teammates',
          requireAuth: true,
          permission: 'manager',
        },
        component: () => import(/* webpackChunkName: "manager.teammate.create" */'../views/teammates/create.vue'),
    },
    {
        path: '/project',
        name: 'manager.project.index',
        meta: {
          title: 'Project',
          requireAuth: true,
          permission: 'manager',
        },
        component: () => import(/* webpackChunkName: "manager.project.index" */'../views/project/manager/index.vue'),
    },
    {
        path: '/project/create',
        name: 'manager.project.create',
        meta: {
          title: 'Project',
          requireAuth: true,
          permission: 'manager',
        },
        component: () => import(/* webpackChunkName: "manager.project.create" */'../views/project/manager/create.vue'),
    },
    {
        path: '/task',
        name: 'manager.task.index',
        meta: {
          title: 'Task',
          requireAuth: true,
          permission: 'manager',
        },
        component: () => import(/* webpackChunkName: "manager.task.index" */'../views/task/manager/index.vue'),
    },
    {
        path: '/task/create',
        name: 'manager.task.create',
        meta: {
          title: 'Task',
          requireAuth: true,
          permission: 'manager',
        },
        component: () => import(/* webpackChunkName: "manager.task.create" */'../views/task/manager/create.vue'),
    },
    {
        path: '/assign/task',
        name: 'teammate.task.assign',
        meta: {
          title: 'Task',
          requireAuth: true,
          teammate: true,
        },
        component: () => import(/* webpackChunkName: "teammate.task.assign" */'../views/task/teamMate/index.vue'),
    },
]

function setTitle (title) {
    document.title = title ? title + ' | ' + import.meta.env.VITE_APP_NAME : import.meta.env.VITE_APP_NAME ?? 'Ba Task'
}

const token = () => {
    return localStorage.getItem('token') ?? ''
}

const profile = () => {
    return JSON.parse(localStorage.getItem('profile')) ?? ''
}

const clearToken = () => {
    localStorage.removeItem('token')
    localStorage.removeItem('profile')
}

export const routers = createRouter({
    history: createWebHistory(),
    routes
  })

routers.beforeEach((to, from, next) => {
    if (to.meta.title) {
      setTitle(to.meta.title)
    }

    if (to.meta.requireAuth) {
        let accessToken = token()
        if (accessToken) {
            axios.get('/api/v1/me', {
            headers: {Authorization: `Bearer ${accessToken}`}
            }).then((res) => {
                localStorage.setItem('profile', JSON.stringify(res.data.profile))
            }).catch(err => {
            if (err.response.status === 401) {
                clearToken()
                next({ name: 'login' })
            }
            })
        } else {
            next({ name: 'login' })
        }
    }

    if (to.meta.redirectIfAuthenticated) {
      if(token()){next({ name: 'dashboard' })}
    }

    if(to.meta.permission){
        let userProfile = profile();
        if(userProfile.position != to.meta.permission){next({ name: 'dashboard' })}
    }

    if(to.meta.teammate){
        let userProfile = profile();
        if(userProfile.position == 'manager'){next({ name: 'dashboard' })}
    }

    next()
  })

