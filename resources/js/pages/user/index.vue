<template>
  <div class="row">
    <div class="col-md-12">
      <transition name="fade" mode="out-in">
        <router-view />
      </transition>
    </div>
  </div>
</template>

<script>
export default {
  middleware: "auth",

  computed: {
    tabs() {
      return [
        {
          icon: "user",
          name: this.$t("transactions"),
          route: "user.transactions",
        },
        {
          icon: "user",
          name: this.$t("new transaction"),
          route: "user.create_transaction",
        },
      ];
    },
  },
};
</script>

<style>
.settings-card .card-body {
  padding: 0;
}
</style>
