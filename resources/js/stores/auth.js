import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', {
  state: () => {
    return {
      token: localStorage.getItem('token') ?? '',
      profile: JSON.parse(localStorage.getItem('profile') ?? JSON.stringify([])) ,
      login: {
        email: '',
        password: '',
      },
      reg:{
        email: '',
        name: '',
        employee_id: '',
        password: '',
      },
      apiRoutes: {
        login: '/api/v1/login',
        registation: '/api/v1/registration',
        logout: '/api/v1/logout',
      },
      errors: [],
    }
  },
  getters: {
    getToken (state) {
      return state.token
    },
    getProfile (state) {
        return state.profile
    },
    getLoginData (state) {
      return state.login
    },
    getRegData (state) {
        return state.reg
    },
    getApiRoutes (state) {
      return state.apiRoutes
    },
    getErrors (state) {
      return state.errors
    }
  },
  actions: {
    setToken (token) {
      localStorage.setItem('token', token)
      this.token = token
    },
    setProfile (profile = []) {
        localStorage.setItem('profile', JSON.stringify(profile))
        this.profile = profile
    },
    removeToken () {
      localStorage.removeItem('token')
      this.token = ''
    },
    removeProfile (profile = []) {
        localStorage.removeItem('profile')
        this.profile = []
    },
    setErrors (payload = []) {
      this.errors = payload
    },
    clearLogin () {
      this.login.email = ''
      this.login.password = ''
    },
    clearReg () {
        this.reg.email = ''
        this.reg.password = ''
        this.reg.employee_id = ''
        this.reg.name = ''
      }
  }
})
