<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, useForm } from '@inertiajs/vue3';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
</script>
<script>
    export default {
        data(){return {
            form : useForm({
                name: '',
            }),
        }
    },
    methods: {
        submit : function(){
            this.form.post(route('category.store'), {
                onFinish: () => {
                    this.form.reset('name');
                },
            });
        },  
    },
    props:{
        categories:Array,
    },
}
</script>

<template>
    <Head title="Categories" />
    <AuthenticatedLayout>
        <div class="py-12 px-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Categories</h2> 
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <form @submit.prevent="submit()">
                        <div>
                            <InputLabel for="name" value="New Category" />
                            <InputError class="mt-2" :message="form.errors.name" />
                            <TextInput id="name" type="text" class="m-2" v-model="form.name" required autofocus placeholder="name"/>

                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                save
                            </PrimaryButton>
                        </div>
                    </form>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mt-2">
                    <h2 class="text-lg">Categories</h2>
                    <small v-for="item in categories" class="p-1">
                        {{item.name}}
                    </small>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
