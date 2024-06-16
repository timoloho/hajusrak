<script>
import { defineComponent } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

export default defineComponent({
    setup() {
        const { csrf_token } = usePage().props;

        return {
            csrf_token,
        };
    },
});
</script>

<template>
    <form action="{{ route('stripeCheckout') }}" method="POST">
        @csrf
        <button type="submit">Checkout</button>
    </form>
</template>