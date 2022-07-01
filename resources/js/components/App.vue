<template>
    <v-app>
        <router-view></router-view>
    </v-app>
</template>
<script>
export default {
    mounted() {
      this.$store.dispatch("getUserList")
    }
}
</script>

<style lang="scss">
    // @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto+Mono:wght@400;500;600;700&display=swap');

    * {
        font-family: 'Poppins', sans-serif;
        // font-family: 'Roboto Mono', monospace;
    }

</style>

