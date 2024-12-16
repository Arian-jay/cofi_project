<script setup>
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { ref } from 'vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

const showingNavigationDropdown = ref(false);

const products = [
  {
    name: "Dark Hot Chocolate",
    description: "Bold, smooth, and luxuriously rich",
    image: "/images/products/promo/dark-hot-chocolate.png",
    price: 120,
  },
  {
    name: "Peppermint Cocoa",
    description: "Rich, creamy cocoa with a refreshing peppermint twist",
    image: "/images/products/promo/peppermint-cocoa.png",
    price: 120,
  },
  {
    name: "Biscoff Cream",
    description: "A creamy coffee delight infused with the warm, spiced sweetness of Biscoff",
    image: "/images/products/promo/biscoff-cream.png",
    price: 120,
  },
];
</script>

<template>
    <Head title="COFI - Carry the Merry" />
    
    <!-- Main Layout -->
    <div class="min-h-screen bg-[#2D5522] ">
        <nav class="border-gray-100 text-white">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 justify-between">
                    <div class="flex ">
                        <!-- Logo -->
                        <div class="flex shrink-0 items-center ">
                            <Link :href="route('dashboard')">
                                <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800" />
                            </Link>
                            <NavLink :href="route('dashboard')" class="ml-2 text-xl font-bold text-gray-900">COFI</NavLink>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <NavLink :href="route('dashboard')">HOME</NavLink>
                            <NavLink :href="route('menu')" :active="route().current('menu')">MENU</NavLink>
                            <NavLink :href="route('dashboard')">CONTACT US</NavLink>
                        </div>
                    </div>

                    <div class="hidden sm:ms-6 sm:flex sm:items-center">
                        <NavLink :href="route('cart')">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-9 h-9 text-right">
                                <path d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                            </svg>
                        </NavLink>
                        <!-- Settings Dropdown -->
                        <div class="relative ms-3">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none">
                                            {{ $page.props.auth.user.name }}
                                            <svg class="-me-0.5 ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
                                    <DropdownLink :href="route('logout')" method="post" as="button">Log Out</DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button @click="showingNavigationDropdown = !showingNavigationDropdown" class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ hidden: showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ hidden: !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden">
                <div class="space-y-1 pb-3 pt-2">
                    <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">HOME</ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('menu')" :active="route().current('menu')">MENU</ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('contact')" :active="route().current('contact')">CONTANCT US</ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('cart')" :active="route().current('cart')">MY CART</ResponsiveNavLink>
                </div>

                <div class="border-t border-gray-200 pb-1 pt-4">
                    <div class="px-4">
                        <div class="text-base font-medium text-gray-800">{{ $page.props.auth.user.name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ $page.props.auth.user.email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink :href="route('profile.edit')">Profile</ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('logout')" method="post" as="button">Log Out</ResponsiveNavLink>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative bg-gradient-to-br from-[#2D5522] via-[#3B7F3B] to-[#67A967] text-white min-h-[80vh] flex items-center justify-center">
            <div class="max-w-6xl mx-auto flex flex-col lg:flex-row items-center lg:justify-between gap-10 p-6 lg:p-12">
              <!-- Left Side: Cart Summary -->
              <div class="bg-white text-gray-800 shadow-lg rounded-lg w-full lg:w-1/3 p-6 space-y-4">
                <h2 class="text-2xl font-bold text-center">Your Cart</h2>
                <ul class="space-y-4">
                  <li v-for="(product, index) in products" :key="index" class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                      <img :src="product.image" :alt="product.name" class="h-16 w-16 rounded object-cover">
                      <div>
                        <h3 class="text-lg font-semibold">{{ product.name }}</h3>
                        <p class="text-sm text-gray-500">{{ product.description }}</p>
                      </div>
                    </div>
                    <p class="text-lg font-semibold">₱{{ product.price || 120 }}</p>
                  </li>
                </ul>
                <div class="border-t border-gray-300 pt-4 space-y-2">
                  <div class="flex justify-between">
                    <p>Subtotal</p>
                    <p class="font-semibold">₱360</p>
                  </div>
                  <div class="flex justify-between">
                    <p>Tax</p>
                    <p class="font-semibold">₱43.20</p>
                  </div>
                  <div class="flex justify-between">
                    <p class="text-lg font-bold">Total</p>
                    <p class="text-lg font-bold">₱403.20</p>
                  </div>
                </div>
                <button
                  class="w-full mt-4 bg-[#2D5522] hover:bg-[#3B7F3B] text-white font-semibold py-2 rounded-lg transition duration-300">
                  Proceed to Payment
                </button>
              </div>
        
              <!-- Right Side: Featured Products or Promo -->
              <div class="flex-1 space-y-8">
                <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight">
                  Carry the Merry<br />
                  <span class="text-[#FFD700]">With Every Sip</span>
                </h1>
                <p class="text-lg lg:text-xl text-gray-200">
                  Experience the joy of indulgent flavors. From creamy Biscoff Cream to refreshing Peppermint Cocoa, let every sip bring a little festive magic to your day.
                </p>
                <div class="flex gap-4 flex-wrap">
                  <a :href="route('menu')" class="bg-[#FFD700] text-[#2D5522] px-6 py-3 font-bold rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    Explore Menu
                  </a>
                  <a class="bg-transparent border-2 border-[#FFD700] text-[#FFD700] px-6 py-3 font-bold rounded-lg hover:bg-[#FFD700] hover:text-[#2D5522] transition duration-300">
                    View Cart
                  </a>
                </div>
              </div>
            </div>
          </div>
    </div>
</template>

