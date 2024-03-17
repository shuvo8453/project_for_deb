<template>
    <div class="container-fluid">
        <NavBar></NavBar>
        <div class="container mt-5">
            <div class="profile-card">
                <h4>Welcome back</h4>
                <div class="profile-picture">
                    <img src="https://via.placeholder.com/150" alt="Profile Picture" class="img-fluid">
                </div>
                <h4>{{ getProfile.name }}</h4>
                <p>{{ getProfile.employee_id }}</p>
                <p>{{ getProfile.position }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from 'pinia'
import { useAuthStore } from '../../stores/auth'
import NavBar from '../../components/common/Navbar.vue'
export default {
    components:{
        NavBar
    },
    computed: {
    ...mapState(useAuthStore, {
        getProfile: 'getProfile',
        getApiRoutes: 'getApiRoutes'
    }),

  },
}
</script>

<style scoped>
.profile-card {
    max-width: 300px;
    margin: 0 auto;
    text-align: center;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.profile-picture {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto 15px;
}
</style>
