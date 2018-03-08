<template>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Contact</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Name</p>
                    <input type="text" class="mb-2" v-model="name">
                    <p>Number</p>
                    <input type="text" v-model="number" maxlength="10" size="10" v-numericOnly>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" v-on:click="addContact()">Add</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: "",
                number: "",
            }
        },
        methods: {
            addContact() {
                let contact = {
                    "name": this.name,
                    "number": this.number
                };
                axios.post("http://localhost:8000/api/contacts", contact)
                    .then(() => {
                        this.$emit("newcontactadded");
                    });
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
    }
</script>

<style>
</style>