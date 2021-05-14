<template>
    <div id="app">
        <nav-bar></nav-bar>
        <div class="container mt-2 p-2">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import NavBar from "./components/NavBar";

export default {
    components: {
        NavBar
    }
}
</script>
