<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Textarea } from '@/Components/ui/textarea'
import { Button } from '@/Components/ui/button'
import { Input } from '@/Components/ui/input'

const form = useForm({
    title: '',
    description: ''
})

const submit = () => {
    form.post(route('blog.store'));
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12 w-full flex justify-center items-center">
            <form action="" class="flex flex-col justify-center gap-4 w-1/3" @submit.prevent="submit">
                <div>
                    <p>Title</p>                    
                    <Input type="text" name="title" id="" v-model="form.title" class="rounded bg-white"></Input>
                </div>
                <div>
                    <p>Description</p>                    
                    <Textarea type="text" name="description" id="" v-model="form.description" class="rounded bg-white"></Textarea>
                </div>
                <Link @click="submit" as="button" type="button"><Button class="w-full">Submit</Button></Link>
            </form>
        </div>
    </AuthenticatedLayout>
</template>