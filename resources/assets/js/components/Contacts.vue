<template>
  <div class="container mt-5">
    <contact-modal v-on:newcontactadded="newContactAdded()" id="myModal"/>
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="card card-default">
          <div class="card-header text-center top-bar">
            <h1>Contacts</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add</button>
          </div>

          <div class="card-body">
            <table class=" table table-stripped table-hover">
              <thead>
                <!-- <th>Sr.No</th> -->
                <th>Name</th>
                <th>Number</th>
                <th>Options</th>
              </thead>
              <tbody>
                <contact-row v-for="contact in contacts" v-bind:key="contact.id" v-bind:data="contact" v-on:contactdeleted="test" />
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import contactrow from "./contact-rows";
  import contactmodal from "./addcontactmodal"
  export default {
    mounted() {
      console.log("Component mounted.");
    },
    components: {
      "contact-row": contactrow,
      "contact-modal": contactmodal,
    },
    data: function () {
      return {
        contacts: []
      };
    },
    methods: {
      test() {
        this.contacts = this.contacts;  
        this.loadMsgs();
      },
      newContactAdded(){
        this.test();
      },
      loadMsgs() {
        axios.get("http://localhost:8000/api/contacts").then(res => {
          this.contacts = res.data;
        });
      }
    },
    created() {
      this.loadMsgs();
    }
  };
</script>

<style scoped>
  .top-bar {
    display: flex;
    justify-content: space-between;
  }
</style>