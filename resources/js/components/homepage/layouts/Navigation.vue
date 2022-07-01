<template>
    <nav>
        <v-app-bar fixed elevation="6" elevate-on-scroll app color="green">
            <span class="d-block d-md-none">
                <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            </span>

            <v-toolbar-title>
                <a class="text-decoration-none grey--text text--lighten-5" href="#">
                    <span class="font-weight-medium">Digital Archive System</span>
                </a>
            </v-toolbar-title>

            <v-spacer></v-spacer>

            <!-- Menu lists -->
            <v-template class="d-none d-md-block">
                <ul class="d-inline-flex justify-center align-center" v-scroll-spy-active="{ class: 'active' }"
                    v-scroll-spy-link>
                    <li class="text-decoration-none ma-3 menu" :key="{ items, index }"
                        v-for="(items, index) in navLink">
                        <v-hover v-slot="{ hover }">
                            <a :class="hover ? 'grey--text text--darken-4' : 'grey--text text--lighten-5 menu-hover'"
                                role="button">
                                {{ items.title }}
                            </a>
                        </v-hover>
                    </li>

                    <li class="text-decoration-none ma-3 menu">
                        <div v-if="auth.authenticated">
                            <v-menu offset-y>
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn class="grey darken-4" v-bind="attrs" v-on="on" elevation="0">
                                        <span class="text-button grey--text text--lighten-5">Account</span>
                                    </v-btn>
                                </template>
                                <v-list>
                                    <v-list-item link @click="redirect()">
                                        <v-list-item-title
                                            v-if="auth.user.user_type === 'Staff' || auth.user.user_type === 'Chief'">
                                            <v-icon>mdi-view-dashboard-outline</v-icon>
                                            Dashboard
                                        </v-list-item-title>
                                        <v-list-item-title v-else>
                                            <v-icon>mdi-view-dashboard-outline</v-icon>
                                            Dashboard
                                        </v-list-item-title>
                                    </v-list-item>
                                    <v-list-item @click="logout">
                                        <v-list-item-title>
                                            <v-icon>mdi-logout</v-icon>
                                            Logout
                                        </v-list-item-title>
                                    </v-list-item>
                                </v-list>
                            </v-menu>
                        </div>

                        <div v-else>
                            <v-menu offset-y>
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn class="grey darken-4" large v-bind="attrs" v-on="on">
                                        <span class="text-button grey--text text--lighten-5">Account</span>
                                    </v-btn>
                                </template>
                                <v-list>
                                    <v-list-item v-for="(item, index) in forAuthenticate" :key="index" :to="item.path"
                                        link>
                                        <v-list-item-title>
                                            <v-icon small v-text="item.icon"></v-icon>
                                            {{ item.title }}
                                        </v-list-item-title>
                                    </v-list-item>
                                </v-list>
                            </v-menu>
                        </div>
                    </li>
                </ul>
            </v-template>

        </v-app-bar>

        <!-- side navigation activates when reach small device -->
        <v-navigation-drawer v-model="drawer" temporary fixed app>
            <v-list>
                <v-btn plain @click.stop="drawer = !drawer">
                    <v-icon>mdi-close</v-icon>
                    <span>Close</span>
                </v-btn>
            </v-list>
            <!-- menus -->
            <v-list nav>
                <v-list-item-group v-model="selectedItem" color="success" v-scroll-spy-active="{ class: 'active' }"
                    v-scroll-spy-link>
                    <v-list-item :key="(items, index)" v-for="(items, index) in navLink" link>
                        <v-list-item-icon class="ma-2">
                            <v-icon>{{ items.icon }}</v-icon>
                        </v-list-item-icon>

                        <v-list-item-content>
                            <v-list-item-title>{{ items.title }}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
            </v-list>

            <v-divider></v-divider>

            <div class="pa-2">
                <div v-if="auth.authenticated">
                    <v-menu offset-y>
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn block plain class="grey darken-4" v-bind="attrs" v-on="on">
                                <span class="text-button grey--text text--lighten-5">Account</span>
                            </v-btn>
                        </template>
                        <v-list nav>
                            <v-list-item link @click="redirect()">
                                <v-list-item-title
                                    v-if="auth.user.user_type === 'Staff' || auth.user.user_type === 'Chief'">
                                    <v-icon small>mdi-view-dashboard-outline</v-icon>
                                    Dashboard
                                </v-list-item-title>
                                <v-list-item-title v-else>
                                    <v-icon>mdi-account</v-icon>
                                    Dashboard
                                </v-list-item-title>
                            </v-list-item>
                            <v-list-item @click="logout">
                                <v-list-item-title>
                                    <v-icon small>mdi-logout</v-icon>
                                    Logout
                                </v-list-item-title>
                            </v-list-item>
                        </v-list>
                    </v-menu>
                </div>

                <div v-else>
                    <v-menu offset-y>
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn block plain class="grey darken-4" large v-bind="attrs" v-on="on">
                                <span class="text-button grey--text text--lighten-5">Account</span>
                            </v-btn>
                        </template>
                        <v-list>
                            <v-list-item-group>
                                <v-list-item v-for="(item, index) in forAuthenticate" :key="index" :to="item.path" link>
                                    <v-list-item-icon class="ma-2">
                                        <v-icon>{{ item.icon }}</v-icon>
                                    </v-list-item-icon>

                                    <v-list-item-content>
                                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list-item-group>
                        </v-list>
                    </v-menu>
                </div>
            </div>


        </v-navigation-drawer>
    </nav>




    <!-- <nav class="navbar navbar-expand-lg fixed-top green">
        <div class="container">
            <a class="navbar-brand text-decoration-none grey--text text--lighten-5" href="#">
                <span class="font-weight-bold">CMU Digital Archive System</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <v-icon>mdi-menu</v-icon>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0" v-scroll-spy-active="{ class: 'active' }" v-scroll-spy-link>
                    <li class="nav-item" :key="items" v-for="items in navLink">
                        <a class="nav-link grey--text text--lighten-5" role="button">{{ items }}</a>
                    </li>

                    <li class="nav-item">
                        <div v-if="auth.authenticated">
                            <v-menu offset-y>
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn class="grey darken-4" v-bind="attrs" v-on="on">
                                        <span class="text-button grey--text text--lighten-5">Account</span>
                                    </v-btn>
                                </template>
                                <v-list>
                                    <v-list-item link @click="redirect()">
                                        <v-list-item-title
                                            v-if="auth.user.user_type === 'Staff' || auth.user.user_type === 'Chief'">
                                            <v-icon small>mdi-view-dashboard-outline</v-icon>
                                            Dashboard
                                        </v-list-item-title>
                                        <v-list-item-title v-else>
                                            <v-icon small>mdi-account</v-icon>
                                            Profile
                                        </v-list-item-title>
                                    </v-list-item>
                                    <v-list-item @click="logout">
                                        <v-list-item-title>
                                            <v-icon small>mdi-logout</v-icon>
                                            Logout
                                        </v-list-item-title>
                                    </v-list-item>
                                </v-list>
                            </v-menu>
                        </div>

                        <div v-else>
                            <v-menu offset-y>
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn class="grey darken-4" large v-bind="attrs" v-on="on">
                                        <span class="text-button grey--text text--lighten-5">Account</span>
                                    </v-btn>
                                </template>
                                <v-list>
                                    <v-list-item v-for="(item, index) in forAuthenticate" :key="index" :to="item.path"
                                        link>
                                        <v-list-item-title>
                                            <v-icon small v-text="item.icon"></v-icon>
                                            {{ item.title }}
                                        </v-list-item-title>
                                    </v-list-item>
                                </v-list>
                            </v-menu>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav> -->
    <!-- Navbar
    <nav
        id="navbar-main"
        class="navbar fixed-top navbar-expand-lg navbar-dark py-2 navbg"
        :class="{ scrolled: scrollPosition > 400 }
    ">
        <v-overlay :value="isLoading">
            <v-progress-circular indeterminate size="64"></v-progress-circular>
        </v-overlay>
        <div class="container" id="navbar">
            <a class="navbar-brand mr-lg-5" href="">
                CMU Archive System
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global"
                aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbar_global">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-10 collapse-brand d-flex justify-start align-center">
                            <a href="#" class="text-h6">
                                CMU Archive System
                            </a>
                        </div>

                        <div class="col-2 collapse-close d-flex justify-center align-center">
                            <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div>
                    <ul class="nav navbar-nav navbar-nav-hover float-start float-md-right" v-scroll-spy-active="{ class: 'active' }"
                        v-scroll-spy-link>
                        <li class="nav-item" :key="items" v-for="items in navLink">
                            <a class="nav-link" role="button">
                                <span class="nav-link-inner--text">{{ items }}</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <div v-if="auth.authenticated">
                                <ul class="navbar-nav align-items-lg-center mt-2">
                                    <li class="nav-item text-uppercase">
                                        <div class="text-center">
                                            <v-menu offset-y>
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-btn dark v-bind="attrs" v-on="on">
                                                        <v-icon small>mdi-account</v-icon>
                                                        Account
                                                    </v-btn>
                                                </template>
                                                <v-list>

                                                    <v-list-item link @click="redirect()">
                                                        <v-list-item-title
                                                            v-if="auth.user.user_type === 'Staff' || auth.user.user_type === 'Chief'">
                                                            <v-icon small>mdi-view-dashboard-outline</v-icon>
                                                            Dashboard
                                                        </v-list-item-title>
                                                        <v-list-item-title v-else>
                                                            <v-icon small>mdi-account</v-icon>
                                                            Profile
                                                        </v-list-item-title>

                                                    </v-list-item>
                                                    <v-list-item @click="logout">
                                                        <v-list-item-title>
                                                            <v-icon small>mdi-logout</v-icon>
                                                            Logout
                                                        </v-list-item-title>
                                                    </v-list-item>
                                                </v-list>
                                            </v-menu>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div v-else>
                                <ul class="navbar-nav align-items-lg-center">
                                    <li class="nav-item">
                                        <div class="text-center">
                                            <v-menu offset-y>
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-btn dark v-bind="attrs" v-on="on">
                                                        <v-icon small>mdi-account</v-icon>
                                                        Account
                                                    </v-btn>
                                                </template>
                                                <v-list>
                                                    <v-list-item v-for="(item, index) in forAuthenticate" :key="index"
                                                        :to="item.path" link>
                                                        <v-list-item-title>
                                                            <v-icon small v-text="item.icon"></v-icon>
                                                            {{ item.title }}
                                                        </v-list-item-title>
                                                    </v-list-item>
                                                </v-list>
                                            </v-menu>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    End Navbar -->
