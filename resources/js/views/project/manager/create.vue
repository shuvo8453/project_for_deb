<template>
    <div class="container-fluid">
        <NavBar></NavBar>
        <GlobalLoading />
        <div class="container mt-5">
            <form @submit.prevent="submit">
                <div class="form-group mt-3">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" v-model="project.name">
                    <small class="text-danger" v-if="errors.name">
                        {{ errors.name[0] }}
                    </small>
                </div>

                <div class="form-group mt-3">
                    <label for="code">Code:</label>
                    <input type="text" class="form-control" id="code" placeholder="Enter code" v-model="project.code">
                    <small class="text-danger" v-if="errors.code">
                        {{ errors.code[0] }}
                    </small>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState, mapWritableState } from 'pinia'
import { useProjectStore } from '../../../stores/project'
import NavBar from '../../../components/common/Navbar.vue'
import { useGlobalStore } from '../../../stores/global'
import { create } from '../../../function/project'

export default {
    components:{
        NavBar
    },
    computed: {
        ...mapWritableState(useProjectStore, { project: 'project', errors: 'errors'}),
        ...mapState(useProjectStore, {
            getProjectData: 'getProjectData',
            getApiRoutes: 'getApiRoutes'
        }),
    },
    methods:{
    ...mapActions(useProjectStore, { setErrors: 'setErrors', clearForm: 'clearForm'}),
    ...mapActions(useGlobalStore, { setGlobalLoading: 'setGlobalLoading' }),
    async submit () {
      await create(this)
    }
  }
}
</script>

<style scoped>
</style>
