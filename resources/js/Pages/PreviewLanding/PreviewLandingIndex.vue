<template>
    <landing-page-layout>
        <template #header>
            <div class="w-full h-full flex justify-center items-center text-center ">
                <div>
                    <h1 class="text-secondary-50 opacity-50 text-9xl font-bold"> Great News for anyone with a face.</h1>
                    <p class="text-white text-2xl font-bold">Do you love your face? Do you want to love your face? Either/or, whichever/whatever, Lave provides a skincare revolution for your face in just 3 minutes a day.</p>
                    <landing-modal id="buyNow" @clicked="trackButtonClick('header')"></landing-modal>
                </div>
            </div>
        </template>
        <template #slide1>
            <div class="w-full h-full flex justify-center items-center text-center">
                <div>
                    <h1 class="text-secondary-50 opacity-45"> Spray, then go contemplate wormholes.</h1>
                    <p class="text-primary-800">Let's embrace life. Let's obsess over love, or peace. So let's make our facecare a spray-n-go kinda thing. Lave's super-efficient daily face regiment leaves your skin healthy and revitalized.</p>
                    <h2 class="text-secondary-50 opacity-75"> Buy now, live more. </h2>
                </div>

            </div>
        </template>
        <template #slide2>
            <div class="w-full h-full flex justify-center items-center text-center">
                <div>
                    <h2 class="text-secondary-50 opacity-45"> Face Refresh Serum.</h2>
                    <p class="text-primary-800">Magic in liquid form. Spray on a clean, dry face, let dry. Then, imagine what you can do with the 5,475 minutes in a year we just saved you in skin care.</p>
                    <h3 class="text-secondary-50 opacity-75"> You're Welcome. </h3>
                    <landing-modal id="buyNow" @clicked="trackButtonClick('slide2')"></landing-modal>
                </div>
            </div>
        </template>
        <template #slide3>
            <div class="w-full h-full flex justify-center items-center text-center">
                <div>
                    <h2 class="text-secondary-50 opacity-45"> Face Therapy Moisturizer.</h2>
                    <p class="text-primary-800">Side Effects: contentment, fulfillment, gratification. Apply to face and neck, let dry.</p>
                    <landing-modal id="buyNow" @clicked="trackButtonClick('slide3')"></landing-modal>
                    <p class="text-primary-800">Then, suddenly learn how to graciously accept compliments.</p>
                    <h3 class="text-secondary-50 opacity-75"> about your glorious skin. </h3>

                </div>
            </div>
        </template>
        <template #slide4>
            <div class="w-full h-full flex justify-center items-center text-center">
                <div>
                    <h2 class="text-secondary-50 opacity-45"> Dom is the non-expert's skin-expert.</h2>
                    <p class="text-primary-800">Don Benjamin will never win a Nobel Prize in face sciences. But as a model and actor he's tried a jillion serums and moisturizers. And he will never trust his money-maker to any product that doesn't come with a Lave logo.</p>
                </div>
            </div>
        </template>
        <template #slide5>
            <div class="w-full h-full flex justify-center items-center text-center">
                <div>
                    <h1 class="text-secondary-50 opacity-45"> Just 3 minutes.</h1>
                    <h3 class="text-secondary-50 opacity-45"> That's merely.</h3>
                    <h1 class="text-secondary-50 opacity-45"> 1/480<sup>th</sup></h1>
                    <h3 class="text-secondary-50 opacity-45"> of a day.</h3>
                    <p class="text-primary-800">We've been stalking you, and TBH your life is pretty frenetic. But even busy you has 3 minutes everyday to devote to improving your face. And therefore, your life.</p>
                </div>
            </div>
        </template>
        <template #footer>
            <div class="w-full h-full flex justify-center items-center text-center">
                Lave
            </div>
        </template>
    </landing-page-layout>
</template>

<script>
import LandingPageLayout from "@/Layouts/LandingPageLayout";
import LandingModal from "@/Pages/PreviewLanding/Screens/LandingModal";

export default {
    name: "PreviewLandingIndex",
    components: {
        LandingModal,
        LandingPageLayout
    },
    methods: {
        trackButtonClick(fromWhere) {
            if(analytics !== undefined) {
                analytics.track("Visitor Started Lead Capture", {
                    location: "landing_page",
                    button: fromWhere
                });
            }
            else {
                alert("Segment is not here.")
            }
        }
    }
}
</script>

<style scoped>

</style>
