<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-card flat class="card-title--background">
                    <v-card-title class="text-uppercase grey--text text--lighten-5">
                        Profile
                    </v-card-title>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12">
                <v-card flat color="grey lighten-4">
                    <profile></profile>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import Profile from './Profile.vue'
export default {
    components: { Profile }
}
</script>

<style scoped>
/* .content {
    background: #fff;
} */

</style>
