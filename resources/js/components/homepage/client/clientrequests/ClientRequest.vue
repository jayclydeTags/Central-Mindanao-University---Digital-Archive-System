<template>
    <v-container>
        <v-row>
            <!-- <v-col cols="12">
                <v-card flat color="green">
                    <v-card-title class="text-uppercase grey--text text--lighten-5">
                        Your Requests
                    </v-card-title>
                    <v-card-actions>
                        <v-tabs background-color="transparent" active-class="green lighten-4 grey--text text--darken-3"
                            v-model="tabs">
                            <v-tabs-slider></v-tabs-slider>
                            <v-tab href="#mobile-tabs-5-1" class="grey--text text--lighten-5">
                                <v-icon>mdi-swap-horizontal </v-icon> Request
                            </v-tab>

                            <v-tab href="#mobile-tabs-5-2" class="grey--text text--lighten-5">
                                <v-icon>mdi-file-table </v-icon> Request Log
                            </v-tab>
                        </v-tabs>
                    </v-card-actions>
                </v-card>
            </v-col>

            <v-col cols="12">
                <v-card flat class="shadow">
                    <v-tabs-items v-model="tabs">
                        <v-tab-item v-for="i in 2" :key="i" :value="'mobile-tabs-5-' + i">
                            <v-card flat v-if="i === 1">
                                <client-requests-table></client-requests-table>
                            </v-card>
                            <v-card flat v-if="i === 2">
                                <client-requests-log-table></client-requests-log-table>
                            </v-card>
                        </v-tab-item>
                    </v-tabs-items>
                </v-card>
            </v-col> -->

            <v-col cols="12">
                <v-card flat class="card-title--background">
                    <v-card-title class="text-uppercase grey--text text--lighten-5">
                        Your Requests
                    </v-card-title>
                </v-card>
            </v-col>

            <v-col cols="12">
                <v-card flat color="grey lighten-3 action-tab--shadow rounded-lg pa-2">
                    <v-tabs hide-slider v-model="tabs" active-class="green lighten-2 grey--text text--darken-4 rounded"
                        background-color="transparent">
                        <!-- <v-tabs-slider></v-tabs-slider> -->
                        <v-tab href="#mobile-tabs-5-1" class="grey--text text--darken-1">
                            <!-- <v-icon>mdi-swap-horizontal </v-icon>  -->
                            Request
                        </v-tab>
                        <v-tab href="#mobile-tabs-5-2" class="grey--text text--darken-1">
                            <!-- <v-icon>mdi-file-table </v-icon>  -->
                            Request Log
                        </v-tab>
                    </v-tabs>
                </v-card>
            </v-col>
            <v-col cols="12">
                <v-card flat class="shadow">
                    <v-tabs-items v-model="tabs">
                        <v-tab-item v-for="i in 2" :key="i" :value="'mobile-tabs-5-' + i">
                            <v-card flat v-if="i === 1">
                                <client-requests-table></client-requests-table>
                            </v-card>
                            <v-card flat v-if="i === 2">
                                <client-requests-log-table></client-requests-log-table>
                            </v-card>
                        </v-tab-item>
                    </v-tabs-items>
                </v-card>
            </v-col>

        </v-row>
    </v-container>
</template>

<script>
import ClientRequestsTable from "./ClientRequestsTable.vue";
import ClientRequestsLogTable from './ClientRequestLogTable.vue'
export default {
    components: { ClientRequestsTable, ClientRequestsLogTable },
    data() {
        return {
            tabs: null
        }
    },
    created() {
        this.$store.dispatch("getRequests")
        this.$store.dispatch("getFileList")
        this.$store.dispatch("getFileLocations")
    },
};
</script>

<style scoped>


.shadow {
    box-shadow:
        2.4px 3.5px 17.8px rgba(0, 0, 0, 0.087),
        21px 30px 80px rgba(0, 0, 0, 0.14) !important;
}

.action-tab--shadow {
    box-shadow: 6px 6px 12px #cacaca,
        -6px -6px 12px #ffffff !important;
}
</style>

