<script setup>
    import { ref } from 'vue';
    import ApplicationLogo from '@/Components/ApplicationLogo.vue';
    import Dropdown from '@/Components/Dropdown.vue';
    import DropdownLink from '@/Components/DropdownLink.vue';
    import NavLink from '@/Components/NavLink.vue';
    import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
    import { Link } from '@inertiajs/vue3';

    const showingNavigationDropdown = ref(false);
</script>

<template>

<div class="grid grid-cols-10 grid-rows-2 gap-1">

        <nav class="bg-gray-100 row-span-2">
            <!-- Logo -->
            <Link :href="route('dashboard')"> <ApplicationLogo class="h-9 text-gray-800"/> </Link>

            <!-- Navigation Links -->
            <NavLink :href="route('dashboard')" :active="route().current('dashboard')" >
                Dashboard
            </NavLink>
            <NavLink :href="route('task.create')" :active="route().current('task.create')">
                task create 
            </NavLink>
            <NavLink :href="route('category.index')" :active="route().current('category.index')">
                categories
            </NavLink>
            <NavLink :href="route('project.index')" :active="route().current('project.index')">
                projects
            </NavLink>

            <!-- Settings Dropdown -->
            <div class=" text-center mt-8">
                <Dropdown align="right" width="48">
                    <template #trigger>
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                {{ $page.props.auth.user.name }}

                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </span>
                    </template>

                    <template #content>
                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                        <DropdownLink :href="route('logout')" method="post" as="button">
                            Log Out
                        </DropdownLink>
                    </template>
                </Dropdown>
            </div>
        </nav>

        <!-- Page Heading -->
        <header class="row-span-2 col-span-2" v-if="$slots.header">
            <slot name="header" />
        </header>

        <!-- Page Content -->
        <main class="col-span-7 ">
            <slot />
        </main>
    </div>
</template>
