<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-card flat class="card-title--background">
                    <v-card-title class="text-uppercase grey--text text--lighten-5">
                        Archive
                    </v-card-title>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
                <archive-table></archive-table>
        </v-row>
    </v-container>
</template>
<script>
import ArchiveTable from './ArchiveTable.vue'
export default {
    components: {
        ArchiveTable
    },
    data() {
        return {
            tabs: null
        }
    },
    created() {
        this.$store.dispatch("getFileList")
        this.$store.dispatch("getFileLocations")
    }
};
</script>
