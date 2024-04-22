<template>
  <div class="flex justify-between items-center p-4 bg-gray-100 rounded-md">
    <div>
      <p>{{ id }}</p>
      <h3 class="text-lg font-semibold">{{ username }}</h3>
      <p class="text-sm text-gray-600">Mobile: {{ mobile }}</p>
      <p class="text-sm text-gray-600">Groups: {{ groups.join(', ') }}</p>
      <p class="text-sm text-gray-600">Created at: {{ createdAt }}</p>
    </div>
    <div class="flex space-x-2">
      <NuxtLink :to="`/EditUser/${id}`" class="px-3 py-1 bg-blue-500 text-white rounded-md">Edit</NuxtLink>
      <button class="px-3 py-1 bg-red-500 text-white rounded-md">Delete</button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
  computed: {
    username() {
      return this.user.username;
    },
    mobile() {
      return this.user.mobile;
    },
    groups() {
      return this.user.groups.map(group => group.label);
    },
    createdAt() {
      return this.user.created_at;
    },
  },
  methods: {
    async deleteResource() {
      await this.$axios.$delete(`/${this.resourceType}/${this.id}`);
      this.$emit('resourceDeleted');
    },
  },
  async fetch() {
    this.user = await this.$axios.$get(`/users/${this.id}`);
  },
}
</script>