</template>
<script>
export default {
    data() {
        return {
            //toogle drawer sidebar
            drawer: false,
            group: null,
            selectedItem: 0,

            scrollPosition: null,
            scrolled: false,
            navLink: [
                {
                    title: "Home",
                    icon: "mdi-home-variant",
                },
                {
                    title: "About",
                    icon: "mdi-information",
                },
                {
                    title: "FAQs",
                    icon: "mdi-help-circle",
                },
                {
                    title: "Contact",
                    icon: "mdi-cellphone",
                },
            ],
            forAuthenticate: [
                {
                    title: "Login",
                    icon: "mdi-login-variant",
                    path: "/authentication/login",
                },
                {
                    title: "Register",
                    icon: "mdi-account-box-multiple",
                    path: "/authentication/register",
                },
            ],
            forAuthenticated: [
                {
                    title: "Dashboard",
                    icon: "mdi-view-dashboard-outline",
                    path: this.$store.state.auth.user.user_type,
                },
                {
                    title: "Logout",
                    icon: "mdi-logout",
                },
            ],
        };
    },
    methods: {
        //Update Navigation when scroll
        updateScroll() {
            this.scrollPosition = window.scrollY;
            if (window.scrollY > 700) {
                this.scrolled = true;
            }
        },

        async logout() {
            await axios
                .post("/api/logout")
                .then((response) => {
                    this.$store.dispatch("userLogout");
                    this.$router.push("/").catch((error) => {
                        if (error.name != "NavigationDuplicated") {
                            throw error;
                        }
                    });
                })
                .catch((err) => {
                    console.log(err.response.data);
                })
                .finally(function () { });
        },
        redirect() {
            console.log(this.auth.user.user_type);
            if (
                this.auth.user.user_type === "Chief" ||
                this.auth.user.user_type === "Staff"
            ) {
                this.$router.push({
                    name: "systemdashboard",
                });
            } else {
                this.$router.push({
                    name: "clientsearch",
                });
            }
        },
    },
    computed: {
        auth() {
            return this.$store.state.auth;
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
        redirectLogin() {
            return {
                name: "authentication",
                params: { action: "login" },
            };
        },
        redirectRegister() {
            return {
                name: "authentication",
                params: { action: "register" },
            };
        },
    },

    mounted() {
        window.addEventListener("scroll", this.updateScroll);
    },
};
</script>
<style scoped>
#navbar {
    height: 50px;
}

/* .navbar {
        background: #16A34A !important;
    } */

.navbg .scrolled {
    background-color: #16a34a !important;
    transition: ease-in-out 0.6s;
}

.menu {
    list-style: none;
}
</style>
