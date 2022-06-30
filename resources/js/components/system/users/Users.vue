<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-card flat class="card-title--background">
                    <v-card-title class="text-uppercase grey--text text--lighten-5">
                        Staff Management
                    </v-card-title>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <user-table></user-table>
        </v-row>
    </v-container>

</template>
<script>
import UserTable from './UserTable.vue'
export default {
    components: { UserTable },
    created() {
        this.$store.dispatch("getUserList")
    }
}
</script>
