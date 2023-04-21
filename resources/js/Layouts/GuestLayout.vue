<template>
    <Head :title="title" />

    <header class="main-header">
        <div class="container-fluid">
            <!-- Main box -->
            <div class="main-box">
                <!--Nav Outer -->
                <div class="nav-outer">
                    <div class="logo-box">
                        <div class="logo"><a :href="route('home')"><img src="images/logo-usacareer.png" class="w-50" alt="My USA Career"></a></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Header -->
        <div class="mobile-header">
            <div class="logo"><a :href="route('home')"><img src="images/logo-usacareer.png" alt="" title=""></a></div>
        </div>
    </header>

    <slot :app="app" />
</template>

<script setup>
const props = defineProps({
    title: String,
    app: Object,
});
</script>

<style scoped>

</style>
