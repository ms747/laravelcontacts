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
            <div class="mb-2 row">
              <div class="col-xs-12 col-lg-2 col-md-2 col-sm-3 d-flex justify-content-start">
                <h5 class="mr-2">Search</h5>
              </div>
              <div class="col-xs-12 col-lg-10 col-md-10 col-sm-9">
                <input type="search" class="search-my" v-model="search" v-on:keyup="searchFunction()" @click="searchFunction()">
              </div>
            </div>
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
import contactmodal from "./addcontactmodal";
export default {
  mounted() {
    console.log("Component mounted.");
  },
  components: {
    "contact-row": contactrow,
    "contact-modal": contactmodal
  },
  data: function() {
    return {
      contacts: [],
      search: "",
      mytime: 0
    };
  },
  methods: {
    test() {
      this.contacts = this.contacts;
      this.loadMsgs();
    },
    newContactAdded() {
      this.test();
    },
    loadMsgs() {
      axios.get("http://localhost:8000/api/contacts").then(res => {
        this.contacts = res.data;
      });
    },
    searchFunction() {
      clearTimeout(this.mytime);
      this.mytime = setTimeout(() => {
        // console.log(this.search);
        if (this.search != "") {
          axios
            .get(`http://localhost:8000/api/contact/${this.search}`)
            .then(res => {
              this.contacts = this.contacts;
              this.contacts = res.data;
            });
        }else{
          this.loadMsgs();
        }
      }, 500);
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

.top-bar > div {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
}

.top-bar > div > p {
  margin-top: 7%;
  margin-right: 40%;
}

input[type="search"] {
  -webkit-appearance: searchfield;
}
input[type="search"]::-webkit-search-cancel-button {
  -webkit-appearance: searchfield-cancel-button;
}

.search-my {
  width: 100%;
}
</style>