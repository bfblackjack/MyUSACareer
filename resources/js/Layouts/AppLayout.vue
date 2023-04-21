<script setup>
import {onBeforeMount, onMounted, ref} from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';
import logo from "../../../public/images/logo-usacareer.png"
import { Slide } from 'vue3-burger-menu'
import moment from "moment";

const props = defineProps({
    title: String,
    app: Object,
});

const mobileNavMenuShown = ref(false);
const toggleMobileNavMenu = () => {
    console.log('clicked', mobileNavMenuShown.value);

    mobileNavMenuShown.value = true;
}

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title" />

        <header class="main-header">
            <!-- Main box -->
            <div class="main-box">
                <!--Nav Outer -->
                <div class="nav-outer">
                    <div class="logo-box">
                        <div class="logo"><Link :href="route('home')"><img :src="logo" alt="My USA Career Logo" style="max-height: 4rem;"></Link></div>
                    </div>

                    <nav class="nav main-menu">
                        <ul class="navigation" id="navbar">
                            <li :class="{
                                current: route().current('home')
                            }">
                                <Link :href="route('home')"><span>Home</span></Link>
                            </li>
                            <li>
                                <Link :href="route('jobs')"><span>Jobs</span></Link>
                            </li>
                            <li :class="{
                                current: route().current('about')
                            }">
                                <Link :href="route('about')"><span>About Us</span></Link>
                            </li>
                            <li :class="{
                                current: route().current('contact')
                            }">
                                <Link :href="route('contact')"><span>Contact Us</span></Link>
                            </li>
                        </ul>
                    </nav>
                    <!-- Main Menu End-->
                </div>

                <div class="outer-box">
                    <!-- Add Listing -->
                    <Link :href="route('login')" class="upload-cv"> Upload Resume</Link>
                    <!-- Login/Register -->
                    <div class="btn-box">
                        <Link :href="route('login')" class="theme-btn btn-style-three call-modal">Login</Link>
                        <Link :href="route('login')" class="theme-btn btn-style-one">Post Job</Link>
                    </div>
                </div>
            </div>

            <!-- Mobile Header -->
            <div class="mobile-header">
                <div class="logo"><Link :href="route('home')"><img :src="logo" alt="MyUSACareer Logo"></Link></div>

                <!--Nav Box-->
                <div class="nav-outer clearfix">
                    <div class="outer-box">
                        <!-- Login/Register -->
                        <div class="login-box">
                            <Link :href="route('login')" class="call-modal"><span class="icon-user"></span></Link>
                        </div>

                        <button class="mobile-nav-toggler" @click="toggleMobileNavMenu"><span class="flaticon-menu-1"></span></button>
                    </div>
                </div>
            </div>

            <!-- Mobile Nav -->
            <Slide :isOpen="mobileNavMenuShown" @closeMenu="mobileNavMenuShown = false" :burgerIcon="false" right>
                <Link id="home" :href="route('home')">
                    <span>Home</span>
                </Link>

                <Link id="jobs" :href="route('jobs')">
                    <span>Jobs</span>
                </Link>

                <Link id="about" :href="route('about')">
                    <span>About Us</span>
                </Link>

                <Link id="contact" :href="route('contact')">
                    <span>Contact Us</span>
                </Link>

                <Link id="upload" :href="route('login')" class="theme-btn btn-style-one">
                    <span>Upload Resume</span>
                </Link>

                <li class="mm-add-listing">
                    <span>
                      <span class="contact-info">
                        <span class="phone-num"><span>Call us</span><a :href="`tel:`+app.phone">{{ app.phone }}</a></span>
                        <span class="address">25 SE 2nd Ave Ste 550 PMB 433<br>Miami, FL 33131</span>
                        <a :href="`mailto:`+app.email" class="email">{{ app.email }}</a>
                      </span>
                    </span>
                </li>
            </Slide>
        </header>

        <Banner />

        <slot :app="app" />

        <footer class="main-footer">
            <div class="auto-container">
                <!--Widgets Section-->
                <div class="widgets-section wow fadeInUp">
                    <div class="row">
                        <div class="big-column col-xl-4 col-lg-3 col-md-12">
                            <div class="footer-column about-widget">
                                <div class="logo"><Link :href="route('home')"><img :src="logo" alt="Logo"></Link></div>
                                <p class="phone-num"><span>Call us </span><a :href="`tel:`+app.phone">{{ app.phone }}</a></p>
                                <p class="address">25 SE 2nd Ave Ste 550 PMB 433<br> Miami, FL 33131<br><a :href="`mailto:`+app.email" class="email">{{ app.email }}</a></p>
                            </div>
                        </div>

                        <div class="big-column col-xl-8 col-lg-9 col-md-12">
                            <div class="row">
                                <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                                    <div class="footer-widget links-widget">
                                        <h4 class="widget-title">For Candidates</h4>
                                        <div class="widget-content">
                                            <ul class="list">
                                                <li><Link :href="route('jobs')">Browse Jobs</Link></li>
                                                <li><Link :href="route('login')">Candidate Dashboard</Link></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>


                                <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                                    <div class="footer-widget links-widget">
                                        <h4 class="widget-title">For Employers</h4>
                                        <div class="widget-content">
                                            <ul class="list">
                                                <li><Link :href="route('login')">Employer Dashboard</Link></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                                    <div class="footer-widget links-widget">
                                        <h4 class="widget-title">Directory</h4>
                                        <div class="widget-content">
                                            <ul class="list">
                                                <li><Link :href="route('about')">About</Link></li>
                                                <li><Link :href="route('contact')">Contact</Link></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>


                                <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                                    <div class="footer-widget links-widget">
                                        <h4 class="widget-title">Helpful Resources</h4>
                                        <div class="widget-content">
                                            <ul class="list">
                                                <li><Link :href="route('privacy-policy')">Privacy Policy</Link></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Bottom-->
            <div class="footer-bottom">
                <div class="auto-container">
                    <div class="outer-box">
                        <div class="copyright-text">© {{ moment().format('Y') }} <Link :href="route('home')">{{ app.name }}</Link>. All Right Reserved.</div>
                    </div>
                </div>
            </div>

            <!-- Scroll To Top -->
            <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>
        </footer>
    </div>
</template>
