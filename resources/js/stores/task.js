import { defineStore } from 'pinia'

export const useTaskStore = defineStore('task', {
  state: () => {
    return {
        showTask:[],
        singleTask:{},
        projectList:[],
        teamMateList:[],
        task: {
            name: '',
            description: '',
            status: 'pending',
            project_code: '',
            user_id: [],
        },

        filter:{
            status: '',
            teamMembers: [],
            project: '',
        },

        status: ['pending' , 'working' , 'done'],
        pagination:{
            current_page: 1,
            last_page: 1,
        },
        apiRoutes: {
            create: '/api/v1/task',
            list: '/api/v1/task',
            projectList: '/api/v1/project?all=true',
            teamMateList: '/api/v1/get-team-mate',
            assignTeamMate: '/api/v1/assign-task/',
            teamMateTaskList: '/api/v1/get/assign-task',
            teamMateProjectList: '/api/v1/get/project-list',
            updateteamMatetaskStatus: '/api/v1/update-task/status/',
        },
        errors: [],
    }
  },
  getters: {
    getTaskData (state) {
        return state.task
    },
    getStatus (state) {
        return state.status
    },
    getShowTaskList (state) {
        return state.showTask
    },
    getSingleTask (state) {
        return {user_id: state.singleTask.user_id ?? []}
    },
    getSingleTaskStatus (state) {
        return {status: state.singleTask.status ?? ''}
    },
    getProjectList (state) {
        return state.projectList
    },
    getTeamMateList (state) {
        return state.teamMateList
    },
    getFilter (state) {
        return {
            status: state.filter.status ,
            teamMembers: state.filter.teamMembers ,
            project: state.filter.project ,
            page: state.pagination.current_page
        }
    },
    getPagination (state) {
        return  state.pagination
    },
    getTaskList (state) {
        return state.showTask
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
    setShowTaskList(payload = []){
        this.showTask = payload
    },
    setSingleTask(payload = []) {
        this.singleTask = payload
    },
    setProjectList(payload = []){
        console.log(payload);
        this.projectList = payload
    },
    setTeamMateList(payload = []){
        this.teamMateList = payload
    },
    setTaskList (payload = []) {
        this.showTask = payload
    },
    setPagination (payload) {
        this.pagination = payload
    },
    clearForm () {
      this.task.name = '';
      this.task.description = '';
      this.task.status = 'pending';
      this.task.project_code = ''
      this.task.user_id = []
    },
    clearSearch () {
        this.filter.status = ''
        this.filter.teamMembers = []
        this.filter.project = ''
    }
  }
})
