<template>
  <tr>
      <!-- <td>{{data.id}}</td> -->
      <td>{{data.name}}</td>
      <td>{{data.number}}</td>
      <td>
        <a @click="deleteContact(data.id)" class="btn btn-danger">Edit</a>
        <a  @click="deleteContact(data.id)" class="btn btn-primary">Delete</a>
      </td>
  </tr>
</template>

<script>
export default {
  props: ["data"],
  methods: {
    deleteContact(id) {
      axios.delete(`http://localhost:8000/api/contact/${id}`).then(res => {
        console.log(res);
        this.$emit('contactdeleted');
      });
    }
  }
};
</script>

<style>

</style>
