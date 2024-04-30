<template>
  <div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-4">Group List</h1>
    <button @click="showAddGroupModal = true"
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Group</button>
    <ul>
      <li v-for="group in groups" :key="group.id" class="bg-white shadow-md rounded-md p-4 mb-4">
        <div class="flex justify-between items-center">
          <div>
            <p class="text-lg font-semibold">ID: {{ group.id }}</p>
            <h3 class="text-lg font-semibold">{{ group.label }}</h3>
            <p class="text-sm text-gray-600">Created at: {{ group.created_at }}</p>
          </div>
          <div class="flex space-x-2">
            <button @click="showEditModal(group)"
              class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
            <button @click="deleteGroup(group.id)"
              class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
          </div>
        </div>
      </li>
    </ul>
    <!-- Add Group Modal -->
    <div v-if="showAddGroupModal" class="fixed z-10 inset-0 overflow-y-auto">
      <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Add Group</h2>
            <span class="close" @click="showAddGroupModal = false">
              <svg class="h-6 w-6 text-gray-500 hover:text-gray-700" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </span>
          </div>
          <form @submit.prevent="addGroup">
            <div class="mb-4">
              <label for="label" class="block font-medium mb-2">Label</label>
              <input v-model="newGroup.label" id="label" placeholder="Label"
                class="w-full border border-gray-300 rounded-md px-3 py-2" />
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add
              Group</button>
          </form>
        </div>
      </div>
    </div>
    <!-- Edit Group Modal -->
    <div v-if="editedGroup !== null" class="fixed z-10 inset-0 overflow-y-auto">
      <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Edit Group</h2>
            <span class="close" @click="closeEditModal">
              <svg class="h-6 w-6 text-gray-500 hover:text-gray-700" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </span>
          </div>
          <form @submit.prevent="updateGroup">
            <div class="mb-4">
              <label for="label" class="block font-medium mb-2">Label</label>
              <input v-model="editedGroup.label" id="label" placeholder="label"
                class="w-full border border-gray-300 rounded-md px-3 py-2" />
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update
              Group</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      groups: [],
      showAddGroupModal: false,
      newGroup: {
        label: '',
        
      },
      editedGroup: null,
      filterGroups: []
    }
  },
  mounted() {
    this.fetchGroups()
  },
  methods: {
    async fetchGroups() {
      try {
        // const response = await axios.get('https://fakestoreapi.com/products')
        const response = await axios.get('http://127.0.0.1:8000/api/groups')
        this.groups = response.data
      } catch (error) {
        console.error(error)
      }
    },
    showEditModal(group) {
      console.log('showEditModal called with:', group);
      if (group) {
        this.editedGroup = { ...group }
        this.showEditModal = true
      }
    },
    closeEditModal() {
      this.showEditModal = false
      this.editedGroup = null
    },
    async updateGroup() {
      try {
        await axios.put(`http://127.0.0.1:8000/api/groups/${this.editedGroup.id}`, this.editedUser)
        this.closeEditModal()
        this.fetchGroups()
      } catch (error) {
        console.error(error)
      }
    },
    async deleteGroup(groupId) {
      try {
        await axios.delete(`http://127.0.0.1:8000/api/groups/${groupId}`);
        this.fetchGroups()
      } catch (error) {
        console.error(error)
      }
    },
    async addGroup() {
      try {
        await axios.post('http://127.0.0.1:8000/api/groupsAdd', this.newGroup)
        this.newGroup = {
          label: '',
        }
        this.showAddGroupModal = false
        this.fetchGroups()
      } catch (error) {
        console.error(error)
      }
    }
  }
}
</script>