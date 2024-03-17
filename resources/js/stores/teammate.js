import { defineStore } from 'pinia'

export const useTeamMateStore = defineStore('teammate', {
  state: () => {
    return {
        teammate: {
            email: '',
            name: '',
            employee_id: '',
            position: '',
            password: '',
        },
        apiRoutes: {
            create: '/api/v1/team-member/create',
        },
        errors: [],
    }
  },
  getters: {
    getTeamMateData (state) {
        return state.teammate
    },
    getApiRoutes (state) {
      return state.apiRoutes
    },
    getErrors (state) {
      return state.errors
    }
  },
  actions: {
    setErrors (payload = []) {
      this.errors = payload
    },
    clearForm () {
      this.teammate.email = ''
      this.teammate.password = ''
      this.teammate.employee_id = ''
      this.teammate.position = ''
      this.teammate.name = ''
    }
  }
})
