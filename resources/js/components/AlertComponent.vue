<template>
    <div>
        <div v-show="!isLoading">
            <div v-show="message.status === 'Error'">
                    <v-alert
                        class="ma-4 pa-4"
                        text
                        prominent
                        dense
                        type="error"
                        icon="mdi-alert-circle" >
                            <h3 class="title font-weight-medium ma-0">{{ message.status }}</h3>
                            <h6 class="caption">{{ message.message.message }}</h6>
                            <div
                                v-for="(item, index) in message.message.errors"
                                :key="index.errors">
                                <ul v-for="error in item" :key="error.name" class="caption ma-0">
                                    {{ error}}
                                </ul>
                            </div>
                    </v-alert>
            </div>
            <div v-show="message.status === 'sww'">
                    <v-alert
                        class="ma-4 pa-4"
                        text
                        prominent
                        dense
                        type="error"
                        icon="mdi-alert-circle">
                            <h3 class="title font-weight-medium ma-0">Something went wrong!</h3>
                            <h6 class="overline">{{ message.message.message }}</h6>

                            <div class="caption" v-for="(item, index) in message.message.errors"
                                :key="index.errors">
                                {{ item }}
                                <ul v-for="(error, i) in item" :key="i" class="caption">
                                    {{
                                            i.item
                                    }}
                                </ul>
                            </div>
                    </v-alert>
            </div>
            <div v-show="message.status === 'Success'">
                    <v-alert
                        class="ma-4 pa-4"
                        text
                        dense
                        prominent
                        type="success"
                        icon="mdi-check-circle">
                            <h3 class="title font-weight-medium ma-0">{{ message.status }}</h3>
                                <div v-for="(item, i) in message.message" :key="i.sucess">
                                    <div class="caption" v-for="sucess in item"
                                        :key="sucess.success">
                                        {{ sucess }}
                                    </div>
                                </div>
                    </v-alert>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {};
    },
    computed: {
        message() {
            return this.$store.state.base.global;
        },
        isLoading() {
            return this.$store.state.base.isLoading;
        },
    },
};
</script>
