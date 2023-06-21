<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import SelectSearch from '@/Components/SelectSearch.vue';
    import TextInput from '@/Components/TextInput.vue';
</script>
<script>
    export default {
        data(){
            return {
                tasks:this.taskProp,
                term:'',
                projectID:'',
                project:{},
                filters:{},
            }
        },
        methods: {
            search : function(){
                axios.put(route('search'),{term:this.term,project:this.projectID})
                .then((result) => {this.tasks = result.data; })
            },  
            setProject : function(input){
                this.term = ''
                this.projectID = input
                axios.put(route('project'),{project:input})
                .then((result) => {
                    this.tasks = result.data.tasks; 
                    this.project = result.data.project; 
                })
            }, 
        },
        props:{
            categories:Array,
            projects:Array,
            statuses:Array,
            taskProp:Object,
        },
        watch: {
            '$data.filters': { 
                handler: function(newValue) {
                    axios.put(route('filter'),{filters:newValue,project:this.projectID})
                    .then((result) => {this.tasks = result.data; })
                },
                deep: true
            },
        },

    }
</script>


<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2>Projects</h2>
            <button v-for="item in projects" @click="setProject(item.id)" class="m-1">{{item.name}}</button>
        </template>

        <div v-show="project.name" class="border-gray-200 border-2 rounded block m-1 p-2">
            <h1 class="text-xl"> {{project.name}} </h1>
            <strong>{{project.compelte}}% done</strong>
            <br />
            <small>started at {{project.started}}</small>
        </div>
        <div class="border-gray-200 border-2 rounded inline-block m-1">
            <div class="border-gray-100 border-2 rounded inline-block m-1 ">
                <div class="inline-block">
                    Category:<SelectSearch v-model="filters.category" name="categories" :options="categories"/>
                </div>
                <div class="inline-block">
                    Status:<SelectSearch v-model="filters.status" name="statuses" :options="statuses"/>
                </div>
            </div>
            <div class="border-gray-100 border-2 rounded inline-block m-1 ">
                <TextInput type="text" class="mt-1 inline-block" v-model="term" placeholder="Search"/>
                <button @click="search()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 m-1 rounded">
                Search</button>
            </div>
        </div>

        <div class="bg-gray-100">

            <div class="bg-white shadow-sm rounded-lg p-2 m-2 inline-block" v-for="task in tasks">
                <div v-if="task.status.id == 4" class="bg-gray-100 border-l-4 border-gray-500 text-gray-700 p-4" role="alert">
                    {{task.status.name}}
                </div>
                <div v-if="task.status.id == 3" class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                    {{task.status.name}}
                </div>
                <div v-if="task.status.id == 2" class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                    {{task.status.name}}
                </div>
                <div v-if="task.status.id == 1" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                    {{task.status.name}}
                </div>
                <h2 class="text-lg text-center"> {{task.name}} </h2>
                <p class="p-2"> {{task.description}} </p>
                user: {{task.user.name}}<br />
                category: {{task.category.name}}<br />
                project: {{task.project.name}}<br />
            </div>
        </div>

    </AuthenticatedLayout>
</template>
