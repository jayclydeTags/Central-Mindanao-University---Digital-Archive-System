<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-card flat class="card-title--background">
                    <v-card-title class="text-uppercase grey--text text--lighten-5">
                        Client Management
                    </v-card-title>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <client-table></client-table>
        </v-row>
    </v-container>
</template>
<script>
import ClientTable from './ClientTable.vue'
export default {
    components: { ClientTable }
}
</script>
