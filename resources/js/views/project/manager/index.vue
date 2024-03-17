<template>
  <div class="container-fluid">
    <NavBar></NavBar>
    <GlobalLoading />
    <div class="container mt-5">
        <router-link type="button" class="btn btn-success" to="/project/create">Create new project</router-link>
        <div class="mt-5 row g-3">
            <div class="col-auto">
                <label for="name" class="visually-hidden">Name</label>
                <input type="name" class="form-control" id="name" placeholder="name" v-model="nameSearch">
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
                    <th scope="col">Code</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item , index) in getProjectList" :key="index">
                    <th scope="row">{{ item.id }}</th>
                    <td>{{item.name}}</td>
                    <td>{{item.code}}</td>
                </tr>
            </tbody>
        </table>
        <Pagination :pagination="pagination" @page-changed="loadData"></Pagination>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState, mapWritableState } from 'pinia'
import { useProjectStore } from '../../../stores/project'
import { useGlobalStore } from '../../../stores/global'
import { index } from '../../../function/project'
import NavBar from '../../../components/common/Navbar.vue'
import Pagination from '../../../components/common/Pagination.vue'

export default {
    components:{NavBar,Pagination},
    computed: {
        ...mapWritableState(useProjectStore, { nameSearch: 'nameSearch' ,pagination:'pagination'}),
        ...mapState(useProjectStore, {
            getProjectList: 'getProjectList',
            getNameSearch: 'getNameSearch',
            getApiRoutes: 'getApiRoutes'
        }),
    },
    methods:{
        ...mapActions(useProjectStore, { setProjectList: 'setProjectList' , setPagination:'setPagination'}),
        ...mapActions(useGlobalStore, { setGlobalLoading: 'setGlobalLoading' }),
        async getList () {
            await index(this)
        },
        loadData(page = 1){
            this.pagination.current_page = page
            this.getList();
        }
    },

    mounted(){
        this.getList();
    }
}
</script>

<style>

</style>
