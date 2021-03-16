<template>
  <card :title="$t('your_password')">
     <div class="row ">
      <div class="col-4 border-right ">
          <div class="h-100 justify-content-center align-items-center">
              <h4 class="text-center">Wallet Balance</h4>
              <h2 class="text-center">{{ $balance }}</h2>
          </div>
      </div>
      <div class="col-4 justify-content-center">
          <div class="h-100 justify-content-center align-items-center">
              <h4 class="text-center">Income</h4>
              <h2 class="text-center">+{{ $income }}</h2>
          </div>
      </div>
      <div class="col-4 border-left justify-content-center">
          <div class="h-100 justify-content-center align-items-center">
              <h4 class="text-center">Expenses</h4>
              <h2 class="text-center">-{{ $expanse }}</h2>
          </div>
      </div>
  </div>
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
          <td>{{ user.email }}</td>
          <td>+ {{ user.country_code }} - {{ user.phone }}</td>
          <td>{{ user.birthday }}</td>
          <td>{{ user.expanses_transactions_count }}</td>
          <td>{{ user.income_transactions_count }}</td>
          <td>{{ user.created_at }}</td>
        </tr>
      </tbody>
    </table>
  </card>
</template>

<script>
import Form from "vform";
import axios from "axios";

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
    balance:"11111",
    income:"222222",
    expanse:"33333333"

  }),
  mounted() {
    axios
      .get("/api/adminusers")
      .then((response) => (this.usersTable = response.data.users));
    // console.log("mounted executed")
    // console.log(this.usersTable)
  },
};
</script>
