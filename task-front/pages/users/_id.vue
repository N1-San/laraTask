<template>
  <div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Edit User</h1>
    <form @submit.prevent="updateUser" class="space-y-4">
      <div>
        <label class="block mb-2 font-semibold" for="username">Username:</label>
        <input id="username" v-model="username" type="text" class="w-full p-2 border border-gray-300 rounded-md"
          required />
      </div>
      <div>
        <label class="block mb-2 font-semibold" for="mobile">Mobile:</label>
        <input id="mobile" v-model="mobile" type="tel" class="w-full p-2 border border-gray-300 rounded-md" required />
      </div>
      <div>
        <label class="block mb-2 font-semibold" for="groups">Groups:</label>
        <select id="groups" v-model="groups" multiple class="w-full p-2 border border-gray-300 rounded-md" required>
          <option v-for="group in availableGroups" :key="group" :value="group">{{ group }}</option>
        </select>
      </div>
      <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md">Save</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: null,
      username: '',
      mobile: '',
      groups: [],
    }
  },
  computed: {
    availableGroups() {
      return this.$store.state.groups.map(group => ({ label: group.label, value: group.id }));
    },
  },
  async fetch() {
    this.user = await this.$axios.$get(`/users/${this.$route.params.id}`);
    this.username = this.user.username;
    this.mobile = this.user.mobile;
    this.groups = this.user.groups.map(group => ({ label: group.label, value: group.id }));
    this.$store.commit('setGroups', await this.$axios.$get('/groups'));
  },
  methods: {
    async updateUser() {
      const updatedUser = {
        username: this.username,
        mobile: this.mobile,
        groups: this.groups.map(group => group.value),
      };
      await this.$axios.$put(`/users/${this.$route.params.id}`, updatedUser);
      this.$router.push('/users');
    },
  },
}
</script>