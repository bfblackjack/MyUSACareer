<script setup>
import {Head, Link, router} from '@inertiajs/vue3';

const props = defineProps({
    app: Object,
})

</script>

<template>
    <Head title="Welcome" />

    <section class="banner-section">
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-lg-7 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInUp" data-wow-delay="1000ms">
                        <div class="title-box">
                            <h3>The <span class="colored">right</span> career choices.<br> Tailored for you.</h3>
                            <div class="text">Find Career & Employment Opportunities with {{ app.name }}</div>
                        </div>

                        <!-- Job Search Form -->
                        <div class="job-search-form">
                            <form method="post" @submit.prevent>
                                <div class="row">
                                    <div class="form-group col-lg-5 col-md-12 col-sm-12">
                                        <span class="icon flaticon-search-1"></span>
                                        <input type="text" name="field_name" placeholder="Search job title or keyword">
                                    </div>
                                    <!-- Form Group -->
                                    <div class="form-group col-lg-4 col-md-12 col-sm-12 location">
                                        <span class="icon flaticon-map-locator"></span>
                                        <input type="text" name="field_name" placeholder="City or zip code">
                                    </div>
                                    <!-- Form Group -->
                                    <div class="form-group col-lg-3 col-md-12 col-sm-12 btn-box">
                                        <button type="submit" class="theme-btn btn-style-one" @click="router.visit(route('jobs'))"><span class="btn-title">Search Jobs</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Job Search Form -->

                        <!-- Popular Search -->
                        <div class="popular-searches">
                            <span class="title">Popular Searches:</span>
                            <a href="#">Work from home</a>,
                            <a href="#">Administration</a>,
                            <a href="#">Information Technology</a>,
                            <a href="#">Engineering</a>,
                            <a href="#">Senior Sales</a>,
                            <a href="#">Remote work</a>,
                            <a href="#">Software</a>
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
                    <div class="text">Highly rated, desirable jobs - right at your fingertips.</div>
                </div>
                <a href="#" class="link">Browse All <span class="icon fa fa-angle-right"></span></a>
            </div>

            <div class="outer-box wow fadeInUp">
                <!-- Job Block -->
                <div class="job-block-five">
                    <div class="inner-box">
                        <div class="content">
                            <span class="company-logo"><img src="images/resource/company-logo/4-1.png" alt=""></span>
                            <h4><a href="#">Software Engineer (Android), Libraries</a></h4>
                            <ul class="job-info">
                                <li><span class="icon flaticon-briefcase"></span> Segment</li>
                                <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                                <li><span class="icon flaticon-clock-3"></span> 11 hours ago</li>
                                <li><span class="icon flaticon-money"></span> $35k - $45k</li>
                            </ul>
                        </div>
                        <ul class="job-other-info">
                            <li class="time">Full Time</li>
                        </ul>
                        <a href="#" class="theme-btn btn-style-three">Apply Job</a>
                    </div>
                </div>

                <!-- Job Block -->
                <div class="job-block-five">
                    <div class="inner-box">
                        <div class="content">
                            <span class="company-logo"><img src="images/resource/company-logo/4-2.png" alt=""></span>
                            <h4><a href="#">Recruiting Coordinator</a></h4>
                            <ul class="job-info">
                                <li><span class="icon flaticon-briefcase"></span> Segment</li>
                                <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                                <li><span class="icon flaticon-clock-3"></span> 11 hours ago</li>
                                <li><span class="icon flaticon-money"></span> $35k - $45k</li>
                            </ul>
                        </div>
                        <ul class="job-other-info">
                            <li class="time">Full Time</li>
                        </ul>
                        <a href="#" class="theme-btn btn-style-three">Apply Job</a>
                    </div>
                </div>

                <!-- Job Block -->
                <div class="job-block-five">
                    <div class="inner-box">
                        <div class="content">
                            <span class="company-logo"><img src="images/resource/company-logo/4-3.png" alt=""></span>
                            <h4><a href="#">Product Manager, Studio</a></h4>
                            <ul class="job-info">
                                <li><span class="icon flaticon-briefcase"></span> Segment</li>
                                <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                                <li><span class="icon flaticon-clock-3"></span> 11 hours ago</li>
                                <li><span class="icon flaticon-money"></span> $35k - $45k</li>
                            </ul>
                        </div>
                        <ul class="job-other-info">
                            <li class="time">Full Time</li>
                        </ul>
                        <a href="#" class="theme-btn btn-style-three">Apply Job</a>
                    </div>
                </div>

                <!-- Job Block -->
                <div class="job-block-five">
                    <div class="inner-box">
                        <div class="content">
                            <span class="company-logo"><img src="images/resource/company-logo/4-4.png" alt=""></span>
                            <h4><a href="#">Senior Product Designer</a></h4>
                            <ul class="job-info">
                                <li><span class="icon flaticon-briefcase"></span> Segment</li>
                                <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                                <li><span class="icon flaticon-clock-3"></span> 11 hours ago</li>
                                <li><span class="icon flaticon-money"></span> $35k - $45k</li>
                            </ul>
                        </div>
                        <ul class="job-other-info">
                            <li class="time">Full Time</li>
                        </ul>
                        <a href="#" class="theme-btn btn-style-three">Apply Job</a>
                    </div>
                </div>

                <!-- Job Block -->
                <div class="job-block-five">
                    <div class="inner-box">
                        <div class="content">
                            <span class="company-logo"><img src="images/resource/company-logo/4-5.png" alt=""></span>
                            <h4><a href="#">Senior Full Stack Engineer, Creator Success</a></h4>
                            <ul class="job-info">
                                <li><span class="icon flaticon-briefcase"></span> Segment</li>
                                <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                                <li><span class="icon flaticon-clock-3"></span> 11 hours ago</li>
                                <li><span class="icon flaticon-money"></span> $35k - $45k</li>
                            </ul>
                        </div>
                        <ul class="job-other-info">
                            <li class="time">Full Time</li>
                        </ul>
                        <a href="#" class="theme-btn btn-style-three">Apply Job</a>
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
