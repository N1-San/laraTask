<template>
  <div class="flex justify-between items-center p-4 bg-gray-100 rounded-md">
    <div>
      <h3 class="text-lg font-semibold">{{ label }}</h3>
      <p class="text-sm text-gray-600">Created at: {{ createdAt }}</p>
    </div>
    <div class="flex space-x-2">
      <NuxtLink :to="`/groups/${id}/edit`" class="px-3 py-1 bg-blue-500 text-white rounded-md">Edit</NuxtLink>
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
    label() {
      return this.group.label;
    },
    createdAt() {
      return this.group.created_at;
    },
  },
  methods: {
    async deleteResource() {
      await this.$axios.$delete(`/${this.resourceType}/${this.id}`);
      this.$emit('resourceDeleted');
    },
  },
  async fetch() {
    this.group = await this.$axios.$get(`/groups/${this.id}`);
  },
}
</script>