<template>
  <div>
    <h1>Group List</h1>
    <button @click="showAddGroupModal = true">Add Group</button>
    <ul>
      <li v-for="group in groups" :key="group.id">
        {{ group.id }} - {{ group.label }} - {{ group.created_at }}
        <button @click="showEditModal(group)">Edit</button>
        <button @click="deleteGroup(group.id)">Delete</button>
      </li>
    </ul>

    <!-- Add Group Modal -->
    <div v-if="showAddGroupModal" class="modal">
      <div class="modal-content">
        <span class="close" @click="showAddGroupModal = false">&times;</span>
        <h2>Add Group</h2>
        <form @submit.prevent="addGroup">
          <input v-model="newGroup.label" placeholder="Label" />
          <button type="submit">Add Group</button>
        </form>
      </div>
    </div>

    <!-- Edit Group Modal -->
    <div v-if="editedGroup !== null" class="modal">
      <div class="modal-content">
        <span class="close" @click="closeEditModal">&times;</span>
        <h2>Edit Group</h2>
        <form @submit.prevent="updateGroup">
          <input v-model="editedGroup.label" placeholder="Label" />
          <button type="submit">Update Group</button>
        </form>
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
        label: ''
      },
      showEditModal: false,
      editedGroup: null
    }
  },
  mounted() {
    this.fetchGroups()
  },
  methods: {
    async fetchGroups() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/groups')
        this.groups = response.data
      } catch (error) {
        console.error(error)
      }
    },
    showEditModal(group) {
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
        await axios.put(`http://127.0.0.1:8000/api/groups/${this.editedGroup.id}`, this.editedGroup)
        this.closeEditModal()
        this.fetchGroups()
      } catch (error) {
        console.error(error)
      }
    },
    async deleteGroup(groupId) {
      try {
        await axios.delete(`http://127.0.0.1:8000/api/groups/${groupId}`)
        this.fetchGroups()
      } catch (error) {
        console.error(error)
      }
    },
    async addGroup() {
      try {
        await axios.post('http://127.0.0.1:8000/api/groupsAdd', this.newGroup)
        this.newGroup = {
          label: ''
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