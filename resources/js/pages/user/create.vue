<template>
  <card :title="$t('Fill data')">
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="$t('transaction created')" />

      <!-- Password -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("amount")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.amount"
            :class="{ 'is-invalid': form.errors.has('amount') }"
            class="form-control"
            type="number"
            name="amount"
          />
          <has-error :form="form" field="amount" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("type")
        }}</label>
        <div class="col-md-7">
          <select
            v-model="form.type"
            :class="{ 'is-invalid': form.errors.has('type') }"
            class="form-control"
            name="type"
            @change="handleTypeChange($event)"
          >
            <option value="expense">expense</option>
            <option value="income">income</option>
          </select>
          <has-error :form="form" field="type" />
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("category")
        }}</label>
        <div class="col-md-7">
          <select
            name="category_id"
            v-model="form.category_id"
            :class="{ 'is-invalid': form.errors.has('category_id') }"
            class="form-control"
          >
            <option v-for="cat in list" :value="cat.id" :key="cat.id">
              {{ cat.name }}
            </option>
          </select>
          <has-error :form="form" field="category_id" />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="form-group row">
        <div class="col-md-9 ml-md-auto">
          <v-button :loading="form.busy" type="success">
            {{ $t("save") }}
          </v-button>
        </div>
      </div>
    </form>
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
      amount: "",
      type: null,
      category_id: null,
    }),
    expanse: null,
    income: null,
    list: [],
  }),

  methods: {
    async update() {
      await this.form.post("/api/transactions");

      this.form.reset();
    },
    handleTypeChange($e) {
      this.list = $e.target.value == "income" ? this.income : this.expanse;
      console.log(this.list);
    },
  },
  mounted() {
    axios.get("/api/categories").then((response) => {
      this.income = response.data.categories.income;
      this.expanse = response.data.categories.expanse;
      this.list = this.expanse;
    });
    // console.log("mounted executed")
  },
};
</script>
