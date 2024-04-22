<template>
  <div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Edit Group</h1>
    <form @submit.prevent="updateGroup" class="space-y-4">
      <div>
        <label class="block mb-2 font-semibold" for="label">Group Label:</label>
        <input id="label" v-model="label" type="text" class="w-full p-2 border border-gray-300 rounded-md" required />
      </div>
      <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md">Save</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      groupId: null,
      label: '',
    }
  },
  mounted() {
    this.fetchGroupData()
  },
  async fetch() {
    this.group = await this.$axios.$get(`/groups/${this.$route.params.id}`);
    this.label = this.group.label;
  },
  methods: {
    async updateGroup() {
      const updatedGroup = { label: this.label };
      await this.$axios.$put(`/groups/${this.$route.params.id}`, updatedGroup);
      this.$router.push('/groups');
    },
  },
}
</script>