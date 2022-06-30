<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-card flat class="card-title--background">
                    <v-card-title class="text-uppercase grey--text text--lighten-5">
                        welcome {{ auth.user.name }}
                    </v-card-title>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <file-list></file-list>
        </v-row>
        <!-- <div class="container shadow p-3 mb-5 bg-white">
                <div class="row">

                </div>
            </div> -->
    </v-container>
</template>
<script>
import FileList from './FileList.vue'
export default {
    components: { FileList },
    computed: {
        auth() {
            return this.$store.state.auth
        }
    },
    created() {
        this.$store.dispatch("getFileList")
        this.$store.dispatch("getFileLocations")
        this.$store.dispatch("getFileCategory")

    }
}
</script>
<style scoped>
/* .content {
    background: #fff;
} */


</style>
