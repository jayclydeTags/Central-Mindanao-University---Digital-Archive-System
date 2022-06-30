<template>
    <v-app id="app">
        <navigation/>
        <!-- <dashboard-header/> -->

        <v-main class="grey lighten-3">
            <dashboard-content/>
        </v-main>

    </v-app>
</template>

<script>
import DashboardContent from './DashboardContent.vue'
import DashboardHeader from "./DashboardHeader.vue";
import Navigation from './Navigation.vue'

export default {

    components:{
        Navigation,
        DashboardContent,
        DashboardHeader,
    }

}
</script>



