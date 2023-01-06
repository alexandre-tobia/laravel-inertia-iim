<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";

defineProps({
    'posts' : Array,
    'pageTitle': String
})

const toggle = (id) => {
    Inertia.post(route('blog.toggle', id));
}
</script>
<template>
    <Head :title="pageTitle" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{  pageTitle }}</h2>
                <Link class="text-white py-2 px-4 bg-green-500 rounded" :href="route('blog.create')">Ajouter un article</Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Slug
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Content
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Publié ?
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Editer</span>
                                <span class="sr-only">Supprimer</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Odd row -->
                        <tr v-for="post in posts" :key="post">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ post.name.substring(0,20) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ post.slug }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ post.content.substring(0,20) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <!-- Publié: bg-indigo-600 | Non publié: bg-gray-200 -->
                                <button @click="toggle(post.id)" type="button" v-bind:class="[post.published ? 'bg-indigo-600' : 'bg-gray-200']"  class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" aria-pressed="false">
                                    <span class="sr-only">Use setting</span>
                                    <!-- Publié: "translate-x-5", Non publié: "translate-x-0" -->
                                    <span aria-hidden="true" v-bind:class="[post.published ? 'translate-x-5' : 'translate-x-0']"  class="pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <Link :href="route('blog.edit', {slug: post.slug})" class="text-indigo-600 hover:text-indigo-900">Editer</Link>
                                <a href="#" class="ml-4 text-indigo-600 hover:text-indigo-900">Supprimer</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
