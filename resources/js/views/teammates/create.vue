<template>
    <div class="container-fluid">
        <NavBar></NavBar>
        <GlobalLoading />
        <div class="container mt-5">
            <div class="container mt-5">
                <form @submit.prevent="submit">
                    <div class="form-group mt-3">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" v-model="teammate.email">
                        <small class="text-danger" v-if="errors.email">
                            {{ errors.email[0] }}
                        </small>
                    </div>

                    <div class="form-group mt-3">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter name" v-model="teammate.name">
                        <small class="text-danger" v-if="errors.name">
                            {{ errors.name[0] }}
                        </small>
                    </div>

                    <div class="form-group mt-3">
                        <label for="employee_id">Employee ID:</label>
                        <input type="text" class="form-control" id="employee_id" placeholder="Enter employee ID" v-model="teammate.employee_id">
                        <small class="text-danger" v-if="errors.employee_id">
                            {{ errors.employee_id[0] }}
                        </small>
                    </div>

                    <div class="form-group mt-3">
                        <label for="position">Position:</label>
                        <input type="text" class="form-control" id="position" placeholder="Enter position" v-model="teammate.position">
                        <small class="text-danger" v-if="errors.position">
                            {{ errors.position[0] }}
                        </small>
                    </div>

                    <div class="form-group mt-3">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password" v-model="teammate.password">
                        <small class="text-danger" v-if="errors.password">
                            {{ errors.password[0] }}
                        </small>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState, mapWritableState } from 'pinia'
import { useTeamMateStore } from '../../stores/teammate'
import NavBar from '../../components/common/Navbar.vue'
import { useGlobalStore } from '../../stores/global'
import { create } from '../../function/teammate'

export default {
    components:{
        NavBar
    },
    computed: {
        ...mapWritableState(useTeamMateStore, { teammate: 'teammate', errors: 'errors'}),
        ...mapState(useTeamMateStore, {
            getTeamMateData: 'getTeamMateData',
            getApiRoutes: 'getApiRoutes'
        }),
    },
    methods:{
    ...mapActions(useTeamMateStore, { setErrors: 'setErrors', clearForm: 'clearForm'}),
    ...mapActions(useGlobalStore, { setGlobalLoading: 'setGlobalLoading' }),
    async submit () {
      await create(this)
    }
  }
}
</script>

<style scoped>

</style>
