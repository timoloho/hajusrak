<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button'
import { Input } from '@/Components/ui/input'

const props = defineProps({
    product: Object
})

const form = useForm({
    q: '',
})

const submit = (data) => {
    form.post(route('shoppingCart.add', data), {
        onSuccess: () => {
            form.reset()
        }
    });
};
</script>

<template>
    <div class="border p-2 rounded-lg bg-white">
        <p class="text-lg font-bold">{{ product.name }}</p>
        <p class="mt-12">${{ product.price }}</p>
        <form method="POST" class="grid grid-cols-2 gap-2" @submit.prevent="submit(product)">
            <Input type="number" v-model="form.q" name="q" id="q" placeholder="Quantity" required></Input>
            <Button type="submit">Add to Cart</Button>
        </form>

    </div>
</template>