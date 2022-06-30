<template>
    <v-container>
        <!-- <v-layout row justify-center align-center>
            <div class="float-left">
            <v-col cols="12" md="3" sm="5">
                <v-btn text @click="$router.push({ name: 'homepage' })">
                <v-icon>mdi-arrow-left</v-icon>Back to Home
                </v-btn
                >
            </v-col>
            </div>
        </v-layout> -->


        <v-layout row justify-center align-center>
            <v-card max-width="768" flat class="grey lighten-4">

                <!-- Alert Message -->
                <div v-if="msgStatus">
                    <alert-component />
                </div>

                <v-card-text>
                    <h3 class="text-h5 font-weight-bold text-uppercase grey--text text--darken-4">Forgot Password</h3>
                    <p class="text-body-2">
                        <span class="text-uppercase">cmu-das</span> Password Recovery. Please enter your valid email.
                    </p>
                    <v-container class="ma-0">
                        <v-form ref="form" @submit.prevent="save" v-model="rules.isValid" lazy-validation>
                            <v-row>
                                <v-col cols="12" class="mb-n6 px-0">
                                    <v-text-field v-model="form.email" label="Email Address" outlined dense
                                        prepend-inner-icon="mdi-email" :rules="rules.email" required>
                                    </v-text-field>
                                </v-col>
                            </v-row>

                        </v-form>
                    </v-container>

                    <!-- <a href="#" class="text-overline text-decoration-none"
                        @click="$router.push({ name: 'authentication', params: { action: 'login' } })">Login</a> -->

                </v-card-text>

                <!-- Form Buttons -->
                <v-card-actions class="px-4">
                    <v-row>
                        <v-col cols="12" lg="6">
                            <v-btn :disabled="!rules.isValid" @click="save"
                                class="grey darken-4 text-button grey--text text--lighten-5">
                                Submit
                            </v-btn>
                        </v-col>
                        <v-col cols="12" lg="6">
                            <v-btn
                                class="text-subtitle-2"
                                text
                                @click="$router.push({
                                    name: 'authentication',
                                    params: { action: 'login' },
                                })">
                                Back to Sign in
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-card-actions>
            </v-card>
        </v-layout>
    </v-container>
</template>
<script>
import AlertComponent from "./../../AlertComponent.vue";
export default {
    components: { AlertComponent },
    data() {
        return {
            //Password Property
            showpassForm: false,
            showpass: false,
            showconfirmpass: false,
            //Error Handlings Property
            error: "",
            msgStatus: false,

            //Form Properties
            form: {
                email: "",
            },


            //Rules Validation Property
            rules: {
                isValid: true,
                email: [
                    (v) => !!v || "E-mail is required",
                    (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
                ],
            },
        };
    },
    computed: {
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
    methods: {
        redirectToHome() {
            this.$router.push({ name: "homepage" });
        },
        //SAVE FORM
        forgotPassword() {
            this.$store.dispatch("forgotPassword", this.form)
        },
        redirectLogin() {

            this.$router.push({ name: "authentication", params: { action: 'login' } });

        },
        showRegister(register) {

            this.$emit("type", register);

        },
        save() {
            this.forgotPassword()
            this.$refs.form.validate()
            this.msgStatus = true

        },
    },
};
</script>

<style scoped>
/* .img {
    border: 1px solid #000;

} */

/* .right-container {
    background-image:url('../../../../../public/images/authentication.svg');
    background-color: #21c65e;
    border: 1px solid #000;
} */

::v-deep .v-btn {
    padding-left: 12px;
    padding-right: 12px;
    width: 100%;
}
</style>
