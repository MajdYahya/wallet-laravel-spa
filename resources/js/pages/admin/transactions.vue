<template>
  <card :title="$t('All users data')">
    <table class="table" @submit.prevent="tableUsersUpdte">
      <thead class="thead-dark">
        <tr>
           <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Birthdate</th>
            <th scope="col">Total expences</th>
            <th scope="col">Total income</th>
            <th scope="col">Registration date</th>
        </tr>
      </thead>
      <tbody>

        <tr v-for="user in usersTable" :key="user.id">
          <th scope="row">{{ user.id }}</th>
          <td>{{ user.name }}</td>
          <td>{{user.email}}</td>
          <td>+ {{user.country_code}} - {{user.phone}}</td>
          <td>{{user.birthday}}</td>
          <td>{{user.expanses_transactions_count}}</td>
          <td>{{user.income_transactions_count}}</td>
          <td>{{user.created_at}}</td>

        </tr>
      </tbody>
    </table>

  </card>
</template>

<script>
import Form from "vform";
import axios from 'axios'


export default {
  scrollToTop: false,

  metaInfo() {
    return { title: this.$t("settings") };
  },

  data: () => ({
    form: new Form({
      password: "",
      password_confirmation: "",
    }),
    usersTable: ["1","43"],
  }),

  methods: {
    async update() {
      await this.form.patch("/api/settings/password");

      this.form.reset();
    },

  },
   mounted () {

    axios
      .get('/api/adminusers')
      .then(response => (this.usersTable = response.data.users))
  }
};
</script>
