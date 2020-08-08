<template>
  <tr>
    <td>{{ firstname | properCase }}</td>
    <td>{{ lastname | properCase }}</td>
    <td>{{ position }}</td>
    <td>{{ birth_date }}</td>
    <td class="float-right">
      <button
        @click="edit"
        class="btn btn-success"
      >Edit</button>
      <button
        @click="del"
        class="btn btn-danger"
      >Delete</button>
    </td>
  </tr>
</template>

<script>
  export default {
    methods: {
      edit() {
        this.$emit('edit', this.id, this.firstname, this.lastname, this.position, this.birth_date);
      },
      del() {
        this.$emit('del', this.id);
      }
    },
    props: ['id', 'firstname', 'lastname', 'position', 'birth_date'],
    filters: {
      properCase(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
      }
    }
  }
</script>
