<template>
    <div>
        <div class="section section-hero section-shaped">
            <div class="page-header">
                <div class="container shape-container align-items-center py-lg">
                    <div class="row">

                        <div class="col-md-8 mt-15">
                            <div class="col-lg-12">
                                <div data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
                                    <h6 class="text-overline title">Central Mindanao University</h6>
                                </div>

                                <div data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine">
                                    <h3 class="display-6 subtitle">Digital Archiving System</h3>
                                </div>
                                <div data-aos="fade-up" data-aos-duration="3000">
                                    <p class="
                                font-weight-normal
                                text-black
                                animate__animated animate__fadeIn
                            ">
                                        <span class="sub-text">Students</span>
                                        ,<span class="sub-text">Faculty</span> and
                                        <span class="sub-text">Alumnus</span>
                                        can now access documents through this online platform.
                                    </p>

                                    <v-list dense>
                                        <v-list-item v-for="(item, i) in items" :key="i">

                                            <v-list-item-icon class="mt-3">
                                                <v-icon v-text="item.icon" color="success"></v-icon>
                                            </v-list-item-icon>

                                            <v-list-item-content>
                                                <v-list-item-title class="mt-n2" v-text="item.text"></v-list-item-title>
                                            </v-list-item-content>

                                        </v-list-item>
                                    </v-list>


                                </div>

                                <div class="mt-10" data-aos="fade-up" data-aos-duration="2000">

                                    <v-btn elevation="10" large dark class="text-decoration">
                                        <router-link :to="redirectLogin">
                                            LOGIN
                                        </router-link>
                                    </v-btn>

                                    <v-btn class="ml-4 text-decoration" elevation="10" large outlined >
                                        <router-link :to="redirectRegister">
                                            REGISTER
                                        </router-link>
                                    </v-btn>

                                </div>
                            </div>


                        </div>

                        <div class="col-md-4">
                            <img :src="personalfiles" height="85%" />
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.home {
    background-image: url("../../../../../public/assets/img/banner2.jpg");
    background-repeat: no-repeat;
    background-size: cover;
}

.sub-text {
    color: #21c65e;
}

.btn-bg-green {
    background-color: #21c65e;
}

.btn-bg-yellow {
    background-color: #fecf14;
}

.bg-green {
    background: linear-gradient(150deg, #2dce89 15%, #21c65e 70%, #21c65e 94%);
    opacity: 0.3;
}

.bg-yellow {
    background: linear-gradient(150deg, #d4eb0d 15%, #ddbd0a 70%, #ddc409 94%);
    opacity: 0.3;
}

.title {
    color: #16A34A;
    text-transform: uppercase;
}

.subtitle {
    color: #21c65e;
    text-transform: uppercase;
    font-size: 3rem;
    font-weight: bold;
    color: #000000;
}

.office-img {
    width: 450px;
    height: 250px;
}

.personalfiles {
    width: 100%;
    height: 80%;
}
.text-decoration a {
    text-decoration: none;
    color: inherit;
}
</style>

<script>

import Login from "./../account/Login.vue";
import Register from "./../account/Register.vue";
import office from "../../../../../public/assets/img/office/office.png";
import personalfiles from "../../../../../public/images/personalfiles.svg";
export default {
    components: {
        Login,
        Register,
    },
    data() {
        return {
            officeicon: office,
            personalfiles: personalfiles,
            selectedItem: 1,
            lockSelection: true,
            inactiveClass: true,
            items: [
                {
                    text: "Students can request document related to their studies.",
                    icon: "mdi-circle-double",
                },
                {
                    text: "Available documents for research and extension.",
                    icon: "mdi-circle-double",
                },
                {
                    text: "Lorem ipsum dolor sit amet, consectetur adipiscing elit",
                    icon: "mdi-circle-double",
                },
            ],
            /* items: [
              { text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', icon: 'mdi-circle-double',disabled:'disabled'},
              { text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', icon: 'mdi-circle-double',disabled:'disabled'},
              { text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', icon: 'mdi-circle-double',disabled:'disabled'},
            ], */
        };
    },
    computed: {
        auth() {
            return this.$store.state.auth;
        },
        redirectLogin() {
            return {
                name: "authentication",
                params: { action: 'login' }
            }
        },
        redirectRegister() {
            return {
                name: "authentication",
                params: { action: 'register' }
            }
        },
    },
};
</script>

