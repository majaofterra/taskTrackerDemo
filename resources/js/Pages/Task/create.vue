<script setup>
	import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
	import { Head, useForm } from '@inertiajs/vue3';
	import InputError from '@/Components/InputError.vue';
	import InputLabel from '@/Components/InputLabel.vue';
	import PrimaryButton from '@/Components/PrimaryButton.vue';
	import TextInput from '@/Components/TextInput.vue';
	import SelectInput from '@/Components/SelectInput.vue';
</script>
<script>

	export default {
		data(){return {
			form : useForm({
				name: '',
				description: '',
				status: '',
				project: '',
				category: '',
			}),
		}
	},

	methods: {
        submit : function(){
			this.form.post(route('task.store'), {
			});
		},	
	},
	props:{
		categories:Array,
		projects:Array,
		statuses:Array,
	},

}
</script>

<template>
	<Head title="Create Task" />

	<AuthenticatedLayout>

		<div class="py-12 px-2">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Task</h2>
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

					<form @submit.prevent="submit">

						<div>
							<InputLabel for="name" value="Name" />
							<TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" placeholder="Name"/>
							<InputError class="mt-2" :message="form.errors.name" />
						</div>

						<div class="pt-2">
							<InputLabel for="category" value="Category" />
							<SelectInput id="category" v-model="form.category" required  :options="categories"/>
							<InputError class="mt-2" :message="form.errors.category" />
						</div>
						
						<div class="pt-2">
							<InputLabel for="project" value="Project" />
							<SelectInput id="project" v-model="form.project" required  :options="projects"/>
							<InputError class="mt-2" :message="form.errors.project" />
						</div>
						<div class="pt-2">
							<InputLabel for="status" value="Status" />
							<SelectInput id="status" v-model="form.status" required  :options="statuses"/>
							<InputError class="mt-2" :message="form.errors.status" />
						</div>

						<div class="pt-2">
							<InputLabel for="description" value="description" />
							<textarea id="description" v-model="form.description" required  placeholder="description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"/>
							<InputError class="mt-2" :message="form.errors.description" />
						</div>

						<div class="p-4">
							<PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
								save
							</PrimaryButton>
						</div>
					</form>
				</div>
			</div>
		</div>
	</AuthenticatedLayout>
</template>
