<template>
  <Head title="Post" />
  <div>
    Post

    <Link :href="route('welcome')">Welcome</Link>
  </div>

  <div>
    <input v-model="params.search" type="search" name="search" id="search" />
  </div>

  <table class="table table-hover">
    <thead>
      <tr>
        <th>
          <span @click="sort('id')">ID</span>
          <i class="bi bi-sort-up"></i>

        </th>
        <th>
          <span @click="sort('title')">Title</span>
        </th>
        <th>Body</th>
        <th>Actions</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="post in posts" :key="post.id">
        <td>{{ post.id }}</td>
        <td>{{ post.title }}</td>
        <td>{{ post.body }}</td>
        <td>Edit</td>
        <td>Delete</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import MainLayout from "@/Layouts/Main.vue";

export default {
  layout: MainLayout,

  components: {
    Link,
    Head,
  },
  props: {
    posts: Object,
    filters: Object,
  },

  data() {
    return {
      params: {
        search: this.filters.search,
        field: this.filters.field,
        direction: this.filters.direction,
      },
    };
  },

  watch: {
    params: {
      handler() {
        let params = this.params;

        Object.keys(params).forEach(key => {
          if (params[key] == '') {
            delete params[key];
          }
        });

        this.$inertia.get(this.route("post"), params, {
          replace: true,
          preserveState: true,
        });
      },
      deep: true,
    },
  },

  methods: {
    sort(field) {
      this.params.field = field;
      this.params.direction = this.params.direction == 'asc' ? 'desc' : 'asc';
    }
  },
};
</script>