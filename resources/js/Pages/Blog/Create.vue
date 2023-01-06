<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3'

const form = useForm({
    name: null,
    slug: null,
    content: null,
    published: false
})

</script>

<template>
    <Head title="Ajouter un article" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ajouter un article</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <form class="flex flex-col gap-4" @submit.prevent="form.post('/login')">
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
                            <button type="submit" :disabled="form.processing">Sauvegarder</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
