<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-row>
                    <v-col cols="12" md="6">
                        <v-row>
                            <v-col cols="12" class="mb-n6">
                                <v-text-field v-model="search" label="Search" outlined prepend-inner-icon="mdi-magnify"
                                    dense>
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" class="mb-n6">
                                <select-file-category @selectcategory="getCategory"></select-file-category>
                            </v-col>
                        </v-row>
                    </v-col>

                    <v-col cols="12" md="6">
                        <v-alert text type="info" prominent border="left" class="text-body-2">
                            Please Read before making a request, make sure to secure the
                            following: For students you can download your
                            <v-tooltip bottom color="primary">
                                <template v-slot:activator="{ on, attrs }">
                                    <span style="font-weight: bold; text-decoration: underline">
                                        <a href="#" v-on="on" v-bind="attrs" @click.prevent="
                                            downloadRequestForm({
                                                url: 'http://localhost:8000/storage/requestform/communication_letter.pdf',
                                                label: 'communication_letter',
                                            })
                                        ">communication letter</a></span>
                                </template>
                                <span>Download File</span>
                            </v-tooltip>
                            make sure your it is approved by your adviser. For faculty you can
                            download your
                            <v-tooltip bottom color="primary">
                                <template v-slot:activator="{ on, attrs }">
                                    <span style="font-weight: bold; text-decoration: underline">
                                        <a href="#" v-on="on" v-bind="attrs" @click.prevent="
                                            downloadRequestForm({
                                                url: 'http://localhost:8000/storage/requestform/letter_of_intent.pdf',
                                                label: 'letter_of_intent',
                                            })
                                        ">letter of intent</a></span>
                                </template>
                                <span>Download File</span>
                            </v-tooltip>

                            make sure it is addressed to the RMU Chief.
                        </v-alert>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>

        <v-divider></v-divider>

        <!-- SEARCH NOTIFACTION -->
        <v-alert v-show="showMsg" text type="warning" prominent border="left">
            Filename {{ this.search }} {{ this.msg }}
        </v-alert>
        <v-alert v-show="showcateg_msg" text type="warning" prominent border="left">
            {{ this.msg }}
        </v-alert>

        <!-- Alert Message -->
        <div v-if="msgStatus">
            <alert-component />
        </div>


        <!-- DOCUMENTS LIST -->
        <v-row class="my-4">
            <v-col cols="12" sm="6" md="4" class="pa-3 d-flex flex-column" v-for="(items, index) in pageOfItems"
                :key="index.file_id">
                <v-card flat class="flex d-flex flex-column grey lighten-3 action-tab--shadow rounded-lg">
                    <v-card-text class="grey lighten-2">
                        <!-- <v-row> -->
                        <!-- <div class="float-left">
                                <v-icon large color="success">mdi-folder</v-icon>
                            </div> -->

                        <div class="mb-1 gray-bg" v-show="!items.Show">
                            <v-icon large color="success">mdi-folder</v-icon>
                            <v-card-title class="d-block pa-0">
                                <h5 class="text-h5 font-weight-bold grey--text text--darken-4">
                                    {{ items.filename | title }}
                                </h5>
                            </v-card-title>
                            <div class="float-right">
                                <div v-if="items.filename.length >= 50">
                                    <v-btn text color="info" @click="titleToggler(items, true)">Show Title
                                    </v-btn>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 gray-bg" v-show="items.Show">
                            <v-card-title class="text-black text-h4">
                                <h4 class="mb-1" v-html="items.filename"></h4>
                            </v-card-title>
                            <div class="float-right">
                                <div v-if="items.filename.length >= 50">
                                    <v-btn text color="info" @click="titleToggler(items, false)">Show Less
                                    </v-btn>
                                </div>
                            </div>
                        </div>
                        <!-- </v-row> -->
                    </v-card-text>

                    <v-card-text>
                        <h5>Description</h5>
                        <!-- <div class="body-1" style="overflow-y: auto; height:200px">{{ items.description }}</div> -->
                        <div class="mb-1 gray-bg" v-show="!items.Flag">
                            <p class="mb-1">{{ items.description | summary }}</p>
                            <div class="float-right">
                                <div v-if="items.description.length >= 50">
                                    <v-btn text color="info" @click="toggler(items, true)">Show More</v-btn>
                                </div>
                            </div>
                        </div>


                        <div class="mb-1 gray-bg" v-show="items.Flag">
                            <p class="mb-1" v-html="items.description"></p>
                            <div class="float-right">
                                <v-btn text color="info" @click="toggler(items, false)">Show Less</v-btn>
                            </div>
                        </div>
                    </v-card-text>
                    <v-card-subtitle class="text-caption">Uploaded:
                        {{ new Date(items.created_at).toLocaleDateString() }}
                    </v-card-subtitle>

                    <v-card-actions>
                        <v-col cols="auto">
                            <!-- REQUEST FORM MODAL -->
                            <v-dialog transition="dialog-top-transition" max-width="600" v-model="formDialog"
                                :retain-focus="false">
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn color="primary" block v-bind="attrs" v-on="on" @click="getItem(items)">
                                        Request Document
                                    </v-btn>
                                </template>
                                <template>
                                    <v-card>
                                        <v-toolbar color="secondary" dark>Request this Document</v-toolbar>
                                        <v-container>
                                            <!-- REQUEST FORM -->
                                            <v-form ref="form" @submit.prevent="save">
                                                <v-text-field v-model="form.file_name" prepend-inner-icon="mdi-file"
                                                    label="File Name" dense disabled outlined>
                                                </v-text-field>
                                                <v-select :items="category" item-text="category"
                                                    item-value="category_id" v-model="form.category"
                                                    label="Select Category" outlined
                                                    prepend-inner-icon="mdi-format-list-bulleted-square" disabled dense>
                                                </v-select>
                                                <v-textarea v-model="form.purpose" :rules="rules.purpose"
                                                    prepend-inner-icon="mdi-text" outlined name="input-7-4"
                                                    label="Purpose">
                                                </v-textarea>

                                                <v-alert icon="mdi-alert-circle" type="warning" prominent border="left"
                                                    text class="text-caption">
                                                    Note: Please upload your communication letter if student and letter
                                                    of intent
                                                    if you're an employee or alumni. Documents MUST BE in a PDF format.
                                                </v-alert>

                                                <!-- <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <v-icon>mdi-file-cabinet</v-icon>
                                                        </span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            id="exampleFormControlFile1" v-if="uploadReady"
                                                            ref="fileupload" @change="onChangeFile" required />

                                                        <label class="custom-file-label" for="inputGroupFile01">{{
                                                                filename
                                                        }}</label>
                                                    </div>
                                                </div> -->

                                                <template>
                                                    <v-file-input
                                                        v-model="form.request_form"
                                                        :rules="rules.requesform"
                                                        label="Upload file"
                                                        outlined
                                                        dense
                                                        v-if="uploadReady"
                                                        @change="onChangeFile">
                                                    </v-file-input>
                                                </template>
                                            </v-form>
                                        </v-container>

                                        <!--  FORM BUTTONS -->
                                        <v-card-actions class="justify-end pa-4 green lighten-5">
                                            <v-btn color="blue darken-1" text @click="close">
                                                Close
                                            </v-btn>
                                            <v-btn :disabled="!rules.isValid" color="success" dark :loading="isLoading"
                                                @click="save(getUserId)">
                                                Send Request
                                            </v-btn>
                                        </v-card-actions>
                                    </v-card>
                                </template>
                            </v-dialog>
                        </v-col>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>


        <!-- PAGINATION -->
        <jw-pagination :labels="customLabels" :items="fetchFiles" @changePage="onChangePage"></jw-pagination>
    </v-container>
