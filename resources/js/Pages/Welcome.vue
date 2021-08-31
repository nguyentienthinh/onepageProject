<template>
  <Head title="Welcome" />
  <div>
    Welcome

    <Link :href="route('post')">Posts</Link>
  </div>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import MainLayout from '@/Layouts/Main.vue';

export default {
  layout: MainLayout,

  components: {
    Link,
    Head
  },
};
</script>