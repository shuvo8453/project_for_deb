<template>
    <div class="container-fluid">
        <NavBar></NavBar>
        <GlobalLoading />
        <div class="container mt-5">
            <form @submit.prevent="submit">

                <div class="form-group mt-3">
                    <label for="project">Project:</label>
                    <select class="form-select mb-3" v-model="task.project_code">
                        <option value="">select project</option>
                        <template v-for="(item,index) in getProjectList" :key="index">
                            <option :value="item.code">{{ item.code }}</option>
                        </template>
                    </select>

                    <small class="text-danger" v-if="errors.project_code">
                        {{ errors.project_code[0] }}
                    </small>
                </div>

                <div class="form-group mt-3">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" v-model="task.name">
                    <small class="text-danger" v-if="errors.name">
                        {{ errors.name[0] }}
                    </small>
                </div>

                <div class="form-group mt-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea class="form-control" id="description" rows="3" placeholder="Enter code" v-model="task.description"></textarea>
                    <small class="text-danger" v-if="errors.description">
                        {{ errors.description[0] }}
                    </small>
                </div>

                <div class="form-group mt-3">
                    <label for="status">Team mates:</label>
                    <select class="form-select" multiple aria-label="Team mate" v-model="task.user_id">
                        <template v-for="(item,index) in getTeamMateList" :key="index">
                            <option :value="item.id">{{item.name}}</option>
                        </template>
                    </select>
                    <small class="text-danger" v-if="errors.user_id">
                        {{ errors.user_id[0] }}
                    </small>
                </div>

                <div class="form-group mt-3">
                    <label for="status">Status:</label>
                    <select class="form-select mb-3" v-model="task.status">
                        <template v-for="(item, index) in getStatus" :key="index">
                            <option :value="item" selected>{{item}}</option>
                        </template>
                    </select>
                    <small class="text-danger" v-if="errors.status">
                        {{ errors.status[0] }}
                    </small>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Save</button>
            </form>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState, mapWritableState } from 'pinia'
import { useTaskStore } from '../../../stores/task'
import NavBar from '../../../components/common/Navbar.vue'
import { useGlobalStore } from '../../../stores/global'
import { projectList, teamMateList , create } from '../../../function/task'

export default {
    components:{
        NavBar
    },
    computed: {
        ...mapWritableState(useTaskStore, { task: 'task', errors: 'errors'}),
        ...mapState(useTaskStore, {
            getTaskData: 'getTaskData',
            getProjectList: 'getProjectList',
            getTeamMateList: 'getTeamMateList',
            getStatus: 'getStatus',
            getApiRoutes: 'getApiRoutes'
        }),
    },
    methods:{
    ...mapActions(useTaskStore, { setErrors: 'setErrors', clearForm: 'clearForm', setProjectList:'setProjectList' , setTeamMateList:'setTeamMateList'}),
    ...mapActions(useGlobalStore, { setGlobalLoading: 'setGlobalLoading' }),
    async submit () {
      await create(this)
    },
    async getProject () {
      await projectList(this)
    },
    async getTeamMate () {
      await teamMateList(this)
    }
  },
  mounted(){
    this.getProject()
    this.getTeamMate()
  }
}
</script>

<style scoped>
</style>
