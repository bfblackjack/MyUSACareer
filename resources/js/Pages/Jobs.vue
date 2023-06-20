<template>
    <Head title="Jobs" />

    <section class="ls-section style-twoq" style="margin-top: 3.8rem;">
        <div class="filters-backdrop"></div>

        <div class="row no-gutters">
            <!-- Filters Column -->
            <div class="filters-column col-xl-3 col-lg-4 col-md-12 col-sm-12">
                <div class="inner-column">
                    <div class="filters-outer">
                        <button type="button" class="theme-btn close-filters">X</button>

                        <!-- Filter Block -->
                        <div class="filter-block">
                            <h4>Search by job/keyword</h4>
                            <div class="form-group">
                                <input type="text" name="listing-search" placeholder="ie. Manufacturing" v-model="searchForm.job">
                                <span class="icon flaticon-search-3"></span>
                            </div>
                        </div>

                        <!-- Filter Block -->
                        <div class="filter-block">
                            <h4>Location</h4>
                            <div class="form-group">
                                <input type="text" name="listing-search" placeholder="City, zip code, or remote" v-model="searchForm.location">
                                <span class="icon flaticon-map-locator"></span>
                            </div>
                        </div>

                        <!-- Filter Block -->
                        <div class="filter-block">
                            <h4>Category</h4>
                            <div class="form-group">
                                <select class="chosen-select" v-model="searchForm.type">
                                    <option v-for="(option, index) in categories" :selected="searchForm.type === option">{{ option }}</option>
                                </select>
                                <span class="icon flaticon-briefcase"></span>
                            </div>
                        </div>

                        <!-- Switchbox Outer -->
                        <div class="switchbox-outer">
                            <h4>Job Type</h4>
                            <ul class="switchbox">
                                <li v-for="(item, index) in filters.type">
                                    <label class="switch">
                                        <input type="radio" name="type" :value="item" @change="detectChangeOfFilter('type', item)" v-model="props.employment_type">
                                        <span class="slider round"></span>
                                        <span class="title">{{ item }}</span>
                                    </label>
                                </li>
                            </ul>
                        </div>

                        <!-- Checkboxes Ouer -->
                        <div class="switchbox-outer">
                            <h4>Experience Level</h4>
                            <ul class="switchbox">
                                <li v-for="(item, index) in filters.experience">
                                    <label class="switch">
                                        <input type="radio" name="experience" :value="item" @change="detectChangeOfFilter('experience', item)" v-model="props.experience">
                                        <span class="slider round"></span>
                                        <span class="title">{{ item }}</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Column -->
            <div class="content-column col-xl-9 col-lg-8 col-md-12 col-sm-12">
                <div class="ls-outer">
                    <button type="button" class="theme-btn btn-style-two toggle-filters">Show Filters</button>

                    <div class="row">
                        <div class="job-block col-lg-6 col-md-12 col-sm-12" v-for="(job, index) in jobs.jobs">
                            <div class="inner-box">
                                <div class="content">
                                    <span class="company-logo"><img :src="job.logo_url" alt=""></span>
                                    <h4><a :href="job.url">{{ job.title }}</a></h4>
                                    <ul class="job-info">
                                        <li><span class="icon flaticon-briefcase"></span> {{ job.major_category0 }}</li>
                                        <li><span class="icon flaticon-map-locator"></span> {{ job.city[0] }}</li>
                                        <li><span class="icon flaticon-clock-3"></span> {{ moment(job.date).format('MM/DD/YYYY') }}</li>
                                    </ul>
                                    <ul class="job-other-info">
                                        <li class="time">{{ job.worktype_details[0].label }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Listing Show More -->
                    <div class="ls-show-more">
                        <p>Looking for different jobs? Try updating the filters on this page.</p>
                        <div class="bar"><span class="bar-inner" style="width: 0%"></span></div>
<!--                        <button class="show-more">Show More</button>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import {Head, Link, router, useForm} from "@inertiajs/vue3";
import {ref} from "vue";
import moment from "moment";

const props = defineProps({
    app: Object,
    jobs: {
        default: {},
        required: false,
        type: [Array, Object]
    },
    camp: {
        default: false,
        required: false,
        type: Boolean,
    },
    categories: {
        default: [],
        required: true,
        type: Array,
    },
    location: {
        default: null,
        type: String,
        required: false,
    },
    job: {
        default: null,
        type: String,
        required: false,
    },
    type: {
        default: 'All Categories',
        type: String,
        required: false,
    },
    employment_type: {
        default: null,
        required: false,
        type: String,
    },
    experience: {
        default: null,
        required: false,
        type: String,
    },
    salary: {
        default: null,
        required: false,
        type: String,
    }
});

const filters = ref({
    type: ['Full Time', 'Part Time', 'Internship', 'Work From Home', 'Gig', 'Any'],
    experience: ['None', 'Senior', 'Manager', 'Executive'],
    salary: ['10,000', '15,000', '30,000', '50,000', '75,000']
})

const searchForm = useForm({
    job: props.job,
    location: props.location,
    type: props.type,
    employment_type: props.employment_type,
    experience: props.experience,
    salary: props.salary,
});

const detectChangeOfFilter = (filter, value) => {
    if(filter === 'type') {
        searchForm.employment_type = value;
    }
    else if(filter === 'salary') {
        searchForm.salary = value;
    }
    else if(filter === 'experience') {
        searchForm.experience = value;
    }
    router.get(route('jobs'), searchForm.data(), {
        replace: true,
    });
}
</script>

<style scoped>

</style>
