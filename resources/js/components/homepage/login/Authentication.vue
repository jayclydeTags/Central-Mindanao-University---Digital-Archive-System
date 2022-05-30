<template>
    <v-container class="d-flex justify-center align-center">
        <v-overlay :value="isLoading">
            <v-progress-circular indeterminate size="64"></v-progress-circular>
        </v-overlay>
        <v-card>
            <v-row class="container-height mt-5">
            <v-col cols="12" md="6" class="d-flex justify-center align-center">
                    <div v-if="action === 'login'">
                    <login></login>
                    </div>
                    <div v-else-if="action === 'forgot-password'">
                        <forgot-password></forgot-password>
                    </div>
                    <div v-else-if="action === 'reset-password'">
                        <reset-password></reset-password>
                    </div>
                    <div v-else>
                        <register></register>
                    </div>


            </v-col>

            <v-col md="6" class="d-none d-md-flex background-color justify-center align-center">
                <div class="d-flex justify-center align-center">
                    <img :src="loginInfoGraphic" width="100%"/>
                </div>
            </v-col>

        </v-row>
        </v-card>

    </v-container>
</template>
<script>
import Login from './Login.vue'
import Register from './Register.vue'
import ForgotPassword from './ForgotPassword.vue'
import ResetPassword from './ResetPassword.vue'
import loginInfoGraphic from "../../../../../public/images/authentication.svg";
export default {
    components: { Login, Register, ForgotPassword, ResetPassword },
    data() {
        return {
            loginInfoGraphic: loginInfoGraphic,
        };
    },
    computed: {
        //ISLOADING COMPUTED
        action() {
            return this.$route.params.action
        },
        isLoading: {
            get: function () {
                return this.$store.state.base.isLoading;
            },

            set: function (newVal) {
                return newVal;
            },
        },
    },
};
</script>
<style scoped>
.container-height {
    height: 90vh;
}


.background-color {
    background-color: #21c65e;
}

::v-deep .v-btn {
    padding-left: 12px;
    padding-right: 12px;
    width: 100%;
}
</style>
