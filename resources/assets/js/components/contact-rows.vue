<template>
  <tr>
    <!-- <td>{{data.id}}</td> -->
    <td v-if="editable">
      {{data.name}}
    </td>
    <td v-else>
      <input type="text" v-model="data.name" size="10" @keyup.esc="swapEditable()" @keyup.enter="updateChanges(data.id)">
    </td>
    <td v-if="editable">
      {{data.number}}
    </td>
    <td v-else>
      <input type="text" v-model="data.number" v-numericOnly maxlength="10" size="10" @keyup.esc="swapEditable()" @keyup.enter="updateChanges(data.id)">
    </td>
    <td v-if="editable">
      <a href="#" @click="swapEditable()" class="btn btn-primary btn-block">Edit</a>
      <a href="#" @click="deleteContact(data.id)" class="btn btn-danger btn-block">Delete</a>
    </td>
    <td v-else>
      <a href="#" class="btn btn-success btn-block" @click="updateChanges(data.id)">Save</a>
    </td>
  </tr>
</template>

<script>
  export default {
    props: ["data"],
    data() {
      return {
        editable: true,
      }
    },
    methods: {
      deleteContact(id) {
        axios.delete(`http://localhost:8000/api/contact/${id}`).then(res => {
          this.$emit('contactdeleted');
        });
      },
      swapEditable() {
        this.editable = !this.editable;
      },
      updateChanges(id) {
        let contact = {
          "name": this.data.name,
          "number": this.data.number
        };
        axios.put(`http://localhost:8000/api/contact/${id}`, contact);
        this.swapEditable();
      }
    },
    directives: {
      numericOnly: {
        bind(el, binding, vnode) {
          el.addEventListener('keyup', (e) => {
            let regex = /^[0-9]*$/
            if (!regex.test(el.value)) {
              el.value = el.value.slice(0, -1)
            }
          })
        }
      }
    }
  };
</script>

<style>
</style>