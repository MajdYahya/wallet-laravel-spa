<template>
<div>
 <div class="container">
        <div class="row mb-3">
            <h2>
                My walllet transactions and summary
            </h2>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-4 border-right ">
                                    <div class="h-100 justify-content-center align-items-center">
                                        <h4 class="text-center">Wallet Balance</h4>
                                        <h2 class="text-center">{{ balance }}</h2>
                                    </div>
                                </div>
                                <div class="col-4 justify-content-center">
                                    <div class="h-100 justify-content-center align-items-center">
                                        <h4 class="text-center">Income</h4>
                                        <h2 class="text-center">+{{ income }}</h2>
                                    </div>
                                </div>
                                <div class="col-4 border-left justify-content-center">
                                    <div class="h-100 justify-content-center align-items-center">
                                        <h4 class="text-center">Expenses</h4>
                                        <h2 class="text-center">-{{ expanse }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

  <card :title="$t('last_transactions')">

    <table class="table" @submit.prevent="tableUsersUpdte">
      <thead class="thead-dark">
        <tr>
        <th scope="col">#</th>
        <th scope="col">Type</th>
        <th scope="col">Amount</th>
        <th scope="col">Category</th>        </tr>
      </thead>
      <tbody>

        <tr v-for="transaction in transactions" :key="transaction.id">
          <th scope="row">{{ transaction.id }}</th>
          <td>{{ transaction.type }}</td>
          <td>{{transaction.amount}}</td>
       <td>{{transaction.amount}}</td>

        </tr>
      </tbody>
    </table>

  </card>
  </div>
    </div>
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
    balance:"11111",
    income:"222222",
    expanse:"33333333",
    transactions:""

  }),

  methods: {
    async update() {
      await this.form.patch("/api/settings/password");

      this.form.reset();
    },

  },
   mounted () {

    axios
      .get('/api/transactions')
      .then(response => (this.transactions = response.data.transactions))
      // console.log("mounted executed")
      // console.log(this.usersTable)
  }
};
</script>
