<template>
  <div class="page-container">
    <GlobalLoading />
    <div class="login-form">
        <h1 class="h3 mb-3 text-center">Login</h1>

        <form @submit.prevent="submit">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" id="email" class="form-control" placeholder="Enter your email"  v-model="login.email">
                <small class="text-danger" v-if="errors.email">
                    {{ errors.email[0] }}
                </small>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control" placeholder="Enter your password"  v-model="login.password">
                <small class="text-danger" v-if="errors.password">
                    {{ errors.password[0] }}
                </small>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-outline-success btn-block">Login</button>
                </div>
                <div class="col-md-6">
                <router-link type="button" class="btn btn-secondary" to="/registation">Registation</router-link>
                </div>
            </div>
        </form>
    </div>
</div>
</template>

<script>
import { mapActions, mapState, mapWritableState } from 'pinia'
import { useAuthStore } from '../../stores/auth'
import { login } from '../../function/auth'
import { useGlobalStore } from '../../stores/global'

export default {
    computed: {
    ...mapWritableState(useAuthStore, { login: 'login', errors: 'errors'}),
    ...mapState(useAuthStore, {
      getLoginData: 'getLoginData',
      getApiRoutes: 'getApiRoutes'
    }),
  },

  methods:{
    ...mapActions(useAuthStore, { authToken: 'setToken', setErrors: 'setErrors', clearLogin: 'clearLogin' , setProfile:'setProfile'}),
    ...mapActions(useGlobalStore, { setGlobalLoading: 'setGlobalLoading' }),
    async submit () {
      await login(this)
    }
  }
}
</script>

<style scoped>
 .page-container {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background-color: #f8f9fa;
}
.login-form {
    width: 350px;
    padding: 15px;
    margin: auto;
}
</style>
