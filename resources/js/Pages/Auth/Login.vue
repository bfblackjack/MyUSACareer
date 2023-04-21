<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
    app: Object,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<style scoped>
.blueBg {
    background: rgb(16,71,152);
    background: -moz-linear-gradient(90deg, rgba(16,71,152,1) 0%, rgba(42,91,163,1) 0%, rgba(21,95,204,1) 45%, rgba(255,255,255,1) 100%);
    background: -webkit-linear-gradient(90deg, rgba(16,71,152,1) 0%, rgba(42,91,163,1) 0%, rgba(21,95,204,1) 45%, rgba(255,255,255,1) 100%);
    background: linear-gradient(90deg, rgba(16,71,152,1) 0%, rgba(42,91,163,1) 0%, rgba(21,95,204,1) 45%, rgba(255,255,255,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#104798",endColorstr="#ffffff",GradientType=1);
}
</style>

<template>
    <Head title="Log in" />

    <div class="login-section">
        <div class="image-layer blueBg"></div>
        <div class="outer-box">
            <!-- Login Form -->
            <div class="login-form default-form">
                <div class="form-inner">
                    <h3>Login to {{ app.name }}</h3>
                    <div v-if="status" class="mb-4 mt-4 bg-success text-sm">
                        {{ status }}
                    </div>
                    <!--Login Form-->
                    <form @submit.prevent="submit">
                        <div class="form-group">
                            <label for="email">Username</label>
                            <input type="email" placeholder="Email" v-model="form.email" required autofocus autocomplete="username">
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="form-group">
                            <label for="password-field">Password</label>
                            <input id="password-field" v-model="form.password"
                                   type="password" placeholder="Password" required
                                   autocomplete="current-password">
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="form-group">
                            <div class="field-outer">
                                <div class="input-group checkboxes square">
                                    <Checkbox v-model:checked="form.remember" name="remember" id="remember" />
                                    <label for="remember" class="remember"><span class="custom-checkbox"></span> Remember me</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="theme-btn btn-style-one" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit" name="log-in">Log In</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--End Login Form -->
        </div>
    </div>
</template>