</template>
<script>
import SelectFileCategory from "./../../../system/files/SelectFileCategory.vue";
// import folderSvg from "./../../../../../../public/assets/img/folder2.jpg";
import AlertComponent from "./../../../AlertComponent.vue";
export default {
    components: { AlertComponent, SelectFileCategory },
    data() {
        return {
            // folderSvg: folderSvg,

            category_id: 0,

            /* PAGINATION LABLES PROPERTY */
            customLabels: {
                first: "<<",
                last: ">>",
                previous: "<",
                next: ">",
            },

            /* FILE REQUEST PROPERTIES */
            pageOfItems: [],
            search: null,
            categ_msg: "",
            showcateg_msg: false,
            msg: "",
            showMsg: false,
            paragraph: "The quick brown fox jumps over the lazy dog",

            //Dialog Property
            formDialog: false,
            dialogDelete: false,

            //NOTIFY PROPERTIES
            error: "",
            msgStatus: false,
            load: false,

            //FILES PROPERTIES
            editedIndex: -1,

            //FORM PROPERTIES
            form: {
                user_id: null,
                file_id: null,
                purpose: "",
                status: "Pending",
                expiration_date: null,
                request_date: null,
                request_form: "",
                category: null,
                file_name: null,
            },

            //RULES VALIDATION PROPERTIES
            rules: {
                isValid: true,
                purpose: [(v) => !!v || "Purpose is required"],
                requesform: [(v) => !!v || "Request form is required"],
            },
            count: null,
            uploadReady: true,
            filename: "choose file",

            more: false,
            summary: false,
            //DEFAULT FORM DATA
            defaultItem: {
                user_id: null,
                file_id: null,
                purpose: "",
                status: "Pending",
                expiration_date: null,
                request_date: null,
                request_form: "",
                file_name: null,
            },
        };
    },
    computed: {
        category() {
            const categ = this.$store.state.filecategory.filecategory;
            const newCateg = categ.concat(this.filecateg);
            return newCateg;
        },
        /* FETCH DOCUMENTS RECORDS FROM STORE STATES */
        getFileRequestReports() {
            return this.$store.state.requests.file_request_reports;
        },
        fetchFiles() {
            let files = {};
            if (this.category_id === 0) {
                files = this.$store.getters.getDocuments;
                var count = Object.keys(files).length;
                if (count === 0) {
                    this.showcateg_msg = true;
                    this.msg = "No documents found in this category";
                } else {
                    this.showcateg_msg = false;
                }
            } else {
                files = this.$store.getters.filterFilesByCategory(this.category_id);
                var count = Object.keys(files).length;
                if (count === 0) {
                    this.showcateg_msg = true;
                    this.msg = "No documents found in this category";
                } else {
                    this.showcateg_msg = false;
                }
            }
            if (this.search) {
                let result = files.filter((item) => {
                    return this.search
                        .toLowerCase()
                        .split(" ")
                        .every((v) => item.filename.toLowerCase().includes(v));
                });
                var count = Object.keys(result).length;
                if (count === 0) {
                    this.showMsg = true;
                    this.msg = "no match found in our records. Please enter the exact document name";
                    this.showcateg_msg = false;
                    return result;
                } else {
                    this.showMsg = false;
                    return result;
                }
            } else {
                this.showMsg = false;
                return this._.orderBy(files, ["created_at"], ["desc"]);
            }
        },

        /* GET CURRENT USER ID */
        getUserId() {
            return this.$store.state.auth.user.user_id;
        },

        //ISLOADING COMPUTED
        isLoading: {
            get: function () {
                return this.$store.state.base.isLoading;
            },

            set: function (newVal) {
                return newVal;
            },
        },
    },
    watch: {
        fetchFiles(val) { },
        //CLOSE MODAL

        formDialog(val) {
            val || this.close();
        },

        // DELETE MODAL
        dialogDelete(val) {
            val || this.closeDelete();
        },

        // LOADING
        isLoading(val) {
            val || this.close();
        },
    },
    filters: {
        summary: function (text) {
            return text.substring(0, 150)
        },
        title: function (title) {
            return title.substring(0, 50)
        }
    },
    methods: {
        toggler(obj, flag) {
            this.$set(obj, "Flag", flag)
        },
        titleToggler(obj, show) {
            this.$set(obj, "Show", show)
        },
        /* showMore() {
          let arrDocuments = this.pageOfItems;
          for (var i = 0; i < arrDocuments.length; i++) {
            let desc_lngt = arrDocuments[i].description.length;
            if (desc_lngt >= 100) {
            }
          }
        }, */
        async downloadRequestForm({ url, label }) {
            const response = await axios.get(url, {
                responseType: "blob",
            });
            const blob = new Blob([response.data], {
                type: "application/pdf",
            });
            const link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = label;
            link.click();
            URL.revokeObjectURL(link.href);
        },
        getCategory(category) {
            this.category_id = category;
        },
        /* PAGINATION ITEMS */
        onChangePage(pageOfItems) {
            // update page of items
            this.pageOfItems = pageOfItems;
        },

        //EDIT FILE DATA
        getItem(item) {
            this.form.file_id = item.file_id;
            this.form.file_name = item.filename;
            this.form.category = item.category_id;
        },

        //MODAL CLOSE
        close() {
            this.formDialog = false;
            this.uploadReady = false;
            this.filename = "choose file";
            this.$nextTick(() => {
                this.form = Object.assign({}, this.defaultItem);
                this.uploadReady = true;
                this.filename = "choose file";
            });
        },

        /* CALCULATE DATE FOR EXPIRATION DATE */
        calculateDate() {
            const now = new Date();
            now.setDate(now.getDate()).toString();
            var converted_timestamp = new Date(now),
                mnth = ("0" + (converted_timestamp.getMonth() + 1)).slice(-2),
                day = ("0" + converted_timestamp.getDate()).slice(-2),
                hours = ("0" + converted_timestamp.getHours()).slice(-2),
                minutes = ("0" + converted_timestamp.getMinutes()).slice(-2),
                seconds = ("0" + converted_timestamp.getSeconds()).slice(-2);
            this.form.expiration_date =
                converted_timestamp.getFullYear() +
                "-" +
                mnth +
                "-" +
                day +
                " " +
                hours +
                ":" +
                minutes +
                ":" +
                seconds;
            this.form.request_date =
                converted_timestamp.getFullYear() +
                "-" +
                mnth +
                "-" +
                day +
                " " +
                hours +
                ":" +
                minutes +
                ":" +
                seconds;
        },

        /* ADD FILE REQUEST TO DATABASE */
        async addRequest(getUserId) {
            this.calculateDate();
            this.form.user_id = getUserId;
            let fd = new FormData();
            fd.append("purpose", this.form.purpose);
            fd.append("request_date", this.form.request_date);
            fd.append("status", "Pending");
            fd.append("expiration_date", this.form.expiration_date);
            fd.append("request_form", this.form.request_form);
            fd.append("user_id", this.form.user_id);
            fd.append("file_id", this.form.file_id);
            await this.$store.dispatch("addRequest", fd);
        },

        /* ON CHANGE FILE FOR FILE INPUT */
        onChangeFile(e) {
            this.form.request_form = e.target.files[0];
            this.filename = e.target.files[0].name;
        },

        /* SAVE BUTTON ( SEND FORM DATA TO DATABASE) */
        save(getUserId) {
            this.msgStatus = true;
            this.addRequest(getUserId);
        },
    },
};
</script>
<style scoped>
.action-tab--shadow {
    box-shadow: 6px 6px 12px #cacaca,
        -6px -6px 12px #ffffff !important;
}
</style>
