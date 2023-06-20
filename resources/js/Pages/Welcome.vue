<script setup>
import {Head, Link, router} from '@inertiajs/vue3';
import moment from "moment";

const props = defineProps({
    app: Object,
    jobs: Object,
})

</script>

<template>
    <Head title="Career Search & Career Advice with AI" />

    <section class="banner-section">
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-lg-7 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInUp" data-wow-delay="1000ms">
                        <div class="title-box">
                            <h3>The <span class="colored">right</span> career choices.<br> Tailored for you.</h3>
                            <div class="text">Find Career & Employment Opportunities with {{ app.name }}</div>
                        </div>

<!--                        &lt;!&ndash; Job Search Form &ndash;&gt;-->
<!--                        <div class="job-search-form">-->
<!--                            <form method="post" @submit.prevent>-->
<!--                                <div class="row">-->
<!--                                    <div class="form-group col-lg-5 col-md-12 col-sm-12">-->
<!--                                        <span class="icon flaticon-search-1"></span>-->
<!--                                        <input type="text" name="field_name" placeholder="Search job title or keyword">-->
<!--                                    </div>-->
<!--                                    &lt;!&ndash; Form Group &ndash;&gt;-->
<!--                                    <div class="form-group col-lg-4 col-md-12 col-sm-12 location">-->
<!--                                        <span class="icon flaticon-map-locator"></span>-->
<!--                                        <input type="text" name="field_name" placeholder="City or zip code">-->
<!--                                    </div>-->
<!--                                    &lt;!&ndash; Form Group &ndash;&gt;-->
<!--                                    <div class="form-group col-lg-3 col-md-12 col-sm-12 btn-box">-->
<!--                                        <button type="submit" class="theme-btn btn-style-one" @click="router.visit(route('jobs'))"><span class="btn-title">Search Jobs</span></button>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </form>-->
<!--                        </div>-->
<!--                        &lt;!&ndash; Job Search Form &ndash;&gt;-->

                        <!-- Popular Search -->
                        <div class="popular-searches">
                            <span class="title">Popular Searches:</span>
                            <a :href="route('jobs', {job: 'work from home'})">Work from home</a>,
                            <a :href="route('jobs', {job: 'administration'})">Administration</a>,
                            <a :href="route('jobs', {job: 'information technology'})">Information Technology</a>,
                            <a :href="route('jobs', {job: 'engineering'})">Engineering</a>,
                            <a :href="route('jobs', {job: 'senior sales'})">Senior Sales</a>,
                            <a :href="route('jobs', {job: 'remote work'})">Remote work</a>,
                            <a :href="route('jobs', {job: 'software'})">Software</a>
                        </div>
                        <!-- End Popular Search -->
                    </div>
                </div>

                <div class="image-column col-lg-5 col-md-12">
                    <div class="image-box">
                        <figure class="main-image wow fadeIn" data-wow-delay="500ms"><img src="images/resource/banner-img-1.png" alt=""></figure>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="work-section">
        <div class="auto-container">
            <div class="sec-title text-center">
                <h2>Why MyUSACareer?</h2>
                <div class="text">Find a job anywhere, anytime. Jumpstart your career with a tailored resume and boosted job options!</div>
            </div>

            <div class="row wow fadeInUp">
                <!-- Work Block -->
                <div class="work-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <figure class="image"><img src="/images/resource/work-1.png" alt=""></figure>
                        <h5>AI Resume Assessments</h5>
                        <p>Use our artificial intelligent resume assessment tool to optimize your resume for potential employers.</p>
                    </div>
                </div>

                <!-- Work Block -->
                <div class="work-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <figure class="image"><img src="/images/resource/work-2.png" alt=""></figure>
                        <h5>Job Fit Scoring</h5>
                        <p>Create a profile and we'll match you to potential job matches</p>
                    </div>
                </div>

                <!-- Work Block -->
                <div class="work-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <figure class="image"><img src="/images/resource/work-3.png" alt=""></figure>
                        <h5>Thousands of Listings</h5>
                        <p>We guarantee you'll find your next career at {{ app.name }}!</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="job-section-five">
        <div class="auto-container">
            <div class="sec-title-outer">
                <div class="sec-title">
                    <h2>Featured Jobs</h2>
                    <div class="text">Highly rated, remote jobs - work from home!.</div>
                </div>
                <a :href="route('jobs')" class="link">Browse All <span class="icon fa fa-angle-right"></span></a>
            </div>

            <div class="outer-box wow fadeInUp">
                <div class="job-block-five" v-for="(job, index) in jobs.jobs">
                    <div class="inner-box">
                        <div class="content">
                            <span class="company-logo"><img :src="job.logo_url" alt=""></span>
                            <h4><a :href="job.url">{{ job.title }}</a></h4>
                            <ul class="job-info">
                                <li><span class="icon flaticon-briefcase"></span> {{ job.major_category0 }}</li>
                                <li><span class="icon flaticon-map-locator"></span> {{ job.city[0] }}</li>
                                <li><span class="icon flaticon-clock-3"></span> {{ moment(job.date).format('MM/DD/YYYY') }}</li>
                            </ul>
                        </div>
                        <ul class="job-other-info">
                            <li class="time">{{ job.worktype_details[0].label }}</li>
                        </ul>
                        <a :href="job.url" class="theme-btn btn-style-three">View Job</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="call-to-action-two" style="background-image: url(/images/background/1.jpg);">
        <div class="auto-container wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
            <div class="sec-title light text-center">
                <h2>First-in-class artificial intelligence for job seeking candidates.</h2>
                <div class="text">Build your career with the help of {{ app.name }}.</div>
            </div>

            <div class="btn-box">
                <Link :href="route('jobs')" class="theme-btn btn-style-one">Search Jobs</Link>
                <Link :href="route('login')" class="theme-btn btn-style-five">Upload Resume</Link>
            </div>
        </div>
    </section>

</template>

<style>

</style>
