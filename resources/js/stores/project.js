import { defineStore } from 'pinia'

export const useProjectStore = defineStore('project', {
  state: () => {
    return {
        showProject:[],
        project: {
            name: '',
            code: '',
        },
        pagination:{
            current_page: 1,
            last_page: 1,
        },
        nameSearch:'',
        apiRoutes: {
            create: '/api/v1/project',
            list: '/api/v1/project',
        },
        errors: [],
    }
  },
  getters: {
    getProjectData (state) {
        return state.project
    },
    getNameSearch (state) {
        return {name: state.nameSearch , page: state.pagination.current_page}
    },
    getPagination (state) {
        return  state.pagination
    },
    getProjectList (state) {
        return state.showProject
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
    setProjectList (payload = []) {
        this.showProject = payload
    },
    setPagination (payload) {
        this.pagination = payload
    },
    clearForm () {
      this.project.name = ''
      this.project.code = ''
    },
    clearSearch () {
        this.nameSearch = ''
    }
  }
})
