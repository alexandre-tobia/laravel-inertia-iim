<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';
import {useForm} from '@inertiajs/inertia-vue3'

const props = defineProps({
    post: Object
})

const form = useForm({
    name: props.post.name,
    slug: props.post.slug,
    content: props.post.content,
    published: props.post.published
})

</script>

<template>
    <Head title="Ajouter un article"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Modifier l'article : {{post.name}}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <form class="flex flex-col gap-4" @submit.prevent="form.put(route('blog.update', {slug: post.slug}))">
                            <!-- email -->
                            <input placeholder="Titre" type="text" v-model="form.name">
                            <div v-if="form.errors.name">{{ form.errors.name }}</div>
                            <!-- password -->
                            <input placeholder="slug-de-l-article" type="text" v-model="form.slug">
                            <div v-if="form.errors.slug">{{ form.errors.slug }}</div>

                            <textarea placeholder="Contenu" v-model="form.content"></textarea>
                            <div v-if="form.errors.content">{{ form.errors.content }}</div>

                            <!-- remember me -->
                            <div class="flex items-center gap-2">
                                <input type="checkbox" v-model="form.published"> Publié ?
                            </div>
                            <!-- submit -->
                            <button class="py-2 px-4 bg-green-400 text-white rounded" type="submit"
                                    :disabled="form.processing">Modifier
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
