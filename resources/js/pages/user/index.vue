<template>
  <div class="row">
    <div class="col-md-3">
      <card :title="$t('settings')" class="settings-card">

      </card>
    </div>

    <div class="col-md-9">
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
          route: "admin.transactions",
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
