<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    phone: '', // Include phone here
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

const googleSignUp = () => {
    window.location.href = route('google.redirect');
};

</script>

<template>
    <Head title="Register" />

    <div class="flex min-h-screen items-center justify-center bg-white p-4 sm:p-6">
        <div class="w-full max-w-6xl overflow-hidden rounded-lg bg-white shadow-lg lg:flex">
            <!-- Left side - Registration Form -->
            <div class="w-full p-8 sm:p-12 lg:w-1/2">
                <h1 class="mb-2 text-3xl font-bold sm:text-4xl">Join us</h1>
                <p class="mb-8 text-base text-gray-600 sm:text-lg">
                    New here? Create an account and start<br />
                    sipping on something special.
                </p>

                <form @submit.prevent="submit" class="space-y-4">
                    <div>
                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full rounded-full border-gray-300 px-4 py-2 shadow-sm focus:border-black focus:ring-black sm:px-6 sm:py-3"
                            v-model="form.name"
                            placeholder="Name"
                            required
                            autofocus
                            autocomplete="name"
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div>
                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full rounded-full border-gray-300 px-4 py-2 shadow-sm focus:border-black focus:ring-black sm:px-6 sm:py-3"
                            v-model="form.email"
                            placeholder="Email"
                            required
                            autocomplete="username"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div>
                        <TextInput
                            id="phone"
                            type="tel"
                            class="mt-1 block w-full rounded-full border-gray-300 px-4 py-2 shadow-sm focus:border-black focus:ring-black sm:px-6 sm:py-3"
                            v-model="form.phone"
                            placeholder="Phone"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.phone" />
                    </div>

                    <div>
                        <TextInput
                            id="password"
                            type="password"
                            class="mt-1 block w-full rounded-full border-gray-300 px-4 py-2 shadow-sm focus:border-black focus:ring-black sm:px-6 sm:py-3"
                            v-model="form.password"
                            placeholder="Password"
                            required
                            autocomplete="new-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div>
                        <TextInput
                            id="password_confirmation"
                            type="password"
                            class="mt-1 block w-full rounded-full border-gray-300 px-4 py-2 shadow-sm focus:border-black focus:ring-black sm:px-6 sm:py-3"
                            v-model="form.password_confirmation"
                            placeholder="Confirm Password"
                            required
                            autocomplete="new-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>

                    <div class="pt-4">
                        <PrimaryButton
                            class="w-full justify-center rounded-full bg-black py-2 text-center text-white hover:bg-gray-800 sm:py-3"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Sign Up
                        </PrimaryButton>
                    </div>

                </form>
                <div class="">
                    <div class="pt-4">
                        <PrimaryButton @click="googleSignUp"
                            class="flex w-full items-center justify-center rounded-full border border-gray-300 bg-black py-2 text-center text-black hover:bg-gray-200 sm:py-3">
                            <img src="/images/google-logo.svg" alt="Google Logo" class="mr-2 h-4 w-4 sm:h-5 sm:w-5" />
                            Sign up with Google
                        </PrimaryButton>
                    </div>
                </div>
                    <div class="mt-4 text-center">
                        <span class="text-gray-600">Already a member? </span>
                        <Link :href="route('login')" class="font-semibold text-black hover:underline">
                            Sign in
                        </Link>
                    </div>
            </div>

            <!-- Right side - Illustration -->
            <div class="hidden w-full bg-gray-50 lg:block lg:w-1/2 mt-10">
                <img src="/images/COFI building.png" alt="Coffee Shop Illustration" class="h-[550px] w-auto mx-auto" />
            </div>
        </div>
    </div>
</template>

