<template>
    <div class="w-full h-full" id="colorfulContent">
        <div class="h-screen w-screen border-t-base-100 border-t bg-secondary bg-center bg-cover bg-no-repeat" id="header">
            <slot name="header"></slot>
        </div>

        <div id="angleBolt">
            <div class="h-screen w-screen border-t-base-100 border-t" id="slide1">
                <slot name="slide1"></slot>
            </div>

            <div class="h-screen w-screen border-t-base-100 border-t" id="slide2">
                <slot name="slide2"></slot>
            </div>

            <div class="h-screen w-screen border-t-base-200 border-t"  id="slide3">
                <slot name="slide3"></slot>
            </div>
        </div>


        <div class="h-screen w-screen border-t-base-100 border-t bg-gradient-to-b bg-primary bg-right bg-no-repeat" id="slide4">
            <slot name="slide4"></slot>
        </div>

        <div class="h-screen w-screen border-t-base-100 border-t bg-gradient-to-b bg-primary bg-right bg-no-repeat" id="slide5">
            <slot name="slide5"></slot>
        </div>

        <div class="h-[15rem] w-screen border-t-base-200 border-t bg-black"  id="footer">
            <slot name="footer"></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "LandingPageLayout"
}
</script>

<style scoped>
    #header {
        background-image:
            linear-gradient(rgba(65, 107, 169, 0.1), rgba(65, 107, 169, 0.1), rgba(41, 223, 244, 0.1)),
            url('/img/landing/header-background.png');
    }

    #angleBolt {
        /* bg-[url('/img/landing/angle.png')] bg-gradient-to-b from-secondary via-secondary to-accent */
        background-image:
            linear-gradient(
                rgba(41, 223, 244, 0.9),
                rgba(41, 223, 244, 0.7),
                rgba(185,159,224, 0.7),
                rgba(65, 107, 169, 1)),
            url('/img/landing/angle.png');
    }

    #slide4 {
        background-image:
            linear-gradient(
                rgba(65, 107, 169, 1),
                rgba(41, 223, 244, 0.9),
                rgba(41, 223, 244, 0.9)),
            url('/img/landing/curve.png')
    ;
    }

    #slide5 {
        background-image:
            linear-gradient(
                rgba(41, 223, 244, 0.9),
                rgba(65, 107, 169, 1),
                rgba(65, 107, 169, 1),
                rgba(185,159,224, 0.4))
            ;
    }
</style>
