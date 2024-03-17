<template>
 <div class="container-fluid">
    <NavBar></NavBar>
    <GlobalLoading />
    <div class="container mt-5">
        <div class="mt-5 row g-3">
        <div class="col-2">
                <label for="project" class="visually-hidden">Project:</label>
                <select class="form-select mb-3" v-model="filter.project">
                    <option value="">select project</option>
                    <template v-for="(item,index) in getProjectList" :key="index">
                        <option :value="item.code">{{ item.code }}</option>
                    </template>
                </select>
            </div>
              <div class="col-1">
                    <label for="status" class="visually-hidden">Status:</label>
                    <select class="form-select mb-3" v-model="filter.status">
                        <option value="">select status</option>
                        <template v-for="(item, index) in getStatus" :key="index">
                            <option :value="item" selected>{{item}}</option>
                        </template>
                    </select>
              </div>
              <div class="col-auto">
                  <button type="button" class="btn btn-primary mb-3" @click="getList">search</button>
              </div>
          </div>
          <table class="table">
              <thead>
                  <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Name</th>
                      <th scope="col">Description</th>
                      <th scope="col">Project code</th>
                      <th scope="col">Status</th>
                      <th scope="col">Team mates</th>
                      <th scope="col">Action</th>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="(item , index) in getShowTaskList" :key="index">
                      <th scope="row">{{ item.id }}</th>
                      <td>{{item.name}}</td>
                      <td>{{item.description}}</td>
                      <td>{{item.project_code}}</td>
                      <td>{{item.status}}</td>
                      <td>
                        <span class="badge text-bg-success m-1" v-for="item in item.users" :key="item.id" >{{ item.name }}</span>
                    </td>
                    <td>
                        <button class="btn btn-outline-success" @click="upateStatus(item)" >Update status</button>
                    </td>
                  </tr>
              </tbody>
          </table>
          <Pagination :pagination="pagination" @page-changed="loadData"></Pagination>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatus" aria-hidden="true" v-if="singleTask">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateStatus">Update status</h1>
                    <button type="button" class="btn-close" @click="clearSingleTask"></button>
                </div>
                <div class="modal-body">
                    <h4>{{singleTask.name}}</h4>

                    <div class="form-group mt-3">
                        <label for="status" >Status:</label>
                        <select class="form-select mb-3" v-model="singleTask.status">
                            <template v-for="(item, index) in getStatus" :key="index">
                                <option :value="item" selected>{{item}}</option>
                            </template>
                        </select>
                    <small class="text-danger" v-if="errors.status">
                        {{ errors.status[0] }}
                    </small>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="clearSingleTask">Close</button>
                    <button type="button" class="btn btn-primary" @click="updateTaskStatus">Update</button>
                </div>
                </div>
            </div>
        </div>
 </div>
 </template>

<script>
  import { mapActions, mapState, mapWritableState } from 'pinia'
  import { useTaskStore } from '../../../stores/task'
  import { useGlobalStore } from '../../../stores/global'
  import NavBar from '../../../components/common/Navbar.vue'
  import Pagination from '../../../components/common/Pagination.vue'
  import { assignTask , teamProjectList , updateTaskStatus} from '../../../function/task'
  import { Modal } from "bootstrap";


export default {
    data(){
        return{
            updateStatusModal: ''
        }
    },
    components:{NavBar,Pagination},
    computed: {
          ...mapWritableState(useTaskStore, {pagination:'pagination', singleTask:'singleTask' ,errors: 'errors', filter:'filter'}),
          ...mapState(useTaskStore, {
                getShowTaskList: 'getShowTaskList',
                getSingleTaskStatus: 'getSingleTaskStatus',
                getFilter: 'getFilter',
                getApiRoutes: 'getApiRoutes',
                getProjectList: 'getProjectList',
                getStatus: 'getStatus',
          }),
      },
      methods:{
        ...mapActions(useTaskStore, {
            setShowTaskList: 'setShowTaskList' ,
            setPagination:'setPagination' ,
            setSingleTask:'setSingleTask',
            setErrors: 'setErrors',
            clearForm: 'clearForm',
            setProjectList : 'setProjectList'
        }),
        ...mapActions(useGlobalStore, { setGlobalLoading: 'setGlobalLoading' }),
        async getList () {
            await assignTask(this)
        },
        loadData(page = 1){
            this.pagination.current_page = page
            this.getList();
        },
        async getProject () {
            await teamProjectList(this)
        },
        upateStatus(task){
            this.setSingleTask({
                name: task.name,
                id: task.id,
                status: task.status
            })
            this.updateStatusModal.show();
        },
        clearSingleTask(){
            this.updateStatusModal.hide();
            this.setSingleTask({
                name: '',
                id: '',
                status: ''
            })
        },
        async updateTaskStatus(){
            await updateTaskStatus(this)
            if(!this.errors.status){
                this.updateStatusModal.hide();
                this.getList();
            }
        }
      },
      mounted(){
        this.getProject()
        this.getList();
        this.updateStatusModal = new Modal('#updateStatusModal', {});
      }
}
</script>

<style>

</style>
