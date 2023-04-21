<template>
    <Head title="About Us" />

    <div>
        <section class="page-title" style="margin-top: 6rem">
            <div class="auto-container">
                <div class="title-outer">
                    <h1>About {{ app.name }}</h1>
                    <ul class="page-breadcrumb">
                        <li><Link :href="route('home')">Home</Link></li>
                        <li>About Us</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="about-section-three">
            <div class="auto-container">
                <div class="text-box">
                    <h4>For Job Seekers</h4>
                    <p>{{ app.name }} is an innovative career finder website that provides job seekers with a plethora of valuable resources to help them find their dream job. The platform features a vast database of job listings from some of the most desirable companies in the United States. With just a few clicks, users can browse through the latest job openings, filter their search by industry, location, and experience level, and apply for the jobs that match their skills and qualifications. The website also allows job seekers to create a personalized profile, which can help them stand out to potential employers.</p>
                    <p>One of the unique features of {{ app.name }} is its AI-powered resume assessment tool. With this tool, job seekers can upload their resume, and the website's algorithm will analyze it and provide feedback on areas that need improvement. This can be a valuable tool for job seekers who want to ensure that their resume is optimized for the job market. Additionally, the platform's job fit scoring profile helps job seekers understand how well their skills and experience match with the job requirements of specific job listings. With this information, job seekers can focus their efforts on applying for jobs that they are more likely to get. Overall, {{ app.name }} is an excellent resource for job seekers who are serious about finding their next job.</p>
                </div>

                <div class="text-box">
                    <h4>For Employers</h4>
                    <p>{{ app.name }} is an excellent platform for employers who are looking to hire top talent. With its vast database of job seekers, the platform provides a valuable resource for companies to find the right candidates for their open positions. Employers can sign up for the platform and post their open positions, which will be displayed to job seekers who match their ideal profile.</p>
                    <p>One of the unique features of {{ app.name }} is its AI-powered job fit scoring profile. This feature allows employers to specify their ideal candidate's qualifications, skills, and experience. The platform's algorithm then matches these requirements with job seekers' profiles to provide a job fit score. This score can help employers quickly identify the candidates who are the best match for their open positions.</p>
                    <p>In addition to the job fit scoring profile, {{ app.name }} also provides employers with a suite of tools to manage their hiring process efficiently. Employers can review resumes, schedule interviews, and communicate with candidates all within the platform. This streamlines the hiring process and saves employers time and resources.</p>
                    <p>Overall, {{ app.name }} is an excellent resource for employers who are serious about finding top talent for their open positions. With its powerful tools and vast database of job seekers, the platform provides a valuable resource for companies looking to hire the best candidates.</p>
                </div>
            </div>
        </section>

        <section class="subscribe-section-two">
            <div class="background-image" style="background-image: url(images/background/5.png);"></div>
            <div class="auto-container wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                <div class="sec-title text-center light">
                    <h2>Subscribe Our Newsletter</h2>
                    <div class="text">Get access to helpful tips and notifications to new job offers before the rest when your subscribed to our newsletter.</div>
                </div>

                <div class="subscribe-form">
                    <form method="post" action="#">
                        <div class="form-group">
                            <div class="response"></div>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="email" value="" placeholder="Your e-mail" required="">
                            <button type="button" id="subscribe-newslatters" class="theme-btn btn-style-one">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import {Head, Link} from "@inertiajs/vue3";

const props = defineProps({
    app: Object,
})
</script>

<style scoped>

</style>
