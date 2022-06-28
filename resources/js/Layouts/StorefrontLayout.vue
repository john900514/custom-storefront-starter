<template>
    <div class="h-screen w-screen flex flex-col justify-center items-center">
        <slot name="content">
            <h1 class="text-[3em] text-primary">Helloooooooooooooo Default Layout</h1>
        </slot>
    </div>
</template>

<script>
export default {
    name: "StorefrontLayout"
}
</script>

<style scoped>

</style>
