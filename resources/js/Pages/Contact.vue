<template>
    <Head title="Contact Us" />

    <div>
        <section class="page-title" style="margin-top: 6rem">
            <div class="auto-container">
                <div class="title-outer">
                    <h1>Contact {{ app.name }}</h1>
                    <ul class="page-breadcrumb">
                        <li><Link :href="route('home')">Home</Link></li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="about-section-three">
            <div class="auto-container text-center">
                <div class="row">
                    <div class="contact-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <span class="icon"><img src="images/icons/placeholder.svg" alt=""></span>
                            <h4>Address</h4>
                            <p>25 SE 2nd Ave Ste 550 PMB 433<br> Miami, FL 33131</p>
                        </div>
                    </div>
                    <div class="contact-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <span class="icon"><img src="images/icons/smartphone.svg" alt=""></span>
                            <h4>Call Us</h4>
                            <p><a :href="`tel:`+app.phone" class="phone">{{ app.phone }}</a></p>
                        </div>
                    </div>
                    <div class="contact-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <span class="icon"><img src="images/icons/letter.svg" alt=""></span>
                            <h4>Email Us</h4>
                            <p><a :href="`mailto:`+app.email">{{ app.email }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="subscribe-section-two">
            <div class="background-image" style="background-image: url(images/background/5.png);"></div>
            <div class="auto-container wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                <div class="sec-title text-center light">
                    <h2>Subscribe to Our Newsletter</h2>
                    <div class="text">Get access to helpful tips and notifications to new job offers before the rest when your subscribed to our newsletter.</div>
                </div>

                <div class="subscribe-form">
                    <form method="post" @submit.prevent>
                        <div class="form-group">
                            <div class="response"></div>
                        </div>
                        <div class="form-group">
                            <input type="email" v-model="email" class="email" placeholder="Your e-mail" required>
                            <button type="button" id="subscribe-newslatters" class="theme-btn btn-style-one" @click="submitNewsletter">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import {Head, Link, router} from "@inertiajs/vue3";
import {ref} from "vue";
import {useToast} from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
const $toast = useToast();

const props = defineProps({
    app: Object,
})

const email = ref()

const submitNewsletter = () => {
    console.log('Clicked.');
    router.post(route('subscribeToNewsletter'), {
        email: email.value,
    }, {
        onSuccess: () => {
            email.value = null;
            $toast.success("You have successfully subscribed to the My USA Career Newsletter!");
        },
        onError: () => {
            $toast.error("Please enter a valid email to subscribe!");
        }
    })
}
</script>

<style scoped>

</style>
